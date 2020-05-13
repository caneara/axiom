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
            stream_get_meta_data($this->file)['uri'],
            'image',
            'text/plain',
            null,
            true,
            true
        );
    }



    /**
     * Determine if the validation rule passes.
     *
     * The rule requires at least a single parameter, which is
     * the expected mime types of the file e.g. png, jpeg etc.
     * You can also supply multiple mime types as an array.
     *
     **/
    public function passes($attribute, $value) : bool
    {
        $valid_mime = false;

        foreach ($this->parameters as $mime) {
            if (Str::startsWith($value, "data:image/$mime;base64,")) {
                $valid_mime = true;

                break;
            }
        }

        if ($valid_mime) {
            $result = validator(['file' => $this->createTemporaryFile($value)], ['file' => 'image'])->passes();

            fclose($this->file);

            return $result;
        }

        return false;
    }



    /**
     * Get the validation error message.
     *
     **/
    public function message() : string
    {
        $mimes = $this->parameters;

        if (count($mimes) === 1) {
            return $this->getLocalizedErrorMessage(
                'encoded_image',
                'The :attribute must be a valid ' . $mimes[0] . ' image'
            );
        }

        $mimes[count($mimes) - 1] = 'or ' . $mimes[count($mimes) - 1];

        return $this->getLocalizedErrorMessage(
            'encoded_image',
            'The :attribute must be a valid ' . implode(', ', $mimes) . ' image'
        );
    }
}
