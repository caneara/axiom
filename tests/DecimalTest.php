<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\Decimal;
use Orchestra\Testbench\TestCase;

class DecimalTest extends TestCase
{

    /** @test */
    public function the_decimal_rule_can_be_validated()
    {
        $rule = ['figure' => [new Decimal(4, 2)]];

        $this->assertFalse(validator(['figure' => '1'], $rule)->passes());
        $this->assertFalse(validator(['figure' => '123'], $rule)->passes());
        $this->assertFalse(validator(['figure' => '1234'], $rule)->passes());
        $this->assertFalse(validator(['figure' => '1234.'], $rule)->passes());
        $this->assertTrue(validator(['figure' => '1234.5'], $rule)->passes());
        $this->assertTrue(validator(['figure' => '1234.56'], $rule)->passes());
        $this->assertFalse(validator(['figure' => '1234.567'], $rule)->passes());
        $this->assertTrue(validator(['figure' => '1234.0'], $rule)->passes());
        $this->assertTrue(validator(['figure' => '1234.00'], $rule)->passes());
    }



    /** @test */
    public function the_decimal_rule_example_is_valid()
    {
        $rule = ['figure' => [$class = new Decimal(4, 2)]];

        $this->assertTrue(validator(['figure' => $class->example()], $rule)->passes());
    }
}
