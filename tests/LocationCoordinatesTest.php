<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Orchestra\Testbench\TestCase as Orchestra;
use Alphametric\Validation\Rules\LocationCoordinates;

// Location coordinates test
class LocationCoordinatesTest extends Orchestra
{

	/** @test */
	public function the_location_coordinates_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['location' => [new LocationCoordinates]];

		// Execute the tests
		$this->assertFalse(validator(['location' => '1'], $rule)->passes());
		$this->assertTrue(validator(['location' => '1, 1'], $rule)->passes());
		$this->assertTrue(validator(['location' => '1.0,1.0'], $rule)->passes());
		$this->assertTrue(validator(['location' => '90.0,180.0'], $rule)->passes());
		$this->assertFalse(validator(['location' => '90.0,181.0'], $rule)->passes());
		$this->assertFalse(validator(['location' => '91.0,180.0'], $rule)->passes());
		$this->assertTrue(validator(['location' => '-77.0364335, 38.8951555'], $rule)->passes());
		$this->assertTrue(validator(['location' => '-77.03643357, 38.8951555'], $rule)->passes());
		$this->assertTrue(validator(['location' => '-77.0364335, 38.89515557'], $rule)->passes());
		$this->assertFalse(validator(['location' => '-77.036433576, 38.8951555'], $rule)->passes());
		$this->assertFalse(validator(['location' => '-77.0364335, 38.895155576'], $rule)->passes());
	}

}