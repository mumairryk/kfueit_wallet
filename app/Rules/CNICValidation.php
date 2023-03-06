<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CNICValidation implements Rule
{
    public function passes($attribute, $value)
    {
        $cnicPattern = '/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/';
        return preg_match($cnicPattern, $value);
    }

    public function message()
    {
        return 'The :attribute must be a valid CNIC number.';
    }
}
