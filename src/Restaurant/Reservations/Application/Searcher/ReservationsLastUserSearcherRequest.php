<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Application\Searcher;

final class ReservationsLastUserSearcherRequest
{
    public function __construct(
      private int $userId
    ) {
    }

    public function userId(): int
    {
        return $this->userId;
    }

}
