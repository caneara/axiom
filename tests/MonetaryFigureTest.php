<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Orchestra\Testbench\TestCase as Orchestra;
use Alphametric\Validation\Rules\MonetaryFigure;

// Monetary figure test
class MonetaryFigureTest extends Orchestra
{

	/** @test */
	public function the_monetary_figure_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['deposit' => [new MonetaryFigure('$', 4, 4)]];

		// Execute the tests
		$this->assertFalse(validator(['deposit' => '$'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$1'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$123'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$1234'], $rule)->passes());
		$this->assertFalse(validator(['deposit' => '$12345'], $rule)->passes());
		$this->assertFalse(validator(['deposit' => '$1234.'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$1234.1'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$1234.12'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$1234.123'], $rule)->passes());
		$this->assertTrue(validator(['deposit' => '$1234.1234'], $rule)->passes());
		$this->assertFalse(validator(['deposit' => '$1234.12345'], $rule)->passes());
		$this->assertFalse(validator(['deposit' => '$12345.1234'], $rule)->passes());
		$this->assertFalse(validator(['deposit' => '$abcd.efgh'], $rule)->passes());
		$this->assertFalse(validator(['deposit' => '£1234.1234'], $rule)->passes());
	}



	/** @test */
	public function the_monetary_figure_rule_example_is_valid()
	{
		// Define the validation rule
		$rule = ['deposit' => [$class = new MonetaryFigure('$', 4, 2)]];

		// Execute the tests
		$this->assertTrue(validator(['deposit' => $class->example()], $rule)->passes());
	}

}