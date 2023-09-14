<?php

namespace JoggApp\LaravelCascadeSoftDeletes;

use Illuminate\Support\ServiceProvider;
use JoggApp\LaravelCascadeSoftDeletes\Providers\EventServiceProvider;

class CascadeSoftDeletesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }
}
