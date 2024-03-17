<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Support\Facades\Queue;
use App\External\Events\Outgoing;

class PublishCreatedUserToBroker
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        Queue::connection('rabbitmq')->pushOn(
            'users.created.stream',
            Outgoing\UserCreated::eventName(),
            new Outgoing\UserCreated($event->user)
        );
    }
}
