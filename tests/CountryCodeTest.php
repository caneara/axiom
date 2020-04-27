<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\CountryCode;
use Orchestra\Testbench\TestCase;

class CountryCodeTest extends TestCase
{

    /** @test */
    public function the_two_letter_country_code_rule_can_be_validated()
    {
        $rule = ['code' => [new CountryCode(2)]];

        $this->assertTrue(validator(['code' => 'US'], $rule)->passes());
        $this->assertTrue(validator(['code' => 'GB'], $rule)->passes());
        $this->assertTrue(validator(['code' => 'FR'], $rule)->passes());
        $this->assertFalse(validator(['code' => 'xx'], $rule)->passes());
    }



    /** @test */
    public function the_three_letter_country_code_rule_can_be_validated()
    {
        $rule = ['code' => [new CountryCode(3)]];

        $this->assertTrue(validator(['code' => 'USA'], $rule)->passes());
        $this->assertTrue(validator(['code' => 'GBR'], $rule)->passes());
        $this->assertTrue(validator(['code' => 'FRA'], $rule)->passes());
        $this->assertFalse(validator(['code' => 'xxx'], $rule)->passes());
    }
}
