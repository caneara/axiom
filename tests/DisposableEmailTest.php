<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Orchestra\Testbench\TestCase as Orchestra;
use Alphametric\Validation\Rules\DisposableEmail;

// Disposable email test
class DisposableEmailTest extends Orchestra
{

	/** @test */
	public function the_disposable_email_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['email' => ['bail', 'email', new DisposableEmail()]];

		// Execute the tests
		$this->assertTrue(validator(['email' => 'john.doe@gmail.com'], $rule)->passes());
		$this->assertFalse(validator(['email' => 'john.doe@mailinator.com'], $rule)->passes());
	}

}