<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Titlecase rule
class Titlecase extends Rule
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
        return ucwords($value) === $value;
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
            'titlecase',
            'Each word in :attribute must begin with a capital letter'
        );
    }

}