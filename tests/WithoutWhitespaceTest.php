<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Orchestra\Testbench\TestCase;
use Axiom\Rules\WithoutWhitespace;

class WithoutWhitespaceTest extends TestCase
{

    /** @test */
    public function the_without_whitespace_rule_can_be_validated()
    {
        $rule = ['text' => [new WithoutWhitespace]];

        $this->assertFalse(validator(['text' => 'hello  '], $rule)->passes());
        $this->assertFalse(validator(['text' => '  hello'], $rule)->passes());
        $this->assertFalse(validator(['text' => 'hello world'], $rule)->passes());
        $this->assertTrue(validator(['text' => 'hello'], $rule)->passes());
    }
}
