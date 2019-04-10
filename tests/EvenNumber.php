<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\EvenNumber;
use Orchestra\Testbench\TestCase as Orchestra;

// Even number test
class EvenNumberTest extends Orchestra
{

	/** @test */
	public function the_even_number_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['number' => [new EvenNumber]];

		// Execute the tests
		$this->assertFalse(validator(['number' => '1'], $rule)->passes());
		$this->assertTrue(validator(['number' => '2'], $rule)->passes());
		$this->assertFalse(validator(['number' => '3'], $rule)->passes());
		$this->assertTrue(validator(['number' => '4'], $rule)->passes());
	}

}