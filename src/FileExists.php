<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Storage;

// File exists rule
class FileExists extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * The rule has two parameters:
     * 1. The disk defined in your config file.
     * 2. The directory to search within.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
		$path = rtrim($this->parameters[1] ?? '', '/');
		$file = ltrim($value, '/');

		return Storage::disk($this->parameters[0])->exists("$path/$file");
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
            'file_exists',
            'The file specified for :attribute does not exist'
        );
    }

}