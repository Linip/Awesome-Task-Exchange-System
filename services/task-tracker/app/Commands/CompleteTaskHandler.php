<?php

namespace App\Commands;

use App\Events\TaskCompleted;
use App\Models\Task;
use Illuminate\Support\Facades\Event;

class CompleteTaskHandler
{
    /**
     * CompleteTaskHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param CompleteTaskCommand $command
     */
    public function handle(CompleteTaskCommand $command): void
    {
        /** @var Task $task */
        $task = Task::query()->findOrFail($command->taskId);
        $task->complete();
        $task->save();

        Event::dispatch(new TaskCompleted($task));
    }
}
