<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TransactionsController extends Controller
{
    public function transactions()
    {
        return view('admin.transactions.transactions');
    }

    public function listTransactions(Request $request)
    {
        if ($request->ajax()) {
            $classes = ['warning', 'success', 'danger'];
            $search = request('search')['value'];
            $date_from = $request->get('date_from');
            $date_to = $request->get('date_to');

            $data = Transaction::orderByDesc('created_at');

            if ($date_from != '' && $date_to != ''){
                $data->whereBetween('date', [$date_from,Carbon::make($date_to)->addDay()]);
            }

            $data->join('users', 'transactions.user_id', '=', 'users.id')
                ->selectRaw("transactions.*, CONCAT(users.first_name, ' ', users.last_name) as name");
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($search) {

                    if ($search) {
                        $query->where('type', 'like', "%" . $search . "%")
                        ->orWhereRaw("(SELECT CONCAT(users.first_name,' ', users.last_name)) LIKE '%$search%'");
                    }

                    if(in_array(ucfirst(strtolower($search)), Transaction::STATUS_RADIO)){
                        $query->orWhere('transactions.status', array_search(ucfirst(strtolower($search)), Transaction::STATUS_RADIO));
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
                            <span class="emp_name text-truncate">'.$row->user?->name.'</span>
                        </div>
                    </div>';
                    return $div;
                })
                ->addColumn('date', function ($row) {
                    return date('d-M-Y', strtotime($row->date));
                })
                ->addColumn('type', function ($row) {
                    return $row->type;
                })
                ->addColumn('amount', function ($row) {
                    return '$'.number_format($row->amount);
                })
                ->addColumn('status', function ($row) use ($classes){
                    return '<span class="badge rounded-pill  bg-label-'.$classes[$row->status].'">'.Transaction::STATUS_RADIO[$row->status].'</span>';
                })
                ->rawColumns(['id', 'name', 'date', 'type', 'amount', 'status'])
                ->make();
        }
    }
}
