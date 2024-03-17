<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Models\Task;

class StoreNewTask
{
    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event): void
    {
        $task = new Task((array)$event);
        $task->save();
    }
}
