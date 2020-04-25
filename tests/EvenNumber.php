<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules\Tests;

// Using directives
use Axiom\Rules\EvenNumber;
use Orchestra\Testbench\TestCase;

// Even number test
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