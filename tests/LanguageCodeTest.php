<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\LanguageCode;
use Orchestra\Testbench\TestCase as Orchestra;

// Language code test
class LanguageCodeTest extends Orchestra
{

	/** @test */
	public function the_two_letter_language_code_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['code' => [new LanguageCode(2)]];

		// Execute the tests
		$this->assertTrue(validator(['code' => 'EL'], $rule)->passes());
		$this->assertTrue(validator(['code' => 'KL'], $rule)->passes());
		$this->assertFalse(validator(['code' => 'xx'], $rule)->passes());
	}



	/** @test */
	public function the_three_letter_language_code_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['code' => [new LanguageCode(3)]];

		// Execute the tests
		$this->assertTrue(validator(['code' => 'RUN'], $rule)->passes());
		$this->assertTrue(validator(['code' => 'RUS'], $rule)->passes());
		$this->assertFalse(validator(['code' => 'xxx'], $rule)->passes());
	}

}