<?php

namespace App\Http\Controllers;

use App\Models\InvestmentLimits;
use App\Models\InvestorInvestments;
use App\Models\Offerings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function openInvestments($filter_type = null, $param = null)
    {
        $offerings = Offerings::selectRaw("
            offerings.id as of_id,
            offerings.name,
            offerings.investment_type,
            offerings.project_type,
            offerings.min_investments,
            offerings.hold_period,
            offerings.target_irr,
            offerings.est_construction_completion,
            offerings.preferred_rate,
            offerings.investment_required,
            offerings.no_of_shares,
            offerings.price_per_share,
            offerings.address,
            offerings.short_desc,
            offerings.long_desc,
            IFNull((investor_investments.amount_invested / offerings.investment_required) * 100, 0) as percentage")
            ->leftJoin('investor_investments', 'investor_investments.offering_id', '=', 'offerings.id');
        if ($filter_type == 'sort_by') {
//            if ($param == 'Recently Added') {
//                $offerings->where();
//            }
            if ($param == 'irr') {
                $offerings->orderByDesc('offerings.target_irr');
            }
        }
        if ($filter_type == 'investment_type') {
            $offerings->where('offerings.investment_type', $param);
        }
        if ($filter_type == 'project_type') {
            $offerings->where('offerings.project_type', $param);
        }
        $offerings = $offerings->where(['offerings.is_completed' => 0, 'offerings.status' => 1])->having('percentage', '<', 100)->orderByDesc('offerings.created_at')->paginate(6);
        return view('offerings.open-investments')->with('offerings', $offerings)->with('filter', $filter_type);
    }

    public function fullyFunded($filter_type = null, $param = null)
    {
        $offerings = Offerings::selectRaw("
            offerings.id as of_id,
            offerings.name,
            offerings.investment_type,
            offerings.project_type,
            offerings.min_investments,
            offerings.hold_period,
            offerings.target_irr,
            offerings.est_construction_completion,
            offerings.preferred_rate,
            offerings.investment_required,
            offerings.no_of_shares,
            offerings.price_per_share,
            offerings.address,
            offerings.short_desc,
            offerings.long_desc,
            IFNull((investor_investments.amount_invested / offerings.investment_required) * 100, 0) as percentage")
            ->leftJoin('investor_investments', 'investor_investments.offering_id', '=', 'offerings.id');
        if ($filter_type == 'sort_by') {
//            if ($param == 'Recently Added') {
//                $offerings->where();
//            }
            if ($param == 'irr') {
                $offerings->orderByDesc('offerings.target_irr');
            }
        }
        if ($filter_type == 'investment_type') {
            $offerings->where('offerings.investment_type', $param);
        }
        if ($filter_type == 'project_type') {
            $offerings->where('offerings.project_type', $param);
        }
        $offerings = $offerings
            ->where(['offerings.is_completed' => 0, 'offerings.status' => 1])
            ->having('percentage', '=', 100)
            ->orderByDesc('offerings.created_at')
            ->paginate(6);
        return view('offerings.fully-funded')->with('offerings', $offerings)->with('filter', $filter_type);
    }

    public function pastInvestments($filter_type = null, $param = null)
    {
        $offerings = Offerings::selectRaw("*,
            offerings.id as of_id,
            IFNull((investor_investments.amount_invested / offerings.investment_required) * 100, 0) as percentage")
            ->leftJoin('investor_investments', 'investor_investments.offering_id', '=', 'offerings.id');
        if ($filter_type == 'sort_by') {
//            if ($param == 'Recently Added') {
//                $offerings->where();
//            }
            if ($param == 'irr') {
                $offerings->orderByDesc('offerings.target_irr');
            }
        }
        if ($filter_type == 'investment_type') {
            $offerings->where('offerings.investment_type', $param);
        }
        if ($filter_type == 'project_type') {
            $offerings->where('offerings.project_type', $param);
        }
        $offerings = $offerings->where(['offerings.is_completed'=> 1, 'offerings.status'=> 1])->orderByDesc('offerings.created_at')->paginate(6);
        return view('offerings.past-investments')->with('offerings', $offerings)->with('filter', $filter_type);
    }

    public function offeringDetails($offering_id)
    {
        $offering = Offerings::with('offeringImages', 'offeringVideos', 'offeringDocuments')->findorfail($offering_id);

        $related_offerings = Offerings::selectRaw("*,
            offerings.id as of_id,
            IFNull((investor_investments.amount_invested / offerings.investment_required) * 100, 0) as percentage")
            ->leftJoin('investor_investments', 'investor_investments.offering_id', '=', 'offerings.id')
            ->where(['investment_type' => $offering->investment_type, 'project_type' => $offering->project_type])
            ->take(3)
            ->get();

        $investor_investments_obj = InvestorInvestments::where('offering_id', $offering_id);
        $invested_shares = $investor_investments_obj->sum('no_of_shares');
        $fund_recieved = $investor_investments_obj->sum('amount_invested');
        $fund_remaining = $offering->investment_required - $fund_recieved;
        $percentage = ($fund_recieved / $offering->investment_required) * 100;

        return view('offerings.offering-details')
            ->with('offering', $offering)
            ->with('related_offerings', $related_offerings)
            ->with('invested_shares', $invested_shares)
            ->with('fund_recieved', $fund_recieved)
            ->with('fund_remaining', $fund_remaining)
            ->with('percentage', $percentage);
    }

    public function offeringDetailsInvest($offering_id)
    {
        $offering = Offerings::with('offeringRequiredDocuments')->findorfail($offering_id);
        $investor_investments_obj = InvestorInvestments::query();

        $user_all_transactions = $investor_investments_obj->where('user_id', auth()->user()->id)->sum('amount_invested');

        $invested_shares = $investor_investments_obj->where('offering_id', $offering_id)->sum('no_of_shares');
        $fund_recieved = $investor_investments_obj->where('offering_id', $offering_id)->sum('amount_invested');
        $fund_remaining = $offering->investment_required - $fund_recieved;
        $percentage = ($fund_recieved / $offering->investment_required) * 100;

        $investment_limit = InvestmentLimits::first();

        return view('offerings.offering-invest')
            ->with('offering', $offering)
            ->with('invested_shares', $invested_shares)
            ->with('fund_recieved', $fund_recieved)
            ->with('fund_remaining', $fund_remaining)
            ->with('percentage', $percentage)
            ->with('investment_limit', $investment_limit)
            ->with('user_all_transactions', $user_all_transactions);
    }
}
