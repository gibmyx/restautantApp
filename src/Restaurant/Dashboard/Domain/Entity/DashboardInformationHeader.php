<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Dashboard\Domain\Entity;

final class DashboardInformationHeader
{

    private function __construct(
        private string $startLastMonth,
        private string $endLastMonth,
        private string $startCurrentMonth,
        private string $endCurrentMonth
    )
    {
    }

    public static function make(

        string $startLastMonth,
        string $endLastMonth,
        string $startCurrentMonth,
        string $endCurrentMonth
    ): self
    {
        return new self(
            $startLastMonth,
            $endLastMonth,
            $startCurrentMonth,
            $endCurrentMonth
        );
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
