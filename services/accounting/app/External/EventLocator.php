<?php

namespace App\External;

use League\Tactician\Handler\Locator\InMemoryLocator;

class EventLocator
{
    /**
     * @var InMemoryLocator
     */
    private InMemoryLocator $adapts;

    /**
     * @param array $eventNameToEventMap
     */
    public function __construct(array $eventNameToEventMap = [])
    {
        $this->adapts = new InMemoryLocator($eventNameToEventMap);
    }

    /**
     * @param object|string $eventClass
     * @param string $eventName
     * @return void
     */
    public function addEvent(object|string $eventClass, string $eventName): void
    {
        $this->adapts->addHandler($eventClass, $eventName);
    }

    /**
     * @param string $eventName
     * @return string|object
     */
    public function getGetEventForEventName(string $eventName): object|string
    {
        return $this->adapts->getHandlerForCommand($eventName);
    }

}
