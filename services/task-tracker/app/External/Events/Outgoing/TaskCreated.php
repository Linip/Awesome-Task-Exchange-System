<?php

namespace App\External\Events\Outgoing;

use App\External\Events\Event;
use App\Models\Task;
use Override;

class TaskCreated extends Event
{
    public function __construct(protected Task $task)
    {
    }

    /**
     * @inheritDoc
     */
    #[\Override] public function toArray(): array
    {
        return [
            'public_id' => $this->task->public_id,
            'executor_id' => $this->task->executor->public_id,
            'name' => $this->task->name,
            'description' => $this->task->description,
        ];
    }
}
