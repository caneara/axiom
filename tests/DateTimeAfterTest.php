<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Orchestra\Testbench\TestCase as Orchestra;
use Alphametric\Validation\Rules\DateTimeAfter;

// Date time after test
class DateTimeAfterTest extends Orchestra
{

	/** @test */
	public function the_date_time_after_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['datetime' => [new DateTimeAfter(now()->format('Y-m-d H:i:s'))]];

		// Execute the tests
		$this->assertFalse(validator(['datetime' => now()->format('Y-m-d H:i:s')], $rule)->passes());
		$this->assertFalse(validator(['datetime' => now()->subMinute()->format('Y-m-d H:i:s')], $rule)->passes());
		$this->assertTrue(validator(['datetime' => now()->addMinute()->format('Y-m-d H:i:s')], $rule)->passes());
	}

}