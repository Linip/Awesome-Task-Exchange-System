<?php

namespace App\Providers;

use App\Events\EnrollmentTransactionApplied;
use App\Events\PaymentTransactionApplied;
use App\Events\TaskAssigned;
use App\Events\TaskCreated;
use App\Events\UserCreated;
use App\Listeners\HandleTaskAssigned;
use App\Listeners\ProduceEnrollmentTransaction;
use App\Listeners\ProducePaymentTransactioApplied;
use App\Listeners\ProduceTaskCreated;
use App\Listeners\StoreNewTask;
use App\Listeners\StoreNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
