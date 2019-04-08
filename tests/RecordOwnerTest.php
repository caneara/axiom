<?php

// Namespace
namespace Alphametric\Validation\Rules\Tests;

// Using directives
use DB;
use Auth;
use Alphametric\Validation\Rules\RecordOwner;
use Orchestra\Testbench\TestCase as Orchestra;

// Record owner test
class RecordOwnerTest extends Orchestra
{

	/**
	 * The other user object.
	 *
	 **/
	protected $other;



	/**
	 * The owner user object.
	 *
	 **/
	protected $owner;



	/**
	 * The post object.
	 *
	 **/
	protected $post;



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

		// Create a owner user
		$this->owner = DB::table('users')->insertGetId([
			'name'     => 'John Doe',
			'email'    => 'john@example.com',
			'password' => bcrypt('password'),
		]);

		// Create another user
		$this->other = DB::table('users')->insertGetId([
			'name'     => 'Jane Doe',
			'email'    => 'jane@example.com',
			'password' => bcrypt('password'),
		]);

		// Create a post
		$this->post = DB::table('posts')->insertGetId([
			'title'   => 'Post #1',
			'user_id' => $this->owner,
		]);
	}



	/** @test */
	public function the_record_owner_rule_can_be_validated()
	{
		// Generate the fake data
		$this->seedDatabase();

		// Define the validation rule
		$rule = ['post_id' => [new RecordOwner('posts', 'id')]];

		// Test a unauthenticated user
		$this->assertFalse(validator(['post_id' => $this->post], $rule)->passes());

		// Test an authenticated user (but not the owner)
		Auth::loginUsingId($this->other);
		$this->assertFalse(validator(['post_id' => $this->post], $rule)->passes());

		// Test an authenticated user (that is the owner)
		Auth::loginUsingId($this->owner);
		$this->assertTrue(validator(['post_id' => $this->post], $rule)->passes());
	}

}