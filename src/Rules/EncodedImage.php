<?php declare(strict_types = 1);

namespace Axiom\Rules;

use Axiom\Types\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class EncodedImage extends Rule
{

    /**
     * Pointer to the temporary file.
     *
     **/
    protected $file;



    /**
     * Write the given data to a temporary file.
     *
     **/
    protected function createTemporaryFile(string $data) : UploadedFile
    {
        $this->file = tmpfile();

        fwrite($this->file, base64_decode(Str::after($data, 'base64,')));

        return new UploadedFile(
            stream_get_meta_data($this->file)['uri'], 'image',
            'text/plain', null, true, true
        );
    }



    /**
     * Determine if the validation rule passes.
     *
     * The rule requires a single parameter, which is
     * the expected mime type of the file e.g. png, jpeg etc.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        if (! Str::startsWith($value, "data:image/{$this->parameters[0]};base64,")) {
            return false;
        }

        $result = validator(['file' => $this->createTemporaryFile($value)], ['file' => 'image'])->passes();

        fclose($this->file);

        return $result;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        return $this->getLocalizedErrorMessage(
            'encoded_image',
            "The :attribute must be a valid {$this->parameters[0]} image"
        );
    }

}