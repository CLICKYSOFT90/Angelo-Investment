<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckStripeForm;
use App\Http\Requests\StoreWithdrawalRequest;
use App\Models\BankAccounts;
use App\Models\PaymentLogs;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallets;
use App\Models\WithdrawalRequest;
use App\Notifications\WithdrawalRequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Yajra\DataTables\Facades\DataTables;

class FundsController extends Controller
{
    public function fundDepositsListing(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::where(['user_id' => auth()->user()->id, 'type' => 'deposit'])->orderBy('created_at', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('date', function ($row) {
                    return date('d-M-Y', strtotime($row->date));
                })
                ->addColumn('type', function ($row) {
                    return $row->type;
                })
                ->addColumn('amount', function ($row) {
                    return number_format($row->amount, 2);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0)
                        $status = 'Pending';
                    elseif ($row->status == 1)
                        $status = 'Completed';
                    else
                        $status = 'Rejected';
                    return $status;
                })
                ->rawColumns(['id', 'date', 'type', 'amount', 'status'])
                ->make(true);
        }
    }

    public function fundDeposits()
    {
        return view('investor.fundDeposits');
    }

    public function fundDeposited(CheckStripeForm $request)
    {
        try {
            $data = $request->all();
            $expiry_arr = explode('/', $data['expiry']);
            $month = $expiry_arr[0];
            $year = end($expiry_arr);
            $request_array = [
                'card' => [
                    'name' => $data['title'],
                    'number' => $data['acc_number'],
                    'exp_month' => $month,
                    'exp_year' => $year,
                    'cvc' => $data['cvv']
                ],
            ];
            $customer_info = [
                'name' => auth()->user()->first_name . " " . auth()->user()->last_name,
                'description' => auth()->user()->id
            ];

            //Remove . from amount
            $amount = str_replace('.', '', $data['amount']);

            $stripe = new StripeClient(config('stripe.SECRET'));
            $token = $stripe->tokens->create($request_array);
            $create_customer = $stripe->customers->create($customer_info);
            $create_source = $stripe->customers->createSource($create_customer->id, ['source' => $token->toArray()['id']]);
            $charge = $stripe->charges->create(['amount' => $amount . '00', 'currency' => 'usd', 'customer' => $create_customer->id, 'source' => $create_source->id]);
            $response = [
                'token' => $token->toArray(),
                'create_customer' => $create_customer->toArray(),
                'create_source' => $create_source->toArray(),
                'charge' => $charge->toArray()
            ];
            if ($charge->status == 'succeeded') {
                PaymentLogs::insert([
                    'request' => '',
                    'response' => json_encode($response),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $transaction = new Transaction();
                $transaction->user_id = auth()->user()->id;
                $transaction->date = Carbon::now();
                $transaction->type = 'deposit';
                $transaction->amount = $data['amount'];
                $transaction->status = 1;
                $transaction->save();

                //Inserting In User's wallet
                $user_wallet_exists = UserWallets::whereUserId(auth()->user()->id)->first();
                if ($user_wallet_exists) {
                    $user_wallet_exists->user_id = auth()->user()->id;
                    $user_wallet_exists->amount = $user_wallet_exists->amount + $data['amount'];
                    $user_wallet_exists->created_at = Carbon::now();
                    $user_wallet_exists->updated_at = Carbon::now();
                    $user_wallet_exists->save();
                } else {
                    $create_user_wallet = new UserWallets();
                    $create_user_wallet->user_id = auth()->user()->id;
                    $create_user_wallet->amount = $data['amount'];
                    $create_user_wallet->created_at = Carbon::now();
                    $create_user_wallet->updated_at = Carbon::now();
                    $create_user_wallet->save();
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Transaction Successful'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fundWithdrawalsListing(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::where(['user_id' => auth()->user()->id, 'type' => 'withdrawal'])->orderBy('created_at', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('date', function ($row) {
                    return date('d-M-Y', strtotime($row->date));
                })
                ->addColumn('type', function ($row) {
                    return $row->type;
                })
                ->addColumn('amount', function ($row) {
                    return number_format($row->amount, 2);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0)
                        $status = 'Pending';
                    elseif ($row->status == 1)
                        $status = 'Completed';
                    else
                        $status = 'Rejected';
                    return $status;
                })
                ->rawColumns(['id', 'date', 'type', 'amount', 'status'])
                ->make(true);
        }
    }

    public function fundWithdrawals()
    {
        $bank_accounts = BankAccounts::where(['status'=> 1, 'user_id'=> auth()->user()->id])->get();
        return view('investor.fundwithdrawl')->with('bank_accounts', $bank_accounts);
    }

    public function fundWithdrawaled(StoreWithdrawalRequest $request)
    {
        try {
            $admin = User::where('role_id', 1)->first();

            $withdrawal_request = new WithdrawalRequest();
            $withdrawal_request->user_id = auth()->user()->id;
            $withdrawal_request->bank = $request->bank_id;
            $withdrawal_request->amount = $request->amount;
            $withdrawal_request->save();

            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->date = Carbon::now();
            $transaction->type = 'withdrawal';
            $transaction->amount = $request->amount;
            $transaction->status = 0;
            $transaction->withdrawal_requests_id = $withdrawal_request->id;
            $transaction->created_at = Carbon::now();
            $transaction->updated_at = Carbon::now();
            $transaction->save();

            $admin->notify((new WithdrawalRequestNotification(auth()->user(), $request->amount))->delay(now()->addSecond(5)));

            return response()->json([
                'status' => true,
                'message' => "Withdrawal request send, Please wait for admin approval"
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
