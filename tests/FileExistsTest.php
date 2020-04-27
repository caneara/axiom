<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\FileExists;
use Orchestra\Testbench\TestCase;

class FileExistsTest extends TestCase
{

    /**
     * Define the application environment.
     *
     **/
    protected function getEnvironmentSetUp($app) : void
    {
        $app['config']->set('filesystems.disks.local', [
            'driver' => 'local',
            'root'   => realpath(__DIR__ . '/..') . '/support/assets',
        ]);
    }



    /** @test */
    public function the_file_exists_rule_can_be_validated()
    {
        $rule = ['file' => [new FileExists('local', '/')]];

        $this->assertTrue(validator(['file' => 'image.png'], $rule)->passes());
        $this->assertTrue(validator(['file' => '/image.png'], $rule)->passes());
        $this->assertFalse(validator(['file' => '/fake.png'], $rule)->passes());
        $this->assertFalse(validator(['file' => 'fake.png'], $rule)->passes());
    }
}
