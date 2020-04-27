<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\EvenNumber;
use Orchestra\Testbench\TestCase;

class EvenNumberTest extends TestCase
{

    /** @test */
    public function the_even_number_rule_can_be_validated()
    {
        $rule = ['number' => [new EvenNumber]];

        $this->assertFalse(validator(['number' => '1'], $rule)->passes());
        $this->assertTrue(validator(['number' => '2'], $rule)->passes());
        $this->assertFalse(validator(['number' => '3'], $rule)->passes());
        $this->assertTrue(validator(['number' => '4'], $rule)->passes());
    }
}
