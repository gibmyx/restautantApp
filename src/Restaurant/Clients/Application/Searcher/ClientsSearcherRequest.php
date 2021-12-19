<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Application\Searcher;

final class ClientsSearcherRequest
{
    public function __construct(
        private array $filters
    )
    {
    }

    public function filters(): array
    {
        return $this->filters;
    }

}
