<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\MacAddress;
use Orchestra\Testbench\TestCase as Orchestra;

// Mac address test
class MacAddressTest extends Orchestra
{

	/** @test */
	public function the_mac_address_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['address' => [new MacAddress]];

		// Execute the tests
		$this->assertTrue(validator(['address' => '3D:F2:C9:A6:B3:4F'], $rule)->passes());
		$this->assertTrue(validator(['address' => '3D-F2-C9-A6-B3-4F'], $rule)->passes());
		$this->assertFalse(validator(['address' => '00:00:00:00:00:00:00'], $rule)->passes());
	}

}