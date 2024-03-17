<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskAssigned
{
    use Dispatchable, SerializesModels;

    public string $task_id;
    public string $assigned_to;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        $this->__unserialize($data);
    }
}
