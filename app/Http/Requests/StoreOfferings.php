<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferings extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:20',
            'investment_type' => 'required',
            'project_type' => 'required',
            'offering_type' => 'required',
            'total_investment' => 'required|numeric',
            'min_investment' => 'required',
            'hold_period' => 'required',
            'irr' => 'required',
            'est_completion' => 'required',
            'preferred_rate' => 'required',
            'no_of_shares' => 'required',
            'address' => 'required|max:50',
            'short_desc' => 'required|max:700',
            'long_desc' => 'required|max:1000',
            'disclaimer' => 'required|max:2000',
            'banner_img' => 'required|mimes:png,jpg,jpeg',
            'offering_images' => 'required',
            'offering_images.*' => 'required',
            'offering_videos' => 'required',
            'offering_videos.*' => 'required',
            'offering_docs' => 'required',
            'offering_docs.*' => 'required',
        ];
    }
}
