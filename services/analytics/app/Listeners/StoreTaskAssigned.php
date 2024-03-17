<?php

namespace App\Listeners;

use App\Events\TaskAssigned;

class StoreTaskAssigned
{
    /**
     * Handle the event.
     */
    public function handle(TaskAssigned $event): void
    {
        // do something

    }
}
