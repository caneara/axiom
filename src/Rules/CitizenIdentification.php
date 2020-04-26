<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;
use Axiom\Support\Iso3166Alpha2;
use Axiom\Support\Iso3166Alpha3;

class CitizenIdentification extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The rule requires one parameter:
     * 1. The identification type to use ('USA' or 'US, 'GBR' or 'GB', 'FRA' or 'FR).
     *
     **/
    public function passes($attribute, $value) : bool
    {
        $array = ($this->parameters[0] ?? 2) === 2 ? Iso3166Alpha2::$codes : Iso3166Alpha3::$codes;

        switch (mb_strtoupper($this->parameters[0] ?? 'USA')) {

            case 'US':
            case 'USA':
                return $this->verifyUnitedStates($value);

            case 'GB':
            case 'GBR':
                return $this->verifyUnitedKingdom($value);

            case 'FR':
            case 'FRA':
                return $this->verifyFrance($value);

            default:
                return false;

        }
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'citizen_identification',
            'The :attribute must be a valid form of identification'
        );
    }



    /**
     * Verify whether the given value is a valid French citizen number.
     *
     **/
    protected function verifyFrance($value) : bool
    {
        return preg_match('/^[1,2][ ]?[0-9]{2}[ ]?[0,1,2,3,5][0-9][ ]?[0-9A-Z]{5}[ ]?[0-9]{3}[ ]?[0-9]{2}$/', $value) > 0;
    }



    /**
     * Verify whether the given value is a valid United Kingdom citizen number.
     *
     **/
    protected function verifyUnitedKingdom($value) : bool
    {
        return preg_match('/^[A-CEGHJ-PR-TW-Z]{1}[A-CEGHJ-NPR-TW-Z]{1}[0-9]{6}[A-DFM]{0,1}$/', $value) > 0;
    }



    /**
     * Verify whether the given value is a valid United States citizen number.
     *
     **/
    protected function verifyUnitedStates($value) : bool
    {
        return preg_match('/^(?!000|666)[0-8][0-9]{2}-(?!00)[0-9]{2}-(?!0000)[0-9]{4}$/', $value) > 0;
    }

}