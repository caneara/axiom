<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class MonetaryFigure extends Rule
{

    /**
     * Generate an example value that satisifies the validation rule.
     *
     **/
    public function example() : string
    {
        return $this->parameters[0] .
               mt_rand(1, (int) str_repeat('9', $this->parameters[1])) . '.' .
               mt_rand(1, (int) str_repeat('9', $this->parameters[2]));
    }



    /**
     * Determine if the validation rule passes.
     *
     * The monetary figure requires three parameters:
     * 1. The currency symbol required e.g. '$', '£', '€'.
     * 2. The maximum number of digits before the decimal point.
     * 3. The maximum number of digits after the decimal point.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match(
            "/^\\{$this->parameters[0]}[0-9]{1,{$this->parameters[1]}}(\.[0-9]{1,{$this->parameters[2]}})?$/",
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
            'monetary_figure',
            'The :attribute must be a monetary figure e.g. ' . $this->example()
        );
    }
}
