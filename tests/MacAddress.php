<?php declare(strict_types = 1);

// Namespace
namespace Axiom\Rules\Tests;

// Using directives
use Axiom\Rules\MacAddress;
use Orchestra\Testbench\TestCase;

// Mac address test
class MacAddressTest extends TestCase
{

    /** @test */
    public function the_mac_address_rule_can_be_validated()
    {
        $rule = ['address' => [new MacAddress]];

        $this->assertTrue(validator(['address' => '3D:F2:C9:A6:B3:4F'], $rule)->passes());
        $this->assertTrue(validator(['address' => '3D-F2-C9-A6-B3-4F'], $rule)->passes());
        $this->assertFalse(validator(['address' => '00:00:00:00:00:00:00'], $rule)->passes());
    }

}