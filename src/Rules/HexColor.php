<?php

namespace Axiom\Rules;

use Axiom\Types\Rule;

class HexColor extends Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^#([a-fA-F0-9]{6})$/i', $value) > 0;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return $this->getLocalizedErrorMessage(
            'hex_color',
            'The :attribute has to be a valid hex color.'
        );
    }
}
