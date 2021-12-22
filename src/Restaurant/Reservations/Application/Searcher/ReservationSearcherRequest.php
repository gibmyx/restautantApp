<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Searcher;


final class ReservationSearcherRequest
{
    public function __construct(
        private array $filters,
        private int $limit,
    ) {
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}
