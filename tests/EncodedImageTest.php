<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\EncodedImage;
use Orchestra\Testbench\TestCase;

class EncodedImageTest extends TestCase
{

    /**
     * Retrieve the contents of a given file.
     *
     **/
    protected function getFile(string $file_name) : string
    {
        $path = realpath(__DIR__ . '/..') . "/support/assets/$file_name";

        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return "data:image/{$extension};base64," . base64_encode(file_get_contents($path));
    }



    /**
     * Generate an invalid image file with a given mime type.
     *
     **/
    protected function invalidImage(string $mime = '') : string
    {
        return "data:image/{$mime};base64," . base64_encode('not an image file');
    }



    /** @test */
    public function the_encoded_jpeg_image_rule_can_be_validated()
    {
        $png_rule      = ['image' => [new EncodedImage('png')]];
        $jpeg_rule     = ['image' => [new EncodedImage('jpeg')]];
        $multiple_rule = ['image' => [new EncodedImage('jpeg', 'png')]];

        $this->assertFalse(validator(['image' => $this->getFile('image.jpeg')], $png_rule)->passes());
        $this->assertTrue(validator(['image' => $this->getFile('image.png')], $png_rule)->passes());
        $this->assertTrue(validator(['image' => $this->getFile('image.jpeg')], $jpeg_rule)->passes());
        $this->assertFalse(validator(['image' => $this->getFile('image.png')], $jpeg_rule)->passes());

        $this->assertTrue(validator(['image' => $this->getFile('image.png')], $multiple_rule)->passes());
        $this->assertTrue(validator(['image' => $this->getFile('image.jpeg')], $multiple_rule)->passes());
        $this->assertFalse(validator(['image' => $this->getFile('image.tiff')], $multiple_rule)->passes());

        $this->assertFalse(validator(['image' => $this->invalidImage('image.jpeg')], $jpeg_rule)->passes());
        $this->assertFalse(validator(['image' => $this->invalidImage('image.png')], $jpeg_rule)->passes());
        $this->assertFalse(validator(['image' => $this->invalidImage()], $jpeg_rule)->passes());
    }
}
