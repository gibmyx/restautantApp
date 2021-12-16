<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Domain\Entity;

use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableCreatedAt;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableDescription;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMaxPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMinPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableCode;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableState;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableUpdatedAt;

final class Table
{
    const TABLE = 'tables';
    const PREFIJO = 'TAB';

    const STATE_AVAILABLE = "available";
    const STATE_OCCUPIED = "unavailable";

    public function __construct(
        private TableId          $id,
        private TableCode        $code,
        private TableState       $state,
        private TableMaxPeople   $maxPeople,
        private TableMinPeople   $minPeople,
        private TableDescription $description,
        private TableCreatedAt   $createdAt,
        private TableUpdatedAt   $updatedAt
    )
    {
    }

    public static function FormDataBase(
        TableId          $id,
        TableCode        $code,
        TableState       $state,
        TableMaxPeople   $maxPeople,
        TableMinPeople   $minPeople,
        TableDescription $description,
        TableCreatedAt   $createdAt,
        TableUpdatedAt   $updatedAt
    ): self
    {
        return new self(
            $id,
            $code,
            $state,
            $maxPeople,
            $minPeople,
            $description,
            $createdAt,
            $updatedAt
        );
    }

    public static function create(
        TableId          $id,
        TableState       $state,
        TableMaxPeople   $maxPeople,
        TableMinPeople   $minPeople,
        TableDescription $description
    ): self
    {
        return new self(
            $id,
            new TableCode(),
            $state,
            $maxPeople,
            $minPeople,
            $description,
            new TableCreatedAt(),
            new TableUpdatedAt()
        );
    }

    public function id(): TableId
    {
        return $this->id;
    }

    public function code(): TableCode
    {
        return $this->code;
    }

    public function state(): TableState
    {
        return $this->state;
    }

    public function maxPeople(): TableMaxPeople
    {
        return $this->maxPeople;
    }

    public function minPeople(): TableMinPeople
    {
        return $this->minPeople;
    }

    public function description(): TableDescription
    {
        return $this->description;
    }

    public function createdAt(): TableCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): TableUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeCode(TableCode $newCode): void
    {
        if (!$this->code->equals($newCode))
            $this->updatedAt = new TableUpdatedAt();

        $this->code = $newCode;
    }

    public function changeState(TableState $newState): void
    {
        if (!$this->state->equals($newState))
            $this->updatedAt = new TableUpdatedAt();

        $this->state = $newState;
    }

    public function changeMaxPeople(TableMaxPeople $newMaxPeople): void
    {
        if (!$this->maxPeople->equals($newMaxPeople))
            $this->updatedAt = new TableUpdatedAt();

        $this->maxPeople = $newMaxPeople;
    }

    public function changeMinPeople(TableMinPeople $newMinPeople): void
    {
        if (!$this->minPeople->equals($newMinPeople))
            $this->updatedAt = new TableUpdatedAt();

        $this->minPeople = $newMinPeople;
    }

    public function changeDescription(TableDescription $newDescription): void
    {
        if (!$this->description->equals($newDescription))
            $this->updatedAt = new TableUpdatedAt();

        $this->description = $newDescription;
    }

}
