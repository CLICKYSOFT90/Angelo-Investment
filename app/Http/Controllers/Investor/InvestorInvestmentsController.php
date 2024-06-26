<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestmentLimits;
use App\Models\InvestorInvestments;
use App\Models\Offerings;
use App\Models\RecentInvestments;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallets;
use App\Notifications\InvestementToAdminNotification;
use App\Notifications\InvestementToUserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CheckInvestorInvestments;

class InvestorInvestmentsController extends Controller
{
    public function create(CheckInvestorInvestments $request)
    {
        $offering = Offerings::findorfail($request->offering_id);
        $user_wallet = UserWallets::where('user_id', auth()->user()->id)->first();
        $admin = User::where('role_id', 1)->first();
        $amount_invested = $offering->price_per_share * $request->no_of_shares;
        $user_obj = auth()->user();

        $investor_investment = new InvestorInvestments();
        $investor_investment->user_id = auth()->user()->id;
        $investor_investment->offering_id = $request->offering_id;
        $investor_investment->amount_invested = $amount_invested;
        $investor_investment->no_of_shares = $request->no_of_shares;
        $investor_investment->status = 1;
        $investor_investment->save();

        // Inserting In Transactions
        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->date = Carbon::now();
        $transaction->type = 'investment';
        $transaction->amount = $amount_invested;
        $transaction->status = 1;
        $transaction->save();

        // Deducting from user's wallet
        $user_wallet->amount = $user_wallet->amount - $amount_invested;
        $user_wallet->save();

        //Inserting in Recent Investments
        $recent_investments = new RecentInvestments();
        $recent_investments->user_id = $user_obj->id;
        $recent_investments->offering_id = $request->offering_id;
        $recent_investments->created_at = Carbon::now();
        $recent_investments->updated_at = Carbon::now();
        $recent_investments->save();

        //Send Email to Investor and Admin
        $data = [
            'offering_name' => $offering->name,
            'amount' => $amount_invested,
            'user' => $user_obj
        ];

        $user_obj->notify((new InvestementToUserNotification($data))->delay(now()->addSecond(10)));

        $admin->notify((new InvestementToAdminNotification($data))->delay(now()->addSecond(10)));

        Session::flash('success', 'Congratulation!, You have successfully invested.');
        return redirect()->route('offering-details', $request->offering_id);
    }
}
