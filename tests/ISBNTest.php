<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\ISBN;
use Orchestra\Testbench\TestCase;

class ISBNTest extends TestCase
{

    /** @test */
    public function the_isbn_rule_can_be_validated()
    {
        $rule = ['book' => [new ISBN]];

        $this->assertFalse(validator(['book' => '1'], $rule)->passes());
        $this->assertFalse(validator(['book' => '1#'], $rule)->passes());
        $this->assertFalse(validator(['book' => 'a1#'], $rule)->passes());
        $this->assertTrue(validator(['book' => 'ISBN 978-0-596-52068-7'], $rule)->passes());
        $this->assertTrue(validator(['book' => 'ISBN-13: 978-0-596-52068-7'], $rule)->passes());
        $this->assertTrue(validator(['book' => '978 0 596 52068 7'], $rule)->passes());
        $this->assertTrue(validator(['book' => '9780596520687'], $rule)->passes());
        $this->assertTrue(validator(['book' => 'ISBN-10 0-596-52068-9'], $rule)->passes());
        $this->assertTrue(validator(['book' => '0-596-52068-9'], $rule)->passes());
    }
}
