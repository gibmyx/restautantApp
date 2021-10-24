<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Domain\Event;

use AppRestaurant\Restaurant\Shared\Domain\Bus\Event\DomainEvent;

final class ReservationCreated extends DomainEvent
{
    public function __construct(
        string $aggregateId
    )
    {
        parent::__construct($aggregateId);
    }

    public static function eventName(): string
    {
        return 'reservation-created';
    }

    public function execute()
    {
        $this::dispatch($this->aggregateId());
    }
}
