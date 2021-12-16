<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Application\Update;


final class TableUpdateRequest
{

    public function __construct(
        private string $id,
        private string    $code,
        private string $state,
        private int    $maxPeople,
        private int    $minPeople,
        private string $description
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

}
