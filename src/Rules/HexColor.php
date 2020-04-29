<?php

namespace Axiom\Rules;

use Axiom\Types\Rule;

class HexColor extends Rule
{
    /**
     * Hex color regex formats.
     *
     */
    private array $formats = [
        4 => '/^#([a-fA-F0-9]{3})$/i',
        7 => '/^#([a-fA-F0-9]{6})$/i',
        9 => '/^#([a-fA-F0-9]{6}[0-9]{2})$/i',
    ];

    /**
     * Determines if the rule passes.
     *
     * @param string $attribute
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! is_string($value) || ! in_array(strlen($value), array_keys($this->formats))) {
            return false;
        }

        $match = preg_match($this->formats[strlen($value)], $value);

        return $match > 0;
    }

    /**
     * Message returned on validation failure.
     *
     * @return array|string
     */
    public function message()
    {
        return $this->getLocalizedErrorMessage(
            'hex_color',
            'The :attribute has to be a valid hex color.'
        );
    }
}
