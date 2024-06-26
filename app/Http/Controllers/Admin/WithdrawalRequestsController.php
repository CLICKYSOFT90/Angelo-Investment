<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallets;
use App\Models\WithdrawalRequest;
use App\Notifications\AdminApproveWithdrawalRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WithdrawalRequestsController extends Controller
{
    public function withdrawalRequests()
    {
        return view('admin.withdrawalRequests.withdrawalRequests');
    }

    public function listWithdrawalRequests(Request $request)
    {
        if ($request->ajax()) {
            $classes = ['warning', 'success', 'danger'];
            $search = request('search')['value'];
            $data = WithdrawalRequest::join('users', 'withdrawal_requests.user_id', '=', 'users.id')
                ->selectRaw("withdrawal_requests.*, CONCAT(users.first_name, ' ', users.last_name) as name")
                ->orderByDesc('created_at');
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($search) {
                    if ($search) {
                        $query->whereRaw("(SELECT CONCAT(users.first_name,' ', users.last_name)) LIKE '%$search%'");
                    }

                    if(in_array(ucfirst(strtolower($search)), WithdrawalRequest::STATUS_RADIO)){
                        $query->orWhere('withdrawal_requests.status', array_search(ucfirst(strtolower($search)), WithdrawalRequest::STATUS_RADIO));
                    }

                })
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    $div = '<div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="'.$row->user?->image.'" alt="Avatar" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate">' . $row->user?->name . '</span>
                                </div>
                            </div>';
                    return $div;
                })
                ->addColumn('account_holder_name', function ($row) {
                    return $row->bankInfo->acc_holder_name;
                })
                ->addColumn('bank_name', function ($row) {
                    return $row->bankInfo->bank_name;
                })
                ->addColumn('routing_number', function ($row) {
                    return $row->bankInfo->routing_number;
                })
                ->addColumn('account_number', function ($row) {
                    return $row->bankInfo->acc_number;
                })
                ->addColumn('iban', function ($row) {
                    return $row->bankInfo->iban;
                })
                ->addColumn('amount', function ($row) {
                    return '$' . number_format($row->amount, 2);
                })
                ->addColumn('status', function ($row) use ($classes) {
                    return '<span class="badge rounded-pill  bg-label-' . $classes[$row->status] . '">' . WithdrawalRequest::STATUS_RADIO[$row->status] . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Complete" onclick="changeStatus(' . $row->id . ', 1)"><i class="bx bxs-check-circle" ></i></a>'
                        . '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="Reject" onclick="changeStatus(' . $row->id . ', 2)"><i class="bx bxs-x-circle" ></i></a>';

                    return $row->status == 0 ? $html : '';
                })
                ->rawColumns(['id', 'name', 'account_holder_name', 'bank_name', 'routing_number', 'account_number', 'iban', 'amount', 'status', 'action'])
                ->make();
        }
    }

    public function withdrawalStatusChange(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:withdrawal_requests,id',
                'status' => 'required|in:1,2',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Invalid Data"
                ], 402);
            }

//            $request->validate(['status' => 'required|in:1,2']);
            $withdrawal_request = WithdrawalRequest::findorfail($request->id);
            $user = User::find($withdrawal_request->user_id);
            if ($withdrawal_request) {
                $transaction = Transaction::where('withdrawal_requests_id', $withdrawal_request->id)->first();
                if ($request->status == 1) {
                    //Deducting from User's Wallet
                    $user_wallet = UserWallets::where('user_id', $withdrawal_request->user_id)->first();
                    if($user_wallet->amount > $request->amount){
                        $user_wallet->amount = $user_wallet->amount - $withdrawal_request->amount;
                        $user_wallet->save();
                        //Changing Status in Transaction
                        $transaction->status = $request->status;
                        $transaction->save();

                        $withdrawal_request->status = $request->status;
                        $withdrawal_request->save();

                        $user->notify((new AdminApproveWithdrawalRequestNotification(['amount'=>$withdrawal_request->amount, 'status'=>$request->status]))->delay(now()->addSecond(10)));
                    } else{
                        return response()->json([
                            'status' => true,
                            'message' => "Dont have enough amount in wallet."
                        ], 200);
                    }

                } else {
                    //Changing Status in Transaction
                    $transaction->status = $request->status;
                    $transaction->save();

                    //Rejecting Withdrawal Request
                    $withdrawal_request->status = $request->status;
                    $withdrawal_request->save();

                    $user->notify((new AdminApproveWithdrawalRequestNotification(['amount'=>$withdrawal_request->amount, 'status'=>$request->status]))->delay(now()->addSecond(10)));
                }
                return response()->json([
                    'status' => true,
                    'message' => "Withdrawal request status changed successfully!"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Withdrawal request Not found"
                ], 402);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
