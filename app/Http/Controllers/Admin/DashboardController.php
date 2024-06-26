<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestorInvestments;
use App\Models\Offerings;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = new User();
        $all_users = $users->where('role_id', 2)->count();
        $accerited = $users->where(['role_id' => 2, 'accredited_investor' => 1])->count();
        $normal = $users->where(['role_id' => 2, 'accredited_investor' => 0])->orwhere('accredited_investor', 2)->count();


        $withdrawals_requests = new WithdrawalRequest();
        $new_withdrawals_requests = $withdrawals_requests->where('status', 0)->count();
        $total_investments = InvestorInvestments::sum('amount_invested');
        $accerited_request = $users->where('accredited_investor', 2)->count();

        $offerings = new Offerings();
        $total_offerings = $offerings->count();
        $completed_offerings = $offerings->where('is_completed', 1)->count();
        $current_offerings = $offerings->where('is_completed', 0)->count();
        return view('layouts.admin.dashboard')->with('all_users', $all_users)
            ->with('accerited', $accerited)
            ->with('normal', $normal)
            ->with('new_withdrawals_requests', $new_withdrawals_requests)
            ->with('total_investments', $total_investments)
            ->with('accerited_request', $accerited_request)
            ->with('total_offerings', $total_offerings)
            ->with('completed_offerings', $completed_offerings)
            ->with('current_offerings', $current_offerings);
    }
}
