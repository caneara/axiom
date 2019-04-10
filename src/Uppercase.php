<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Uppercase rule
class Uppercase extends Rule
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
        return mb_strtoupper($value) === $value;
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
            'uppercase',
            'The :attribute must be entirely uppercase text'
        );
    }

}