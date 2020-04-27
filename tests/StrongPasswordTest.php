<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\StrongPassword;
use Orchestra\Testbench\TestCase;

class StrongPasswordTest extends TestCase
{

    /** @test */
    public function the_strong_password_rule_can_be_validated()
    {
        $rule = ['password' => [new StrongPassword]];

        $this->assertFalse(validator(['password' => '1'], $rule)->passes());
        $this->assertFalse(validator(['password' => '1#'], $rule)->passes());
        $this->assertFalse(validator(['password' => 'a1#'], $rule)->passes());
        $this->assertFalse(validator(['password' => 'aB1#'], $rule)->passes());
        $this->assertFalse(validator(['password' => 'Ertbyrt123#'], $rule)->passes());
        $this->assertTrue(validator(['password' => 'Ertbyrt1234#'], $rule)->passes());
    }
}
