<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\LanguageCode;
use Orchestra\Testbench\TestCase;

class LanguageCodeTest extends TestCase
{

    /** @test */
    public function the_two_letter_language_code_rule_can_be_validated()
    {
        $rule = ['code' => [new LanguageCode(2)]];

        $this->assertTrue(validator(['code' => 'EL'], $rule)->passes());
        $this->assertTrue(validator(['code' => 'KL'], $rule)->passes());
        $this->assertFalse(validator(['code' => 'xx'], $rule)->passes());
    }



    /** @test */
    public function the_three_letter_language_code_rule_can_be_validated()
    {
        $rule = ['code' => [new LanguageCode(3)]];

        $this->assertTrue(validator(['code' => 'RUN'], $rule)->passes());
        $this->assertTrue(validator(['code' => 'RUS'], $rule)->passes());
        $this->assertFalse(validator(['code' => 'xxx'], $rule)->passes());
    }
}
