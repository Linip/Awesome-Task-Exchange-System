<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCreated
{
    use Dispatchable, SerializesModels;

    public string $public_id;
    public string $executor_id;
    public string $name;
    public string $description;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        // TODO need validation
        $this->__unserialize($data);
    }
}
