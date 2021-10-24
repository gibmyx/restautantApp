<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Subscriber;


use AppRestaurant\Restaurant\Shared\Domain\Bus\Event\DomainEvent;
use AppRestaurant\Restaurant\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class ReservationCreatedToCreateConfirmation implements DomainEventSubscriber
{

    public function __construct()
    {
    }

    public static function handle(DomainEvent $event): void
    {
    }
}
