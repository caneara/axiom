<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;
use Axiom\Support\Iso6391Alpha2;
use Axiom\Support\Iso6391Alpha3;

class LanguageCode extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        $array = ($this->parameters[0] ?? 2) === 2 ? Iso6391Alpha2::$codes : Iso6391Alpha3::$codes;

        return array_key_exists(strtoupper($value), $array);
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'language_code',
            'The :attribute must be a valid ISO 639-1 alpha-' . ($this->parameters[0] ?? 2) . ' language code'
        );
    }
}
