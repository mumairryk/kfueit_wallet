<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'full_name'=>'required|max:30',
            'company_name'=>'nullable|max:50',
            'email'=>'required|email',
            'mobile_number'=>'required|max:10',
            'phone_no'=>'nullable|max:10',
            'tag_line'=>'nullable',
//            'languages'=>'nullable',
            'in_buss_since'=>'nullable',
            'usa_city'=>'nullable',
            'website_link'=>'nullable',
            'license_info'=>'nullable',
            'address'=>'required',
            ];
    }
    public function attributes()
    {
        return [
            'full_name'=> trans("full name"),
            'company_name'=> trans("company name"),
            'mobile_number'=> trans("mobile number"),
            'phone_no'=> trans("phone"),
            'email'=> trans("email"),
            'tag_line'=> trans("tag line"),
//            'languages'=> trans("languages"),
            'in_buss_since'=> trans("in buss since"),
            'usa_city'=> trans("usa city"),
            'website_link'=> trans("website link"),
            'license_info'=> trans("license info"),
            'address'=> trans("address"),
        ];
    }
}
