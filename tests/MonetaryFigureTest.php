<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\MonetaryFigure;
use Orchestra\Testbench\TestCase;

class MonetaryFigureTest extends TestCase
{

    /** @test */
    public function the_monetary_figure_rule_can_be_validated()
    {
        $rule = ['deposit' => [new MonetaryFigure('$', 4, 4)]];

        $this->assertFalse(validator(['deposit' => '$'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$1'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$123'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$1234'], $rule)->passes());
        $this->assertFalse(validator(['deposit' => '$12345'], $rule)->passes());
        $this->assertFalse(validator(['deposit' => '$1234.'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$1234.1'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$1234.12'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$1234.123'], $rule)->passes());
        $this->assertTrue(validator(['deposit' => '$1234.1234'], $rule)->passes());
        $this->assertFalse(validator(['deposit' => '$1234.12345'], $rule)->passes());
        $this->assertFalse(validator(['deposit' => '$12345.1234'], $rule)->passes());
        $this->assertFalse(validator(['deposit' => '$abcd.efgh'], $rule)->passes());
        $this->assertFalse(validator(['deposit' => '£1234.1234'], $rule)->passes());
    }



    /** @test */
    public function the_monetary_figure_rule_example_is_valid()
    {
        $rule = ['deposit' => [$class = new MonetaryFigure('$', 4, 2)]];

        $this->assertTrue(validator(['deposit' => $class->example()], $rule)->passes());
    }
}
