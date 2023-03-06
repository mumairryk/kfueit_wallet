<?php

namespace App\Rules;

use App\Models\Agent\Agents;
use Illuminate\Contracts\Validation\Rule;
use Hash;
class ValidateAgentPassword implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Agents $agent)
    {
        $this->agent = $agent;
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
        return Hash::check($value, $this->agent->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter correct password.';
    }
}
