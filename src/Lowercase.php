<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Lowercase rule
class Lowercase extends Rule
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
        return mb_strtolower($value) === $value;
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
            'lowercase',
            'The :attribute must be entirely lowercase text'
        );
    }

}