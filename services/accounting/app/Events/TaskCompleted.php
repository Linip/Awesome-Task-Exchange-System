<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCompleted
{
    use Dispatchable, SerializesModels;

    public string $task_id;
    public string $completed_by;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        $this->__unserialize($data);
    }
}
