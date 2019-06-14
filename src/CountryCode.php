<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Alphametric\Validation\Rules\Misc\Iso3166Alpha2;
use Alphametric\Validation\Rules\Misc\Iso3166Alpha3;

// Country code rule
class CountryCode extends Rule
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
		$array = ($this->parameters[0] ?? 2) == 2 ? Iso3166Alpha2::getCodes() : Iso3166Alpha3::getCodes();

        return array_key_exists(strtoupper($value), $array);
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
            'country_code',
            'The :attribute must be a valid ISO 3166-1 alpha-' . ($this->parameters[0] ?? 2) . ' country code'
        );
    }

}