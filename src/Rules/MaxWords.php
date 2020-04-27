<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class MaxWords extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return count(preg_split('~[^\p{L}\p{N}\']+~u', $value)) <= $this->parameters[0];
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'max_words',
            'The :attribute cannot be longer than ' . $this->parameters[0] . ' words.'
        );
    }
}
