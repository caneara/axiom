<?php

namespace Axiom\Rules;

use Axiom\Types\Rule;

class HexColor extends Rule
{
    private array $pregMatchArray = [
        4 => '/^#([a-fA-F0-9]{3})$/i',
        7 => '/^#([a-fA-F0-9]{6})$/i',
        9 => '/^#([a-fA-F0-9]{8})$/i',
    ];

    public function passes($attribute, $value)
    {
        if (! is_string($value) || ! in_array(strlen($value), array_keys($this->pregMatchArray))) {
            return false;
        }

        $match = preg_match($this->pregMatchArray[strlen($value)], $value);

        return $match > 0;
    }

    public function message()
    {
        return $this->getLocalizedErrorMessage(
            'hex_color',
            'The :attribute has to be a valid hex color.'
        );
    }
}
