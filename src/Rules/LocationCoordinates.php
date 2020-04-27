<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;

class LocationCoordinates extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The latitude and longitude may have a maximum of
     * eight digits after the decimal point. This provides
     * an accuracy of up to ~1 millimeter.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        return preg_match(
            '/^[-]?((([0-8]?[0-9])(\.(\d{1,8}))?)|(90(\.0+)?)),\s?[-]?((((1[0-7][0-9])|([0-9]?[0-9]))(\.(\d{1,8}))?)|180(\.0+)?)$/',
            $value
        ) > 0;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'location_coordinates',
            'The :attribute must be a valid set of latitude and longitude coordinates, with a limit of 8 digits after a decimal point'
        );
    }
}
