<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Orchestra\Testbench\TestCase as Orchestra;
use Alphametric\Validation\Rules\CitizenIdentification;

// Citizen identification test
class CitizenIdentificationTest extends Orchestra
{

	/** @test */
	public function the_citizen_identification_rule_can_be_validated_for_usa()
	{
		// Define the validation rule
		$rule = ['id' => [new CitizenIdentification('usa')]];

		// Execute the tests
		$this->assertFalse(validator(['id' => 'XXX-XX-XXXX'], $rule)->passes());
		$this->assertFalse(validator(['id' => '000-11-1111'], $rule)->passes());
		$this->assertTrue(validator(['id' => '401-60-1048'], $rule)->passes());
		$this->assertTrue(validator(['id' => '318-66-9044'], $rule)->passes());

		// Define the validation rule
		$rule = ['id' => [new CitizenIdentification('us')]];

		// Execute the tests
		$this->assertFalse(validator(['id' => 'XXX-XX-XXXX'], $rule)->passes());
		$this->assertFalse(validator(['id' => '000-11-1111'], $rule)->passes());
		$this->assertTrue(validator(['id' => '401-60-1048'], $rule)->passes());
		$this->assertTrue(validator(['id' => '318-66-9044'], $rule)->passes());
	}



	/** @test */
	public function the_citizen_identification_rule_can_be_validated_for_gbr()
	{
		// Define the validation rule
		$rule = ['id' => [new CitizenIdentification('gbr')]];

		// Execute the tests
		$this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
		$this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
		$this->assertTrue(validator(['id' => 'JG103759A'], $rule)->passes());
		$this->assertTrue(validator(['id' => 'AP019283D'], $rule)->passes());

		// Define the validation rule
		$rule = ['id' => [new CitizenIdentification('gb')]];

		// Execute the tests
		$this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
		$this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
		$this->assertTrue(validator(['id' => 'JG103759A'], $rule)->passes());
		$this->assertTrue(validator(['id' => 'AP019283D'], $rule)->passes());
	}



	/** @test */
	public function the_citizen_identification_rule_can_be_validated_for_fra()
	{
		// Define the validation rule
		$rule = ['id' => [new CitizenIdentification('fra')]];

		// Execute the tests
		$this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
		$this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
		$this->assertTrue(validator(['id' => '1 51 02 46102 043 25'], $rule)->passes());

		// Define the validation rule
		$rule = ['id' => [new CitizenIdentification('fr')]];

		// Execute the tests
		$this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
		$this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
		$this->assertTrue(validator(['id' => '1 51 02 46102 043 25'], $rule)->passes());
	}

}