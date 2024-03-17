<?php

namespace App\Commands;

use App\Events\EnrollmentTransactionApplied;
use Illuminate\Support\Facades\Event;

class ApplyWithdrawalTransactionHandler
{
    /**
     * ApplayWithdrawalTransactionHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param ApplyWithdrawalTransactionCommand $command
     */
    public function handle(ApplyWithdrawalTransactionCommand $command): void
    {
        // apply ....
        Event::dispatch(new EnrollmentTransactionApplied());
    }
}
