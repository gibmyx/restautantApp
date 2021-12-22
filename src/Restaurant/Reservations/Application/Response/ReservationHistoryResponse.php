<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Response;


final class ReservationHistoryResponse
{
    public function __construct(
      private array $historyCount,
      private array $historyMonths,
    ) {
    }

    public function historyCount(): array
    {
        return $this->historyCount;
    }

    public function historyMonths(): array
    {
        return $this->historyMonths;
    }

}
