<?php

namespace App\External\Events;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Override;
use ReflectionClass;

abstract class Event implements JsonSerializable, Arrayable
{
    /**
     * @return string
     */
    public static function eventName(): string
    {
        return (new ReflectionClass(static::class))->getShortName();
    }

    /**
     * @inheritDoc
     * @return array
     */
    #[Override] abstract public function toArray(): array;

    /**
     * @return array
     */
    #[Override] public function jsonSerialize(): array
    {
        return [
            'event_name' => static::eventName(),
            ...$this->toArray()
        ];
    }
}
