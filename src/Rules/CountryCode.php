<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;
use Axiom\Support\Iso3166Alpha2;
use Axiom\Support\Iso3166Alpha3;

class CountryCode extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        $array = ($this->parameters[0] ?? 2) === 2 ? Iso3166Alpha2::$codes : Iso3166Alpha3::$codes;

        return array_key_exists(strtoupper($value), $array);
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'country_code',
            'The :attribute must be a valid ISO 3166-1 alpha-' . ($this->parameters[0] ?? 2) . ' country code'
        );
    }
}
