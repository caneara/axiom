<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\Uppercase;
use Orchestra\Testbench\TestCase;

class UppercaseTest extends TestCase
{

    /** @test */
    public function the_uppercase_rule_can_be_validated()
    {
        $rule = ['text' => [new Uppercase]];

        $this->assertFalse(validator(['text' => 'hello'], $rule)->passes());
        $this->assertTrue(validator(['text' => 'HELLO'], $rule)->passes());
    }
}
