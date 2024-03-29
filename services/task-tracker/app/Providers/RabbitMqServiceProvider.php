<?php

namespace App\Providers;

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
                'UserCreated' => UserCreated::class
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

        if (!$broker->isQueueExists('tasks.users.created.stream')) {
            $broker->declareQueue('tasks.users.created.stream');
            $broker->bindQueue(
                'tasks.users.created.stream',
                'ates.topic',
                'users.created.stream',
            );
        }
    }
}
