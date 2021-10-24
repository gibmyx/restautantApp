<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Shared\Infrastructure\Bus;

use AppRestaurant\Restaurant\Shared\Domain\Bus\Event\DomainEvent;
use AppRestaurant\Restaurant\Shared\Domain\Bus\Event\EventBus;

final class EventBusLaravel implements EventBus
{
    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            try {
                $event->execute();
            } catch (\Exception $unused) {
            }
        }
    }
}
