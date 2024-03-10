<?php

namespace App\Commands;

use App\Events\TaskAssigned;
use App\Models\Task;
use App\Models\User;
use Database\Factories\UserFactory;
use DomainException;
use Illuminate\Support\Facades\Event;

class CreateTaskHandler
{
    /**
     * CreateTaskHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param CreateTaskCommand $command
     * @return string
     */
    public function handle(CreateTaskCommand $command): string
    {
        /** @var User $executor */
        $executor = User::query()
            ->where('public_id', '=', $command->executor_id)
            ->firstOr(
                ['*'],
                fn() => UserFactory::new()
                    ->createOne(['public_id' => $command->executor_id])
            );

        $task = new Task([
            'name' => $command->name,
            'description' => $command->description,
        ]);
        $task->executor_id = $executor->id;
        $task->save();

        Event::dispatch(new TaskAssigned(
            task: $task,
            assignTo: $executor->public_id,
        ));

        return $task->public_id;
    }
}
