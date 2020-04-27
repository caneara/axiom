<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class WithoutWhitespace extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match('/\s/', $value) === 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'without_whitespace',
            'The :attribute must be an unbroken string of text, it cannot include spaces'
        );
    }
}
