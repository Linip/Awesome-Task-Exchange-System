<?php

namespace App\Listeners;

use App\Events\EnrollmentTransactionApplied;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Queue;

class ProduceEnrollmentTransaction
{
    /**
     * Handle the event.
     */
    public function handle(EnrollmentTransactionApplied $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'transactions.applied',
            'EnrollmentTransactionApplied',
            $event,
        );
    }
}
