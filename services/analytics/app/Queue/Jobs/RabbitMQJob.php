<?php

namespace App\Queue\Jobs;

use App\External\EventLocator;
use App\Queue\Handlers\ExternalEventsHandler;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Event;
use LogicException;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\RabbitMQQueue;

class RabbitMQJob extends BaseJob
{
    /**
     * @var EventLocator|\Closure|mixed|object|null
     */
    protected EventLocator $eventLocator;

    /**
     * @param Container $container
     * @param RabbitMQQueue $rabbitmq
     * @param AMQPMessage $message
     * @param string $connectionName
     * @param string $queue
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(
        Container              $container,
        RabbitMQQueue          $rabbitmq,
        AMQPMessage            $message,
        string                 $connectionName,
        string                 $queue,
    )
    {
        parent::__construct($container, $rabbitmq, $message, $connectionName, $queue);
        $this->eventLocator = $container->get(EventLocator::class);
    }

    public function fire(): void
    {
        $payload = $this->payload();

        $eventName = $this->ensureGetEventName($payload);
        $eventClass = $this->eventLocator->getGetEventForEventName($eventName);
        $event = new $eventClass($payload['data']);
        Event::dispatch($event);
        $this->delete();
    }

    /**
     * @param array $payload
     * @return string
     */
    private function ensureGetEventName(array $payload): string
    {
        return $payload['data']['event_name'] ?? throw new LogicException('не указано имя события');
    }
}
