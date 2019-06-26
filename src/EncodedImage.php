<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

// Encoded image rule
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
	 * @param string $data.
	 * @return UploadedFile.
	 *
	 **/
	protected function createTemporaryFile($data)
	{
		$this->file = tmpfile();

		fwrite($this->file, base64_decode(Str::after($data, 'base64,')));

		return new UploadedFile(
			stream_get_meta_data($this->file)['uri'], 'image',
			'text/plain', null, null, true
		);
	}



    /**
     * Determine if the validation rule passes.
     *
     * The rule requires a single parameter, which is
	 * the expected mime type of the file e.g. png, jpeg etc.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
		if (! Str::startsWith($value, "data:image/{$this->parameters[0]};base64,")) {
			return false;
		}

		$result = validator(['file' => $this->createTemporaryFile($value)], ['file' => 'image'])
			   -> passes();

		fclose($this->file);

		return $result;
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
            'encoded_image',
            "The :attribute must be a valid {$this->parameters[0]} image"
        );
    }

}