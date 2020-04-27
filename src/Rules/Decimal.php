<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class Decimal extends Rule
{

    /**
     * Generate an example value that satisifies the validation rule.
     *
     **/
    public function example() : string
    {
        return mt_rand(1, (int) str_repeat('9', $this->parameters[0])) . '.' .
               mt_rand(1, (int) str_repeat('9', $this->parameters[1]));
    }



    /**
     * Determine if the validation rule passes.
     *
     * The rule has two parameters:
     * 1. The maximum number of digits before the decimal point.
     * 2. The maximum number of digits after the decimal point.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match(
            "/^[0-9]{1,{$this->parameters[0]}}(\.[0-9]{1,{$this->parameters[1]}})$/",
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
            'decimal',
            'The :attribute must be an appropriately formatted decimal e.g. ' . $this->example()
        );
    }
}
