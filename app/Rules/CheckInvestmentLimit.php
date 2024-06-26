<?php

namespace App\Rules;

use App\Models\InvestmentLimits;
use App\Models\InvestorInvestments;
use App\Models\Offerings;
use http\Env\Request;
use Illuminate\Contracts\Validation\Rule;

class CheckInvestmentLimit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $offering_id;
    public function __construct($offering_id)
    {
        $this->offering_id = $offering_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (auth()->user()->accredited_investor !== 1) {
            $offering = Offerings::findorfail($this->offering_id);
            $limit = InvestmentLimits::first();
            $total_invested = InvestorInvestments::where('user_id', auth()->user()->id)->sum('amount_invested');
            $amount = $value * $offering->price_per_share;
            $total_amount = $amount + $total_invested;
            return $total_amount <= $limit->limit;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You cannot invest more than your limit, Please upgrade your account.';
    }
}
