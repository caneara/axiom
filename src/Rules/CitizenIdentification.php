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
     * 1. The identification type to use ('USA' or 'US, 'GBR' or 'GB', 'FRA' or 'FR', 'BRA' or 'BR').
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

            case 'BR':
            case 'BRA':
                return $this->verifyBrazil($value);
            
            case 'VI':
            case 'VN':
                return $this->verifyVietnam($value);

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



    /**
     * Verify whether the given value is a valid Brazil citizen number.
     *
     **/
    protected function verifyBrazil($value) : bool
    {
        $value = preg_replace('/[^0-9]/is', '', $value);

        if (strlen($value) !== 11 || preg_match('/(\d)\1{10}/', $value)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $value[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($value[$c] != $d) {
                return false;
            }
        }

        return true;
    }
    /**
     * Verify whether the given value is a valid Vietnam citizen number.
     *
     **/
    protected function verifyVietnam($value) : bool
    {
        $state        = '0\d{2}'; // state code
        $century      = ceil(date('Y') / 100); // current century
        $minNumGender = 0; //century: 20, male: 0, female: 1
        // 20: begin century
        $maxNumGender = 1 + ($century - 20) * 2; //ex: century: 21, male: 2, female: 3. max: century: 25, male: 8, female: 9
        $numBirth     = '\d{2}'; // last 2 number of birth year
        $numRand      = '\d{6}'; // 6 random number

        return preg_match('/^'.$state.'['.$minNumGender.'-'.$maxNumGender.']'.$numBirth.$numRand.'$/', $value) > 0;
    }
}
