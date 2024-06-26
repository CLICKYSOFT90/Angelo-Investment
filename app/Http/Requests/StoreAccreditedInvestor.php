<?php

namespace App\Http\Requests;

use App\Rules\CheckFilesCount;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccreditedInvestor extends FormRequest
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
            'user_docs' => ['required'],
//            'user_docs.*' => "mimes:'png,jpg,jpeg,pdf,doc,docx"

        ];
    }
    public function messages()
    {
        return [
            'user_docs.required' => 'Atleast one document is required.',

        ];
    }
}
