<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountSettings;
use App\Http\Requests\StoreAccreditedInvestor;
use App\Models\User;
use App\Models\UserDocs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AccountSettingsController extends Controller
{
    public function settings()
    {
        return view('investor.settings');
    }

    public function update(StoreAccountSettings $request)
    {
        $user = User::findorfail(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->recieve_digi_updates = $request->recieve_digi_updates == 'yes' ? 1 : 0;
        $user->password = !empty($request->password) ? Hash::make($request->password) : $user->password;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $profileimg = 'profile-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $location = public_path('profiles/' . $profileimg);

            Image::make($image)->resize(225, 225)->save($location, 60);
            $file_path = public_path('profiles/') . $user->image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $user->image = $profileimg;
        }

        if ($request->hasFile('tax_form')) {
            $fileName = time() . rand(1, 50) . '.' . $request->tax_form->extension();
            $request->tax_form->move(public_path('user-tax-form'), $fileName);
            $user->w9_taxform = $fileName;
            $user->is_tax_form = 1;
        }

        $user->save();
        Session::flash('success', 'Profile Updated');
        return redirect()->back();
    }

    public function accreditedInvestor()
    {
        return view('investor.upgrade-accredited');
    }

    public function accreditedInvestorSave(StoreAccreditedInvestor $request)
    {
        if ($request->hasFile('user_docs')) {
            $user = User::find(auth()->user()->id);
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
                $user->accredited_investor = 2;
                $user->save();
            }
            UserDocs::insert($data);
        }
        Session::flash('success', 'Your request has been sent to admin for approval');
        return redirect()->route('investor.dashboard');
    }
}
