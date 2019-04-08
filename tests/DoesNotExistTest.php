<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use DB;
use Alphametric\Validation\Rules\DoesNotExist;
use Orchestra\Testbench\TestCase as Orchestra;

// Does not exist test
class DoesNotExistTest extends Orchestra
{

	/**
	 * The user object.
	 *
	 **/
	protected $user;



	/**
	 * Define the application environment.
	 *
	 * @param Application $app.
	 * @return void.
	 *
	 **/
	protected function getEnvironmentSetUp($app)
	{
		// Authentication configuration
		$app['config']->set('auth.providers.users.driver', 'database');
		$app['config']->set('auth.providers.users.table', 'users');

		// Database configuration
		$app['config']->set('database.default', 'sqlite');
		$app['config']->set('database.connections.sqlite', [
            'driver'                  => 'sqlite',
            'database'                => ':memory:',
            'prefix'                  => '',
            'foreign_key_constraints' => true,
		]);
	}



	/**
	 * Insert database records for testing purposes.
	 *
	 * @param none.
	 * @return void.
	 *
	 **/
	protected function seedDatabase()
	{
		// Migrate the database
		$this->loadMigrationsFrom(realpath(__DIR__ . '/..') . '/support/migrations');

		// Create a user
		$this->user = DB::table('users')->insertGetId([
			'name'     => 'John Doe',
			'email'    => 'john@example.com',
			'password' => bcrypt('password'),
		]);
	}



	/** @test */
	public function the_does_not_exist_rule_can_be_validated()
	{
		// Generate the fake data
		$this->seedDatabase();

		// Define the validation rule
		$rule = ['user_id' => [new DoesNotExist('users', 'id')]];

		// Execute the assertions
		$this->assertTrue(validator(['user_id' => 'non_existent_user'], $rule)->passes());
		$this->assertFalse(validator(['user_id' => $this->user], $rule)->passes());
	}

}