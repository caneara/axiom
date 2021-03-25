<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Orchestra\Testbench\TestCase;
use Axiom\Rules\CitizenIdentification;

class CitizenIdentificationTest extends TestCase
{

    /** @test */
    public function the_citizen_identification_rule_can_be_validated_for_usa()
    {
        $rule = ['id' => [new CitizenIdentification('usa')]];

        $this->assertFalse(validator(['id' => 'XXX-XX-XXXX'], $rule)->passes());
        $this->assertFalse(validator(['id' => '000-11-1111'], $rule)->passes());
        $this->assertTrue(validator(['id' => '401-60-1048'], $rule)->passes());
        $this->assertTrue(validator(['id' => '318-66-9044'], $rule)->passes());

        $rule = ['id' => [new CitizenIdentification('us')]];

        $this->assertFalse(validator(['id' => 'XXX-XX-XXXX'], $rule)->passes());
        $this->assertFalse(validator(['id' => '000-11-1111'], $rule)->passes());
        $this->assertTrue(validator(['id' => '401-60-1048'], $rule)->passes());
        $this->assertTrue(validator(['id' => '318-66-9044'], $rule)->passes());
    }



    /** @test */
    public function the_citizen_identification_rule_can_be_validated_for_gbr()
    {
        $rule = ['id' => [new CitizenIdentification('gbr')]];

        $this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
        $this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
        $this->assertTrue(validator(['id' => 'JG103759A'], $rule)->passes());
        $this->assertTrue(validator(['id' => 'AP019283D'], $rule)->passes());

        $rule = ['id' => [new CitizenIdentification('gb')]];

        $this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
        $this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
        $this->assertTrue(validator(['id' => 'JG103759A'], $rule)->passes());
        $this->assertTrue(validator(['id' => 'AP019283D'], $rule)->passes());
    }



    /** @test */
    public function the_citizen_identification_rule_can_be_validated_for_fra()
    {
        $rule = ['id' => [new CitizenIdentification('fra')]];

        $this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
        $this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
        $this->assertTrue(validator(['id' => '1 51 02 46102 043 25'], $rule)->passes());

        $rule = ['id' => [new CitizenIdentification('fr')]];

        $this->assertFalse(validator(['id' => 'DC135798A'], $rule)->passes());
        $this->assertFalse(validator(['id' => 'FQ987654C'], $rule)->passes());
        $this->assertTrue(validator(['id' => '1 51 02 46102 043 25'], $rule)->passes());
    }



    /** @test */
    public function the_citizen_identification_rule_can_be_validated_for_bra()
    {
        $rule = ['id' => [new CitizenIdentification('bra')]];

        $this->assertFalse(validator(['id' => '9876543218'], $rule)->passes());
        $this->assertFalse(validator(['id' => '03464227362'], $rule)->passes());
        $this->assertTrue(validator(['id' => '166.525.300-23'], $rule)->passes());
        $this->assertTrue(validator(['id' => '16652530023'], $rule)->passes());

        $rule = ['id' => [new CitizenIdentification('br')]];

        $this->assertFalse(validator(['id' => '9876543218'], $rule)->passes());
        $this->assertFalse(validator(['id' => '03464227362'], $rule)->passes());
        $this->assertTrue(validator(['id' => '166.525.300-23'], $rule)->passes());
        $this->assertTrue(validator(['id' => '16652530023'], $rule)->passes());
    }
    /** @test */
    public function the_citizen_identification_rule_can_be_validated_for_vn()
    {
        $rule = ['id' => [new CitizenIdentification('vn')]];

        $this->assertFalse(validator(['id' => '101597002120'], $rule)->passes());
        $this->assertFalse(validator(['id' => '0501991234561'], $rule)->passes());
        $this->assertTrue(validator(['id' => '001097002120'], $rule)->passes());
        $this->assertTrue(validator(['id' => '050199123456'], $rule)->passes());

        $rule = ['id' => [new CitizenIdentification('vi')]];

        $this->assertFalse(validator(['id' => '101597002120'], $rule)->passes());
        $this->assertFalse(validator(['id' => '0501991234561'], $rule)->passes());
        $this->assertTrue(validator(['id' => '001097002120'], $rule)->passes());
        $this->assertTrue(validator(['id' => '050199123456'], $rule)->passes());
    }
}
