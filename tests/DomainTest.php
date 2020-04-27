<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\Domain;
use Orchestra\Testbench\TestCase;

class DomainTest extends TestCase
{

    /** @test */
    public function the_domain_rule_can_be_validated()
    {
        $rule = ['domain' => [new Domain]];

        $this->assertFalse(validator(['domain' => 'http://'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'https://'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'http://google.com'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'https://google.com'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'http://google'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'https://google'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'https://google.com/test'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'google.com/test'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'www.google.com/test'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'www.google.com/test/test'], $rule)->passes());
        $this->assertFalse(validator(['domain' => 'google'], $rule)->passes());
        $this->assertFalse(validator(['domain' => '1'], $rule)->passes());
        $this->assertTrue(validator(['domain' => 'google.com'], $rule)->passes());
        $this->assertTrue(validator(['domain' => 'www.google.com'], $rule)->passes());
    }
}
