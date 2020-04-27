<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\Titlecase;
use Orchestra\Testbench\TestCase;

class TitlecaseTest extends TestCase
{

    /** @test */
    public function the_titlecase_rule_can_be_validated()
    {
        $rule = ['text' => [new Titlecase]];

        $this->assertFalse(validator(['text' => 'hello world'], $rule)->passes());
        $this->assertFalse(validator(['text' => 'Hello world'], $rule)->passes());
        $this->assertFalse(validator(['text' => 'hello World'], $rule)->passes());
        $this->assertTrue(validator(['text' => 'Hello World'], $rule)->passes());
        $this->assertTrue(validator(['text' => 'HELLO WORLD'], $rule)->passes());
    }
}
