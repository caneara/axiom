<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\Equals;
use Orchestra\Testbench\TestCase as Orchestra;

// Equals test
class EqualsTest extends Orchestra
{

	/** @test */
	public function the_equals_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['value' => [new Equals('2')]];

		// Execute the tests
		$this->assertFalse(validator(['value' => '0'], $rule)->passes());
		$this->assertFalse(validator(['value' => '1'], $rule)->passes());
		$this->assertTrue(validator(['value' => '2'], $rule)->passes());
		$this->assertFalse(validator(['value' => '3'], $rule)->passes());
	}

}