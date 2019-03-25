<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Monetary figure rule
class MonetaryFigure extends Rule
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
		return $this->parameters[0] .
			   mt_rand(1, (int) str_repeat('9', $this->parameters[1])) . '.' .
			   mt_rand(1, (int) str_repeat('9', $this->parameters[2]));
	}



    /**
     * Determine if the validation rule passes.
     *
     * The monetary figure requires three parameters:
     * 1. The currency symbol required e.g. '$', '£', '€'.
     * 2. The maximum number of digits before the decimal point.
     * 3. The maximum number of digits after the decimal point.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        return preg_match(
            "/^\\{$this->parameters[0]}[0-9]{1,{$this->parameters[1]}}(\.[0-9]{1,{$this->parameters[2]}})?$/", $value
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
            'monetary_figure',
            'The :attribute must be a monetary figure e.g. ' . $this->example()
        );
    }

}