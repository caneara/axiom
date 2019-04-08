<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\Decimal;
use Orchestra\Testbench\TestCase as Orchestra;

// Decimal test
class DecimalTest extends Orchestra
{

	/** @test */
	public function the_decimal_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['figure' => [new Decimal(4, 2)]];

		// Execute the tests
		$this->assertFalse(validator(['figure' => '1'], $rule)->passes());
		$this->assertFalse(validator(['figure' => '123'], $rule)->passes());
		$this->assertFalse(validator(['figure' => '1234'], $rule)->passes());
		$this->assertFalse(validator(['figure' => '1234.'], $rule)->passes());
		$this->assertTrue(validator(['figure' => '1234.5'], $rule)->passes());
		$this->assertTrue(validator(['figure' => '1234.56'], $rule)->passes());
		$this->assertFalse(validator(['figure' => '1234.567'], $rule)->passes());
		$this->assertTrue(validator(['figure' => '1234.0'], $rule)->passes());
		$this->assertTrue(validator(['figure' => '1234.00'], $rule)->passes());
	}



	/** @test */
	public function the_decimal_rule_example_is_valid()
	{
		// Define the validation rule
		$rule = ['figure' => [$class = new Decimal(4, 2)]];

		// Execute the tests
		$this->assertTrue(validator(['figure' => $class -> example()], $rule)->passes());
	}

}