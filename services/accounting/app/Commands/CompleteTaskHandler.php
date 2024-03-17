<?php

namespace App\Commands;

use App\Events\TaskCompleted;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CompleteTaskHandler
{
    /**
     * @param CompleteTaskCommand $command
     */
    public function handle(CompleteTaskCommand $command): void
    {
        /** @var Task $task */
        $task = Task::query()->findOrFail($command->taskId);
        $task->complete();
        $task->save();
        $user = Auth::user() ?? $task->executor;
        Event::dispatch(new TaskCompleted($task, $user->public_id));
    }
}
