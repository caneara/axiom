<?php

namespace Axiom\Rules\Tests;

use Axiom\Rules\HexColor;
use Orchestra\Testbench\TestCase;

class HexColorTest extends TestCase
{
    /** @test */
    public function it_can_validate_hex_color()
    {
        $rule = ['hex_color' => [new HexColor()]];

        $this->assertTrue(validator(['hex_color' => '#f0f0f0'], $rule)->passes());
        $this->assertFalse(validator(['hex_color' => '#f0f0f0ff'], $rule)->passes());
        $this->assertFalse(validator(['hex_color' => 'f0f0f0'], $rule)->passes());
        $this->assertFalse(validator(['hex_color' => 'rgb(0,0,255)'], $rule)->passes());
        $this->assertTrue(validator(['hex_color' => '#000000'], $rule)->passes());
    }
}
