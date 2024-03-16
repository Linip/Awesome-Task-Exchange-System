<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Support\Facades\Queue;
use App\External\Events\Outgoing;

class PublishCreatedUserToBroker
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
    public function handle(UserCreated $event): void
    {
        Queue::connection('rabbitmq')->push(
            Outgoing\UserCreated::eventName(),
            new Outgoing\UserCreated($event->user)
        );
    }
}
