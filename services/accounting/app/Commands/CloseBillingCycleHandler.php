<?php

namespace App\Commands;

use App\Events\PaymentTransactionApplied;
use Illuminate\Support\Facades\Event;

class CloseBillingCycleHandler
{
    /**
     * CloseBillingCycleHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param CloseBillingCycleCommand $command
     */
    public function handle(CloseBillingCycleCommand $command): void
    {
        // Closing billing cycle...

        Event::dispatch(new PaymentTransactionApplied());
    }
}
