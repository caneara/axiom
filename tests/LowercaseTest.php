<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\Lowercase;
use Orchestra\Testbench\TestCase as Orchestra;

// Lowercase test
class LowercaseTest extends Orchestra
{

	/** @test */
	public function the_lowercase_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['text' => [new Lowercase]];

		// Execute the tests
		$this->assertTrue(validator(['text' => 'hello'], $rule)->passes());
		$this->assertFalse(validator(['text' => 'HELLO'], $rule)->passes());
	}

}