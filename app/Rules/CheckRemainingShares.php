<?php

namespace App\Rules;

use App\Models\InvestorInvestments;
use App\Models\Offerings;
use Illuminate\Contracts\Validation\Rule;

class CheckRemainingShares implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $investment = InvestorInvestments::where('offering_id', $this->offering_id);
        $offering = Offerings::findorfail($this->offering_id);
        $sum_of_shares = $investment->sum('no_of_shares');
        if($offering->no_of_shares == $sum_of_shares){
            return false;
        } else{
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
        return 'All shares has been sold.';
    }
}
