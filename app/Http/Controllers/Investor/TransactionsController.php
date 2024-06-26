<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionsController extends Controller
{
    public function transactions()
    {
        return view('investor.transactions');
    }

    public function transactionsListing(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::where('user_id', auth()->user()->id)->orderByDesc('created_at');
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
                    if($row->status == 0)
                        $status = 'Pending';
                    elseif ($row->status == 1)
                        $status = 'Completed';
                    else
                        $status = 'Rejected';
                    return $status;
                })
                ->rawColumns(['id','date','type','amount','status'])
                ->make(true);
        }
    }
}
