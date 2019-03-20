<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Alphametric\Validation\Rules\Helper;
use Illuminate\Contracts\Validation\Rule;

// Strong password rule
class StrongPassword implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The password must be 12 - 30 characters in length,
     * and include a number, a symbol, an upper case letter,
     * and a lower case letter.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return preg_match(
            "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@()$%^&*=_{}[\]:;\"'|\\<>,.\/~`±§+-]).{12,30}$/", $value
        );
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
            'strong_password',
            'The :attribute must be 12–30 characters, and include a number, a symbol, a lower and a upper case letter'
        );
    }

}