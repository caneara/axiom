<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class Lowercase extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return mb_strtolower($value) === $value;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'lowercase',
            'The :attribute must be entirely lowercase text'
        );
    }
}
