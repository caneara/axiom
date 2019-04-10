<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\Titlecase;
use Orchestra\Testbench\TestCase as Orchestra;

// Titlecase test
class TitlecaseTest extends Orchestra
{

	/** @test */
	public function the_titlecase_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['text' => [new Titlecase]];

		// Execute the tests
		$this->assertFalse(validator(['text' => 'hello world'], $rule)->passes());
		$this->assertFalse(validator(['text' => 'Hello world'], $rule)->passes());
		$this->assertFalse(validator(['text' => 'hello World'], $rule)->passes());
		$this->assertTrue(validator(['text' => 'Hello World'], $rule)->passes());
		$this->assertTrue(validator(['text' => 'HELLO WORLD'], $rule)->passes());
	}

}