<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorInvestments;
use App\Models\RecentInvestments;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $recent_investments = RecentInvestments::where('user_id', auth()->user()->id)->orderByDesc('created_at')->with('offering')->take(5)->get();
//        dd($recent_investments);
        return view('investor.dashboard')->with('recent_investments', $recent_investments);
    }

    public function currentInvestmentsListing(Request $request)
    {
        if ($request->ajax()) {
            $data = InvestorInvestments::selectRaw('offerings.id as of_id,
                investor_investments.id as ii_id,
                investor_investments.created_at as ii_created_at,
                offerings.name,
                offerings.project_type,
                offerings.investment_required,
                investor_investments.amount_invested,
                offerings.no_of_units,
                investor_investments.created_at,
                offerings.hold_period,
                offerings.target_irr')
                ->leftJoin('offerings', 'offerings.id', '=', 'investor_investments.offering_id')
                ->where(['investor_investments.user_id' => auth()->user()->id, 'offerings.is_completed' => 0])
                ->orderBy('investor_investments.created_at', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('type', function ($row) {
                    return $row->project_type;
                })
                ->addColumn('investment_required', function ($row) {
                    return '$'.number_format($row->investment_required);
                })
                ->addColumn('invested', function ($row) {
                    return '$'.$row->amount_invested;
                })
                ->addColumn('units', function ($row) {
                    return $row->no_of_units;
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->ii_created_at));
                })
                ->addColumn('holding_period', function ($row) {
                    return $row->hold_period;
                })
                ->addColumn('irr', function ($row) {
                    return $row->target_irr.'%';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('offering-details', $row->of_id).'" class="view-table-cta" target="_blank">View All</a>';
                })
                ->rawColumns(['name','type','investment_required','invested','units','date','holding_period','irr', 'action'])
                ->make(true);
        }
    }
    public function completedInvestmentsListing(Request $request)
    {
        if ($request->ajax()) {
            $data = InvestorInvestments::selectRaw('offerings.id as of_id,
                investor_investments.id as ii_id,
                investor_investments.created_at as ii_created_at,
                offerings.name,
                offerings.project_type,
                offerings.investment_required,
                investor_investments.amount_invested,
                offerings.no_of_units,
                investor_investments.created_at,
                offerings.hold_period,
                offerings.target_irr,
                offerings.actual_irr')
                ->leftJoin('offerings', 'offerings.id', '=', 'investor_investments.offering_id')
                ->where(['investor_investments.user_id' => auth()->user()->id, 'offerings.is_completed' => 1])
                ->orderBy('investor_investments.created_at', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('type', function ($row) {
                    return $row->project_type;
                })
                ->addColumn('investment_required', function ($row) {
                    return '$'.number_format($row->investment_required);
                })
                ->addColumn('invested', function ($row) {
                    return '$'.$row->amount_invested;
                })
                ->addColumn('units', function ($row) {
                    return $row->no_of_units;
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->ii_created_at));
                })
                ->addColumn('holding_period', function ($row) {
                    return $row->hold_period;
                })
                ->addColumn('irr', function ($row) {
                    return $row->target_irr.'%';
                })
                ->addColumn('actual_irr', function ($row) {
                    return $row->actual_irr.'%';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('offering-details', $row->of_id).'" class="view-table-cta" target="_blank">View All</a>';
                })
                ->rawColumns(['name','type','investment_required','invested','units','date','holding_period','irr','actual_irr', 'action'])
                ->make(true);
        }
    }

    public function portfolio()
    {
        return view('investor.portfolio');
    }
}
