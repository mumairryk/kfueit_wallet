<?php

namespace App\Http\Requests;

use App\Rules\ValidatePassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'oldpassword'=> ['required', new ValidatePassword(Auth::user())],
            'newpassword'=> ['required'],
            'confirmpassword'=> ['required','same:newpassword'],

        ];
    }
    public function attributes()
    {
        return [
            'email'=> "email",
            'password'=> "password",
        ];
    }
}
