<?php

namespace App\Http\Controllers;

use App\Commands\CompleteTaskCommand;
use App\Commands\CompleteTaskHandler;
use App\Commands\CreateTaskCommand;
use App\Commands\CreateTaskHandler;
use App\Commands\ShuffleTasksCommand;
use App\Commands\ShuffleTasksHandler;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class TaskController extends Controller
{
    /**
     * @param CommandBusInterface $commandBus
     */
    public function __construct(protected CommandBusInterface $commandBus)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $executorId)
    {
        $tasks = Task::query()
            ->where('executor_id', '=', $executorId)
            ->get();
        return $tasks->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $public_id = $this->commandBus->dispatch(new CreateTaskCommand(
            executor_id: $request->get('executor_id'),
            name: $request->get('name'),
            description: $request->get('description'),
        ));

        if (!Str::isUuid($public_id)) {
            throw new \LogicException('task public_id expected from command result');
        }

        return response([
            'public_id' => $public_id,
        ]);
    }


    /**
     * @param int $taskId
     * @return Response
     */
    public function complete(int $taskId): Response
    {
        $this->commandBus->dispatch(new CompleteTaskCommand($taskId));

        return response();
    }

    /**
     * @return void
     */
    public function shuffle(): void
    {
        $this->commandBus->dispatch(new ShuffleTasksCommand());
    }
}
