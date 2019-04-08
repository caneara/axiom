<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Decimal rule
class Decimal extends Rule
{

	/**
	 * Generate an example value that satisifies the validation rule.
	 *
	 * @param none.
	 * @return string.
	 *
	 **/
	public function example()
	{
		return mt_rand(1, (int) str_repeat('9', $this->parameters[0])) . '.' .
			   mt_rand(1, (int) str_repeat('9', $this->parameters[1]));
	}



    /**
     * Determine if the validation rule passes.
     *
     * The rule has two parameters:
     * 1. The maximum number of digits before the decimal point.
     * 2. The maximum number of digits after the decimal point.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return preg_match(
            "/^[0-9]{1,{$this->parameters[0]}}(\.[0-9]{1,{$this->parameters[1]}})$/", $value
        );
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
            'decimal',
            'The :attribute must be an appropriately formatted decimal e.g. ' . $this->example()
        );
    }

}