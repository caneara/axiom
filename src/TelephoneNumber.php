<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Alphametric\Validation\Rules\Helper;
use Illuminate\Contracts\Validation\Rule;

// Telephone number rule
class TelephoneNumber implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The telephone number must be 7 - 15 characters in length,
     * and comprised entirely of integers.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return preg_match("/^[0-9]{7,15}$/", $value);
    }



    /**
     * Get the validation error message.
     *
     * @param none.
     * @return string.
     *
     **/
    public function message()
    {
        return Helper::getLocalizedErrorMessage(
            'telephone_number',
            'The :attribute must be a valid telephone number (7 - 15 digits in length)'
        );
    }

}