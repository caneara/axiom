<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Orchestra\Testbench\TestCase as Orchestra;
use Alphametric\Validation\Rules\StrongPassword;

// Strong password test
class StrongPasswordTest extends Orchestra
{

	/** @test */
	public function the_strong_password_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['password' => [new StrongPassword]];

		// Execute the tests
		$this->assertFalse(validator(['password' => '1'], $rule)->passes());
		$this->assertFalse(validator(['password' => '1#'], $rule)->passes());
		$this->assertFalse(validator(['password' => 'a1#'], $rule)->passes());
		$this->assertFalse(validator(['password' => 'aB1#'], $rule)->passes());
		$this->assertFalse(validator(['password' => 'Ertbyrt123#'], $rule)->passes());
		$this->assertTrue(validator(['password' => 'Ertbyrt1234#'], $rule)->passes());
	}

}