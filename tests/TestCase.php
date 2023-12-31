<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Tests;

use JoggApp\LaravelCascadeSoftDeletes\CascadeSoftDeletesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__ . '/../database/migrations/create_users_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_posts_table.php.stub';

        // run the migration's up() method
        (new \CreateUsersTable)->up();
        (new \CreatePostsTable)->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            CascadeSoftDeletesServiceProvider::class,
        ];
    }
}
