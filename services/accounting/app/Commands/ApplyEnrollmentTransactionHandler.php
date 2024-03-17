<?php

namespace App\Commands;

use App\Events\EnrollmentTransactionApplied;
use Illuminate\Support\Facades\Event;

class ApplyEnrollmentTransactionHandler
{
    /**
     * @param ApplyEnrollmentTransactionCommand $command
     */
    public function handle(ApplyEnrollmentTransactionCommand $command): void
    {
        // do something ...
        Event::dispatch(new EnrollmentTransactionApplied());
    }
}
