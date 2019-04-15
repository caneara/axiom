<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\WithoutWhitespace;
use Orchestra\Testbench\TestCase as Orchestra;

// Without whitespace test
class WithoutWhitespaceTest extends Orchestra
{

	/** @test */
	public function the_without_whitespace_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['text' => [new WithoutWhitespace]];

		// Execute the tests
		$this->assertFalse(validator(['text' => 'hello  '], $rule)->passes());
		$this->assertFalse(validator(['text' => '  hello'], $rule)->passes());
		$this->assertFalse(validator(['text' => 'hello world'], $rule)->passes());
		$this->assertTrue(validator(['text' => 'hello'], $rule)->passes());
	}

}