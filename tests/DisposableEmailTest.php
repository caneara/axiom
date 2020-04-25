<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules\Tests;

// Using directives
use Axiom\Rules\DisposableEmail;
use Orchestra\Testbench\TestCase;

// Disposable email test
class DisposableEmailTest extends TestCase
{

    /** @test */
    public function the_disposable_email_rule_can_be_validated()
    {
        $rule = ['email' => ['bail', 'email', new DisposableEmail()]];

        $this->assertTrue(validator(['email' => 'john.doe@gmail.com'], $rule)->passes());
        $this->assertFalse(validator(['email' => 'john.doe@mailinator.com'], $rule)->passes());
    }

}