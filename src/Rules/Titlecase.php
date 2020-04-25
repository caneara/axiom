<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules;

// Using directives
use Axiom\Types\Rule;

// Titlecase rule
class Titlecase extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return ucwords($value) === $value;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'titlecase',
            'Each word in :attribute must begin with a capital letter'
        );
    }

}