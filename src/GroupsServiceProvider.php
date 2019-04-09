<?php

namespace Musonza\Groups;

use Illuminate\Support\ServiceProvider;

class GroupsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishMigrations();
    }

    public function register()
    {
        $this->registerGroups();
    }

    private function registerGroups()
    {
        $this->app->bind('groups', function () {
            return $this->app->make('Musonza\Groups\Groups');
        });
    }

    /**
     * Publish package's migrations.
     *
     * @return void
     */
    public function publishMigrations()
    {
        $timestamp = date('Y_m_d_His', time());
        $stub = __DIR__.'/../database/migrations/create_groups_tables.php';
        $target = $this->app->databasePath().'/migrations/'.$timestamp.'_create_groups_tables.php';
        $this->publishes([$stub => $target], 'groups.migrations');
    }
}
