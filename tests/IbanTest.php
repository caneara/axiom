<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Alphametric\Validation\Rules\Iban;
use Orchestra\Testbench\TestCase as Orchestra;

// Domain test
class IbanTest extends Orchestra
{

	/** @test */
	public function the_iban_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['iban' => [new Iban]];

		// Execute the tests
		// for reference https://www.iban.com/testibans
		
		$this->assertFalse(validator(['iban' => 'GB94BARC20201530093459'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB96BARC202015300934591'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB02BARC20201530093451'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB68CITI18500483515538'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB24BARC20201630093459'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB12BARC20201530093A59'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB78BARCO0201530093459'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB2LABBY09012857201707'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB01BARC20714583608387'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB00HLFX11016111455365'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'US64SVBKUS6S3300958879'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB33BUKB20201555555555'], $rule)->passes());
		$this->assertFalse(validator(['iban' => 'GB94BARC10201530093459'], $rule)->passes());
	}

}
