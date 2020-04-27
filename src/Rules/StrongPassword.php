<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class StrongPassword extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The password must be 12 - 30 characters in length,
     * and include a number, a symbol, an upper case letter,
     * and a lower case letter.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match(
            '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@()$%^&*=_{}[\]:;"\'|\\<>,.\/~`±§+-]).{12,30}$/',
            $value
        ) > 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'strong_password',
            'The :attribute must be 12–30 characters, and include a number, a symbol, a lower and a upper case letter'
        );
    }
}
