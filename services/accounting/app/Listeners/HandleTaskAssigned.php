<?php

namespace App\Listeners;

use App\Commands\ApplyEnrollmentTransactionCommand;
use App\Events\TaskAssigned;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class HandleTaskAssigned
{
    /**
     * Create the event listener.
     */
    public function __construct(protected CommandBusInterface $commandBus)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(TaskAssigned $event): void
    {
        /** @var Task $task */
        $task = Task::query()->where(['public_id' => $event->task_id]);

        // do something

        $this->commandBus->dispatch(
            new ApplyEnrollmentTransactionCommand($task, $event->assigned_to)
        );
    }
}
