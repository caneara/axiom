<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\OddNumber;
use Orchestra\Testbench\TestCase;

class OddNumberTest extends TestCase
{

    /** @test */
    public function the_odd_number_rule_can_be_validated()
    {
        $rule = ['number' => [new OddNumber]];

        $this->assertFalse(validator(['number' => '0'], $rule)->passes());
        $this->assertTrue(validator(['number' => '1'], $rule)->passes());
        $this->assertFalse(validator(['number' => '2'], $rule)->passes());
        $this->assertTrue(validator(['number' => '3'], $rule)->passes());
    }
}
