<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Application\Create;

use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableDescription;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMaxPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMinPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableCode;

final class TableCreateRequest
{

    public function __construct(
        private string $id,
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
