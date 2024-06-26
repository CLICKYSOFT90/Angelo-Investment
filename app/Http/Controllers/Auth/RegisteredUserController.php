<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDocs;
use App\Models\UserWallets;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric'],
            'accredited_investor' => ['required'],
        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->accredited_investor = $request->accredited_investor == 'yes' ? 2 : 0;
        $user->recieve_digi_updates = $request->recieve_digi_updates == 'on' ? 1 : 0;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
//        Save User Docs
        if ($request->hasFile('user_docs')) {
            foreach ($request->file('user_docs') as $key => $image) {
                $fileName = time() . rand(1, 50) . '.' . $image->extension();
                $image->move(public_path('user_docs'), $fileName);
                $data[] = [
                    'filename' => $fileName,
                    'doc_type' => $key,
                    'users_id' => $user->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            UserDocs::insert($data);
        }

        //Creating User Wallet
        $user_wallet = new UserWallets();
        $user_wallet->user_id = $user->id;
        $user_wallet->amount = 0;
        $user_wallet->created_at = Carbon::now();
        $user_wallet->updated_at = Carbon::now();
        $user_wallet->save();

        event(new Registered($user));

        Auth::login($user);
        $request->user()->sendEmailVerificationNotification();

//        return redirect(RouteServiceProvider::home());
        return redirect(route('verification.notice'));
    }
}
