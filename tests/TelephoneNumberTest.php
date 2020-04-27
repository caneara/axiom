<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\TelephoneNumber;
use Orchestra\Testbench\TestCase;

class TelephoneNumberTest extends TestCase
{

    /** @test */
    public function the_telephone_number_rule_can_be_validated()
    {
        $rule = ['phone' => [new TelephoneNumber]];

        $this->assertFalse(validator(['phone' => '1'], $rule)->passes());
        $this->assertFalse(validator(['phone' => '1#'], $rule)->passes());
        $this->assertFalse(validator(['phone' => 'a1#'], $rule)->passes());
        $this->assertFalse(validator(['phone' => 'aB1#'], $rule)->passes());
        $this->assertFalse(validator(['phone' => '123456'], $rule)->passes());
        $this->assertFalse(validator(['phone' => '1234567890123456'], $rule)->passes());
        $this->assertTrue(validator(['phone' => '123456789'], $rule)->passes());
    }
}
