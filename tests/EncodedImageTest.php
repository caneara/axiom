<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\EncodedImage;
use Orchestra\Testbench\TestCase as Orchestra;

// Encoded image test
class EncodedImageTest extends Orchestra
{

	/**
	 * Retrieve the contents of a given file.
	 *
	 * @param string $file_name.
	 * @return string.
	 *
	 **/
	protected function getFile($file_name)
	{
		$path = realpath(__DIR__ . '/..') . "/support/assets/$file_name";

		$extension = pathinfo($path, PATHINFO_EXTENSION);

		return "data:image/{$extension};base64," . base64_encode(file_get_contents($path));
	}



	/**
	 * Generate an invalid image file with a given mime type.
	 *
	 * @param string $mime.
	 * @return string.
	 *
	 **/
	protected function invalidImage($mime = "")
	{
		return "data:image/{$mime};base64," . base64_encode("not an image file");
	}



	/** @test */
	public function the_encoded_jpeg_image_rule_can_be_validated()
	{
		// Define the validation rule
		$png_rule  = ['image' => [new EncodedImage('png')]];
		$jpeg_rule = ['image' => [new EncodedImage('jpeg')]];

		// Execute the tests
		$this->assertFalse(validator(['image' => $this->getFile('image.jpeg')], $png_rule)->passes());
		$this->assertTrue(validator(['image' => $this->getFile('image.png')], $png_rule)->passes());
		$this->assertTrue(validator(['image' => $this->getFile('image.jpeg')], $jpeg_rule)->passes());
		$this->assertFalse(validator(['image' => $this->getFile('image.png')], $jpeg_rule)->passes());
		$this->assertFalse(validator(['image' => $this->invalidImage('image.jpeg')], $jpeg_rule)->passes());
		$this->assertFalse(validator(['image' => $this->invalidImage('image.png')], $jpeg_rule)->passes());
		$this->assertFalse(validator(['image' => $this->invalidImage()], $jpeg_rule)->passes());
	}

}