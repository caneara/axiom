<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use DB;
use Auth;

// Record owner rule
class RecordOwner extends Rule
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
		return DB::table($this->parameters[0])
				 ->where($this->parameters[1], $value)
				 ->where('user_id', Auth::id())
				 ->exists();
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
            'record_owner',
            'You do not have permission to interact with this resource'
        );
    }

}