<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreNewUser
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        User::factory()
            ->newModel((array)$event)
            ->save()
        ;
    }
}
