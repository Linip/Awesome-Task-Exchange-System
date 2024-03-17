<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use Illuminate\Support\Facades\Queue;

class ProduceTaskCompleted
{
    /**
     * Handle the event.
     */
    public function handle(TaskCompleted $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'tasks.workflow',
            'TaskCompleted',
            [
                'event_name' => 'TaskCompleted',
                'task_id' => $event->task->public_id,
                'completed_by' => $event->completedBy,
            ]
        );
    }
}
