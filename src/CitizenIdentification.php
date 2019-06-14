<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Alphametric\Validation\Rules\Misc\Iso3166Alpha2;
use Alphametric\Validation\Rules\Misc\Iso3166Alpha3;

// Citizen identification rule
class CitizenIdentification extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The rule requires one parameter:
     * 1. The identification type to use ('USA' or 'US, 'GBR' or 'GB', 'FRA' or 'FR).
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
		$array = ($this->parameters[0] ?? 2) == 2 ? Iso3166Alpha2::getCodes() : Iso3166Alpha3::getCodes();

		switch (mb_strtoupper($this->parameters[0] ?? 'USA')) {

			case 'US':
			case 'USA':
				return preg_match("/^(?!000|666)[0-8][0-9]{2}-(?!00)[0-9]{2}-(?!0000)[0-9]{4}$/", $value);

			case 'GB':
			case 'GBR':
				return preg_match("/^[A-CEGHJ-PR-TW-Z]{1}[A-CEGHJ-NPR-TW-Z]{1}[0-9]{6}[A-DFM]{0,1}$/", $value);

			case 'FR':
			case 'FRA':
				return preg_match("/^[1,2][ ]?[0-9]{2}[ ]?[0,1,2,3,5][0-9][ ]?[0-9A-Z]{5}[ ]?[0-9]{3}[ ]?[0-9]{2}$/", $value);

			default:
				return false;
		}
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
            'citizen_identification',
            'The :attribute must be a valid form of identification'
        );
    }

}