<?php

namespace App\Commands;

class CreateTaskCommand
{
    /**
     * CreateTaskCommand constructor.
     */
    public function __construct(
        public string $executor_id,
        public string $name,
        public string $description,
    )
    {
    }
}
