<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Shared\Domain\Bus\Event;


interface DomainEventSubscriber
{
    public static function handle(DomainEvent $event): void;
}
