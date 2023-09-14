<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use JoggApp\LaravelCascadeSoftDeletes\Support\Services\CascadeSoftDeletesService;

class CascadeSoftDeletesSubscriber implements ShouldQueue
{
    public function __construct(private CascadeSoftDeletesService $service)
    {
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe($events)
    {
        $events->listen(
            'eloquent.deleting: *',
            [CascadeSoftDeletesSubscriber::class, 'handleDeleting']
        );

        $events->listen(
            'eloquent.restoring: *',
            [CascadeSoftDeletesSubscriber::class, 'handleRestoring']
        );
    }

    public function handleDeleting($event, $models)
    {
        $this->service->handle(collect($models), 'delete');
    }

    public function handleRestoring($event, $models)
    {
        $this->service->handle(collect($models), 'restore');
    }
}
