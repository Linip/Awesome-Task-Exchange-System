<?php

namespace App\Providers;

use App\Events\TaskAssigned;
use App\Events\TaskCompleted;
use App\Events\TaskCreated;
use App\Events\UserCreated;
use App\External\EventLocator;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\RabbitMQQueue;

class RabbitMqServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(EventLocator::class, static function () {
            return new EventLocator([
                'UserCreated' => UserCreated::class,
                'TaskCreated' => TaskCreated::class,
                'TaskAssigned' => TaskAssigned::class,
                'TaskCompleted' => TaskCompleted::class,
            ]);
        });
    }

    /**
     * @return void
     * @throws AMQPProtocolChannelException
     */
    public function boot(): void
    {
        /** @var RabbitMQQueue $broker */
        $broker = Queue::connection('rabbitmq');

        if (!$broker->isQueueExists('accounting.users.created.stream')) {
            $broker->declareQueue('accounting.users.created.stream');
            $broker->bindQueue(
                'accounting.users.created.stream',
                'ates.topic',
                'users.created.stream',
            );
        }

        if (!$broker->isQueueExists('accounting.tasks.created.stream')) {
            $broker->declareQueue('accounting.tasks.created.stream');
            $broker->bindQueue(
                'accounting.tasks.created.stream',
                'ates.topic',
                'tasks.created.stream',
            );
        }

        if (!$broker->isQueueExists('accounting.tasks.workflow')) {
            $broker->declareQueue('accounting.tasks.workflow');
            $broker->bindQueue(
                'accounting.tasks.workflow',
                'ates.topic',
                'tasks.workflow',
            );
        }
    }
}
