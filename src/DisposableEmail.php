<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Str;
use Exception;

// Disposable email rule
class DisposableEmail extends Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * By default, if the API fails to load, the email will
     * be accepted. However, you can override this by adding
     * a boolean parameter e.g. new DisposableEmail(true).
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        $url = 'https://open.kickbox.com/v1/disposable/' . Str::after($value, '@');

        try {
            return ! json_decode(file_get_contents($url), true)['disposable'];
        } catch (Exception $ex) {
            return ($this->parameters[0] ?? false) ? false : true;
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
            'disposable_email',
            'The :attribute must be a valid, non-disposable domain'
        );
    }

}