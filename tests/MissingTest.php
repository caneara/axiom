<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\Missing;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\DB;

class MissingTest extends TestCase
{

    /**
     * The user id.
     *
     **/
    protected int $user;



    /**
     * Define the application environment.
     *
     **/
    protected function getEnvironmentSetUp($app) : void
    {
        $app['config']->set('auth.providers.users.driver', 'database');
        $app['config']->set('auth.providers.users.table', 'users');

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
     **/
    protected function seedDatabase() : void
    {
        $this->loadMigrationsFrom(realpath(__DIR__ . '/..') . '/support/migrations');

        $this->user = DB::table('users')->insertGetId([
            'name'     => 'John Doe',
            'email'    => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
    }



    /** @test */
    public function the_does_not_exist_rule_can_be_validated()
    {
        $this->seedDatabase();

        $rule = ['user_id' => [new Missing('users', 'id')]];

        $this->assertTrue(validator(['user_id' => 'non_existent_user'], $rule)->passes());
        $this->assertFalse(validator(['user_id' => $this->user], $rule)->passes());
    }
}
