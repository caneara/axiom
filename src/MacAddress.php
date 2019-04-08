<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Mac address rule
class MacAddress extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return preg_match("/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/", $value);
    }



    /**
     * Get the validation error message.
     *
     * @param none.
     * @return string.
     *
     **/
    public function message()
    {
        return Helper::getLocalizedErrorMessage(
            'mac_address',
            'The :attribute must be a valid MAC address'
        );
    }

}