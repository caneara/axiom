<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecordOwner extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The rule requires two parameters:
     * 1. The database table to use.
     * 2. The column on the table to compare the value against.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return DB::table($this->parameters[0])
            ->where($this->parameters[1], $value)
            ->where('user_id', Auth::id())
            ->exists();
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'record_owner',
            'You do not have permission to interact with this resource'
        );
    }
}
