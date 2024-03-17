<?php

namespace App\Commands;

use App\Models\Task;

class ApplyEnrollmentTransactionCommand
{
    /**
     * ApplyEnrollmentTransactionCommand constructor.
     */
    public function __construct(public Task $task, public string $assignedTo)
    {
    }
}
