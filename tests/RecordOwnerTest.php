<?php declare(strict_types = 1);

namespace Axiom\Rules\Tests;

use Axiom\Rules\RecordOwner;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecordOwnerTest extends TestCase
{

    /**
     * The other user id.
     *
     **/
    protected int $other;



    /**
     * The owner user id.
     *
     **/
    protected int $owner;



    /**
     * The post id.
     *
     **/
    protected int $post;



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

        $this->owner = DB::table('users')->insertGetId([
            'name'     => 'John Doe',
            'email'    => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->other = DB::table('users')->insertGetId([
            'name'     => 'Jane Doe',
            'email'    => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->post = DB::table('posts')->insertGetId([
            'title'   => 'Post #1',
            'user_id' => $this->owner,
        ]);
    }



    /** @test */
    public function the_record_owner_rule_can_be_validated()
    {
        $this->seedDatabase();

        $rule = ['post_id' => [new RecordOwner('posts', 'id')]];

        $this->assertFalse(validator(['post_id' => $this->post], $rule)->passes());

        Auth::loginUsingId($this->other);
        $this->assertFalse(validator(['post_id' => $this->post], $rule)->passes());

        Auth::loginUsingId($this->owner);
        $this->assertTrue(validator(['post_id' => $this->post], $rule)->passes());
    }
}
