<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Even number rule
class EvenNumber extends Rule
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
        return intval($value) % 2 === 0;
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
            'even_number',
            'The :attribute must be an even number'
        );
    }

}