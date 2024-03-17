<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\External\Events\Outgoing;
use Illuminate\Support\Facades\Queue;

class ProduceTaskCreated
{
    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'tasks.created.stream',
            Outgoing\TaskCreated::eventName(),
            new Outgoing\TaskCreated($event->task),
        );
    }
}
