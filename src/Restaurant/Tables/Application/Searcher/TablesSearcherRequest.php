<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Application\Searcher;

final class TablesSearcherRequest
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
