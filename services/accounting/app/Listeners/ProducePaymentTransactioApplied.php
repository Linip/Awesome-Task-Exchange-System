<?php

namespace App\Listeners;

use App\Events\PaymentTransactionApplied;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Queue;

class ProducePaymentTransactioApplied
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
    public function handle(PaymentTransactionApplied $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'transactions.applied',
            'PaymentTransactionApplied',
            $event,
        );
    }
}
