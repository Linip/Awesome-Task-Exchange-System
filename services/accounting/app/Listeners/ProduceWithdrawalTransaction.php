<?php

namespace App\Listeners;

use App\Events\WithdrawalTransactionApplied;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Queue;

class ProduceWithdrawalTransaction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WithdrawalTransactionApplied $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'transactions.applied',
            'WithdrawalTransactionApplied',
            $event,
        );
    }
}
