<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Application\Update;


final class TableUpdateRequest
{
    private $id;
    private $number;
    private $maxPeople;
    private $minPeople;
    private $description;

    public function __construct(
        string $id,
        int    $number,
        int    $maxPeople,
        int    $minPeople,
        string $description
    )
    {
        $this->id = $id;
        $this->number = $number;
        $this->maxPeople = $maxPeople;
        $this->minPeople = $minPeople;
        $this->description = $description;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function number(): int
    {
        return $this->number;
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
