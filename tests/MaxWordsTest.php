<?php declare(strict_types=1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\MaxWords;
use Orchestra\Testbench\TestCase;

class MaxWordsTest extends TestCase
{

    /**
     * @test
     * @dataProvider provideSentences
     */
    public function the_max_words_rule_can_be_validated($data)
    {
        $rule = ['text' => [new MaxWords($data['max_words'])]];
        $this->assertEquals($data['passes'], validator(['text' => $data['text']], $rule)->passes());
    }



    /**
     * Retrieve the seed data for the test.
     *
     */
    public function provideSentences() : array
    {
        return [
            [
                ['text' => 'hello world', 'max_words' => 2, 'passes' => true],
            ], [
                ['text' => 'مرحبا بالعالم', 'max_words' => 2, 'passes' => true],
            ], [
                ['text' => 'This sentence contains more than 2 words', 'max_words' => 2, 'passes' => false],
            ], [
                ['text' => 'Three words sentence', 'max_words' => 3, 'passes' => true],
            ],[
                ['text' => 'مرحبا بالعالم من التحقق', 'max_words' => 3, 'passes' => false],
            ],
        ];
    }
}
