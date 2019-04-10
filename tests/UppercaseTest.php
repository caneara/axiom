<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\Uppercase;
use Orchestra\Testbench\TestCase as Orchestra;

// Uppercase test
class UppercaseTest extends Orchestra
{

	/** @test */
	public function the_uppercase_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['text' => [new Uppercase]];

		// Execute the tests
		$this->assertFalse(validator(['text' => 'hello'], $rule)->passes());
		$this->assertTrue(validator(['text' => 'HELLO'], $rule)->passes());
	}

}