<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use JoggApp\LaravelCascadeSoftDeletes\Listeners\CascadeSoftDeletesSubscriber;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        CascadeSoftDeletesSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
