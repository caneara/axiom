<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules;

// Using directives
use Axiom\Types\Rule;

// Mac address rule
class MacAddress extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match("/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/", $value) > 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'mac_address',
            'The :attribute must be a valid MAC address'
        );
    }

}