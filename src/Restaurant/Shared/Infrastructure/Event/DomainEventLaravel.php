<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Shared\Infrastructure\Event;

use AppRestaurant\Restaurant\Shared\Domain\ValueObject\DateTimeValueObject;
use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

abstract class DomainEventLaravel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $aggregateId;

    public function __construct(
        string $aggregateId
    )
    {
        $this->aggregateId = $aggregateId;
    }

    abstract public static function eventName(): string;

    public function broadcastOn()
    {
        return new PrivateChannel($this->eventName());
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

}
