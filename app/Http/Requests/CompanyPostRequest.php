<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CompanyPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name'=>'required',
            'email'=>"unique:companies,email,$this->company_id,company_id",
            "logo"=>"dimensions:min_width=100,min_height=100|mimes:jpg,jpeg,png",
        ];
    }
}
