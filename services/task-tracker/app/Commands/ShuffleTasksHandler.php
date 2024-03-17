<?php

namespace App\Commands;

use App\Events\TaskAssigned;
use Random\Randomizer;
use Wnikk\LaravelAccessRules\Models\Owner;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class ShuffleTasksHandler
{
    /**
     * ShuffleTasksHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param ShuffleTasksCommand $command
     */
    public function handle(ShuffleTasksCommand $command): void
    {
        $roleTypeId = Owner::getTypeID('Role');
        $userTypeId = Owner::getTypeID(User::class);
        $roleCode = 'worker';

        $workers = User::query()
            ->join('access_rules_owner as u', function (JoinClause $join) {
                $join->on('users.id', '=', 'u.original_id');
            })
            ->join('access_rules_inheritance as i', function (JoinClause $join) {
                $join->on('u.id', '=', 'i.owner_id');
            })
            ->join(
                'access_rules_owner as r',
                fn(JoinClause $join) => $join
                    ->on('i.owner_parent_id', '=', 'r.id')
                    ->where('r.type', '=', $roleTypeId)
                    ->where('r.original_id', '=', $roleCode)
            )
            ->where('u.type', '=', $userTypeId)
            ->get();

        /** @var Task[] $tasks */
        $tasks = Task::query()->whereNot('status', '=', Status::Completed->name)->get();
        foreach ($tasks as $task) {
            $worker = $workers->get(random_int(0, $workers->count() - 1));
            $task->executor_id = $worker->id;
            $task->save();

            Event::dispatch(new TaskAssigned($task, $worker->public_id));
        }
    }
}
