<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\OddNumber;
use Orchestra\Testbench\TestCase as Orchestra;

// Odd number test
class OddNumberTest extends Orchestra
{

	/** @test */
	public function the_odd_number_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['number' => [new OddNumber]];

		// Execute the tests
		$this->assertFalse(validator(['number' => '0'], $rule)->passes());
		$this->assertTrue(validator(['number' => '1'], $rule)->passes());
		$this->assertFalse(validator(['number' => '2'], $rule)->passes());
		$this->assertTrue(validator(['number' => '3'], $rule)->passes());
	}

}