<?php

namespace App\Listeners;

use App\Events\PaymentTransactionApplied;

class StorePaymentTransactionApplied
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

    }
}
