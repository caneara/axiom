<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use Storage;
use Alphametric\Validation\Rules\FileExists;
use Orchestra\Testbench\TestCase as Orchestra;

// File exists test
class FileExistsTest extends Orchestra
{

	/**
	 * Define the application environment.
	 *
	 * @param Application $app.
	 * @return void.
	 *
	 **/
	protected function getEnvironmentSetUp($app)
	{
		// Storage configuration
		$app['config']->set('filesystems.disks.local', [
            'driver' => 'local',
            'root'   => realpath(__DIR__ . '/..') . '/support/assets',
		]);
	}



	/** @test */
	public function the_file_exists_rule_can_be_validated()
	{
		// Define the validation rule
		$rule = ['file' => [new FileExists('local', '/')]];

		// Execute the assertions
		$this->assertTrue(validator(['file' => 'image.png'], $rule)->passes());
		$this->assertTrue(validator(['file' => '/image.png'], $rule)->passes());
		$this->assertFalse(validator(['file' => '/fake.png'], $rule)->passes());
		$this->assertFalse(validator(['file' => 'fake.png'], $rule)->passes());
	}

}