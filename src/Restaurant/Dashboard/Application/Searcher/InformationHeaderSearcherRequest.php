<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Dashboard\Application\Searcher;


final class InformationHeaderSearcherRequest
{
    public function __construct(
        private string $startLastMonth,
        private string $endLastMonth,
        private string $startCurrentMonth,
        private string $endCurrentMonth,
    )
    {
    }

    public function startLastMonth(): string
    {
        return $this->startLastMonth;
    }

    public function endLastMonth(): string
    {
        return $this->endLastMonth;
    }

    public function startCurrentMonth(): string
    {
        return $this->startCurrentMonth;
    }

    public function endCurrentMonth(): string
    {
        return $this->endCurrentMonth;
    }

}
