<?php

namespace App\Http\Requests;

use App\Rules\CheckInvestmentLimit;
use App\Rules\CheckRemainingShares;
use App\Rules\CheckUserTaxForm;
use App\Rules\CheckWalletAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CheckInvestorInvestments extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'no_of_shares' => ['required', new CheckInvestmentLimit($request->offering_id), new CheckUserTaxForm(), new CheckRemainingShares($request->offering_id)],
            'investment_amount' => new CheckWalletAmount(),
        ];
    }
}
