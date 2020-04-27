<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\Lowercase;
use Orchestra\Testbench\TestCase;

class LowercaseTest extends TestCase
{

    /** @test */
    public function the_lowercase_rule_can_be_validated()
    {
        $rule = ['text' => [new Lowercase]];

        $this->assertTrue(validator(['text' => 'hello'], $rule)->passes());
        $this->assertFalse(validator(['text' => 'HELLO'], $rule)->passes());
    }
}
