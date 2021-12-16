<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Application\Response;


final class TableResponse
{
    public function __construct(
        private string $id,
        private string $code,
        private string $state,
        private int    $maxPeople,
        private int    $minPeople,
        private string $description,
        private string $createdAt,
        private string $updatedAt
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function maxPeople(): int
    {
        return $this->maxPeople;
    }

    public function minPeople(): int
    {
        return $this->minPeople;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }

}
