<?php

namespace App\Providers;

use App\Events\EnrollmentTransactionApplied;
use App\Events\TaskAssigned;
use App\Events\TaskCompleted;
use App\Events\TaskCreated;
use App\Events\UserCreated;
use App\Listeners\StoreTaskAssigned;
use App\Listeners\StoreEnrollmentTransaction;
use App\Listeners\StoreNewTask;
use App\Listeners\StoreNewUser;
use App\Listeners\StoreTaskCompleted;
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
        UserCreated::class => [
            StoreNewUser::class,
        ],
        TaskCreated::class => [
            StoreNewTask::class,
        ],
        TaskAssigned::class => [
            StoreTaskAssigned::class,
        ],
        TaskCompleted::class => [
            StoreTaskCompleted::class,
        ],
        EnrollmentTransactionApplied::class => [
            StoreEnrollmentTransaction::class,
        ]

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
