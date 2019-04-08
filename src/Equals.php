<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Equals rule
class Equals extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * This rule is semantic sugar. You can achieve the
	 * same result by using the native 'in' rule, but
	 * using 'equals' may make the intention clearer.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return $this->parameters[0] === $value;
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
            'equals',
            'The :attribute must be set to "' . $this->parameters[0] . '"'
        );
    }

}