<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Str;

// Ends with rule
class EndsWith extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
	 * The rule has one parameter:
     * 1. The string the value must end with.
	 *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return Str::endsWith($value, $this->parameters[0]);
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
            'ends_with',
            'The :attribute must end with the text "' . $this->parameters[0] . '"'
        );
    }

}