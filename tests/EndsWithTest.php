<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\EndsWith;
use Orchestra\Testbench\TestCase as Orchestra;

// Ends with test
class EndsWithTest extends Orchestra
{

	/** @test */
	public function the_ends_with_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['text' => [new EndsWith('world')]];

		// Execute the tests
		$this->assertFalse(validator(['text' => 'hello'], $rule)->passes());
		$this->assertTrue(validator(['text' => 'hello world'], $rule)->passes());
		$this->assertFalse(validator(['text' => 'hello worldy'], $rule)->passes());
	}

}