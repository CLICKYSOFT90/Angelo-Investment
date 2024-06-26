<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankAccounts;
use App\Models\BankAccounts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function add()
    {
        $bank_accounts = BankAccounts::where('user_id', auth()->user()->id)->get();
        return view('investor.bankAccounts')->with('bank_accounts', $bank_accounts);
    }

    public function save(StoreBankAccounts $request)
    {
        try {
            $bank = BankAccounts::updateorcreate([
                'id' => $request->bank_id,
            ], [
                'user_id' => auth()->user()->id,
                'bank_name' => $request->bank_name,
                'acc_holder_name' => $request->name,
                'acc_number' => $request->acc_number,
                'iban' => $request->iban,
                'routing_number' => $request->routing_number,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Bank Account Saved Successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($acc_id)
    {
        try {
            $bank = BankAccounts::findorfail($acc_id);
            return response()->json([
                'status' => true,
                'message' => 'Bank Account Added Successfully',
                'data' => $bank
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(StoreBankAccounts $request)
    {
        try {
            $bank = new BankAccounts();
            $bank->user_id = auth()->user()->id;
            $bank->bank_name = $request->bank_name;
            $bank->acc_holder_name = $request->name;
            $bank->acc_number = $request->acc_number;
            $bank->iban = $request->iban;
            $bank->routing_number = $request->routing_number;
            $bank->status = 1;
            $bank->created_at = Carbon::now();
            $bank->updated_at = Carbon::now();
            $bank->save();

            return response()->json([
                'status' => true,
                'message' => 'Bank Account Added Successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $bank = BankAccounts::find($request->id);
            $bank->delete();

            return response()->json([
                'status' => true,
                'message' => 'Bank Account Deleted Successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
