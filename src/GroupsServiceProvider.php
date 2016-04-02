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
        $this->registerAssets();
    }

    public function register()
    {
        $this->registerChat();
    }

    private function registerChat()
    {
        $this->app->bind('groups', function () {
            return $this->app->make('Musonza\Groups\Groups');
        });
    }

    public function registerAssets()
    {
        $this->publishes([
            __DIR__ . '/migrations' => database_path('/migrations'),
        ]);

    }
}
