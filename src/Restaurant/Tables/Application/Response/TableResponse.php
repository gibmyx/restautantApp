<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Application\Response;


final class TableResponse
{

    private $id;
    private $number;
    private $maxPeople;
    private $minPeople;
    private $description;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        string $id,
        int    $number,
        int    $maxPeople,
        int    $minPeople,
        string $description,
        string $createdAt,
        string $updatedAt
    )
    {
        $this->id = $id;
        $this->number = $number;
        $this->maxPeople = $maxPeople;
        $this->minPeople = $minPeople;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }

}
