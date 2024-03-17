<?php

namespace App\Commands;

class CompleteTaskCommand
{
    /**
     * CompleteTaskCommand constructor.
     */
    public function __construct(public int $taskId)
    {

    }
}
