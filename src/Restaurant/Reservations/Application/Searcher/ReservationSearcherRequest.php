<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Searcher;


final class ReservationSearcherRequest
{
    private $filters;

    public function __construct(
        array $filters
    )
    {
        $this->filters = $filters;
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
