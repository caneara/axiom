<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules\Tests;

// Using directives
use Axiom\Rules\Uppercase;
use Orchestra\Testbench\TestCase;

// Uppercase test
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