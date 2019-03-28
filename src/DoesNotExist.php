<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use DB;

// Does not exist rule
class DoesNotExist extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The rule requires two parameters:
     * 1. The database table to use.
     * 2. The column on the table to compare the value against.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
		return DB::table($this->parameters[0])
				 ->where($this->parameters[1], $value)
				 ->doesntExist();
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
            'does_not_exist',
            'The :attribute already exists'
        );
    }

}