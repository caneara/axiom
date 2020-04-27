<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class OddNumber extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return intval($value) % 2 !== 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'odd_number',
            'The :attribute must be an odd number'
        );
    }
}
