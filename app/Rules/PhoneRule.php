<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return ($value) ? preg_match("/^(05)(5|0|3|6|4|9|1|8|7)([0-9]{6})/i", $value) : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.invalid_value');
    }
}
