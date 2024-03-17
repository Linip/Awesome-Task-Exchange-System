<?php

namespace App\Listeners;

use App\Events\TaskAssigned;
use Illuminate\Support\Facades\Queue;

class ProduceTaskAssigned
{
    /**
     * Handle the event.
     */
    public function handle(TaskAssigned $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'tasks.workflow',
            'TaskAssigned',
            [
                'event_name' => 'TaskAssigned',
                'task_id' => $event->task->public_id,
                'assigned_to' => $event->assignedTo,
            ]
        );
    }
}
