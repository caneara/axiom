<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules;

// Using directives
use Axiom\Types\Rule;

// Domain rule
class Domain extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match("/^([\w-]+\.)*[\w\-]+\.\w{2,10}$/", $value) > 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'domain',
            'The :attribute must be a valid domain without an http protocol e.g. google.com, www.google.com'
        );
    }

}
