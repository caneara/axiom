<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class TelephoneNumber extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The telephone number must be 7 - 15 characters in length,
     * and comprised entirely of integers.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match('/^[0-9]{7,15}$/', $value) > 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'telephone_number',
            'The :attribute must be a valid telephone number (7 - 15 digits in length)'
        );
    }
}
