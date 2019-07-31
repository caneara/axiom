<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Domain rule
class Domain extends Rule
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
        return preg_match("/^([\w-]+\.)*[\w\-]+\.\w{2,10}$/", $value);
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
            'domain',
            'The :attribute must be a valid domain without an http protocol e.g. google.com, www.google.com'
        );
    }

}
