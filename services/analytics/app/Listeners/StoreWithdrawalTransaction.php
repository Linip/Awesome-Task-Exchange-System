<?php

namespace App\Listeners;

use App\Events\WithdrawalTransactionApplied;

class StoreWithdrawalTransaction
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

    }
}
