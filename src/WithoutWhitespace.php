<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Without whitespace rule
class WithoutWhitespace extends Rule
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
		return ! preg_match("/\s/", $value);
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
            'without_whitespace',
            'The :attribute must be an unbroken string of text, it cannot include spaces'
        );
    }

}