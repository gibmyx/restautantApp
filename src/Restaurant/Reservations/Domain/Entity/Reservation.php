<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Domain\Entity;

use AppRestaurant\Restaurant\Reservations\Domain\Event\ReservationCreated;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationDate;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationTableId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationPeoples;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationCreatedAt;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUpdatedAt;

use AppRestaurant\Restaurant\Shared\Domain\AggregateRoot\AggregateRoot;

final class Reservation
{
    const TABLE = "reservation";

    private $id;
    private $tableId;
    private $userId;
    private $peoples;
    private $date;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        ReservationId        $id,
        ReservationTableId   $tableId,
        ReservationUserId   $userId,
        ReservationPeoples   $peoples,
        ReservationDate      $date,
        ReservationCreatedAt $createdAt,
        ReservationUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->tableId = $tableId;
        $this->userId = $userId;
        $this->peoples = $peoples;
        $this->date = $date;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ReservationId      $id,
        ReservationTableId $tableId,
        ReservationUserId  $userId,
        ReservationPeoples $peoples,
        ReservationDate    $date
    ): self
    {
        return new self(
            $id,
            $tableId,
            $userId,
            $peoples,
            $date,
            new ReservationCreatedAt(),
            new ReservationUpdatedAt()
        );
    }

    public static function FormDataBase(
        ReservationId        $id,
        ReservationTableId   $tableId,
        ReservationUserId   $userId,
        ReservationPeoples   $peoples,
        ReservationDate      $date,
        ReservationCreatedAt $createdAt,
        ReservationUpdatedAt $updatedAt
    ): self
    {
        return new self(
            $id,
            $tableId,
            $userId,
            $peoples,
            $date,
            $createdAt,
            $updatedAt,
        );
    }

    public function id(): ReservationId
    {
        return $this->id;
    }

    public function tableId(): ReservationTableId
    {
        return $this->tableId;
    }

    public function userId(): ReservationUserId
    {
        return $this->userId;
    }

    public function peoples(): ReservationPeoples
    {
        return $this->peoples;
    }

    public function date(): ReservationDate
    {
        return $this->date;
    }

    public function createdAt(): ReservationCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ReservationUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeTable(ReservationTableId $newTable): void
    {
        if (! $this->tableId->equals($newTable))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->tableId = $newTable;
    }

    public function changePeoples(ReservationPeoples $newPeoples): void
    {
        if (! $this->peoples->equals($newPeoples))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->peoples = $newPeoples;
    }

    public function changeDate(ReservationDate $newDate): void
    {
        if (! $this->date->equals($newDate))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->date = $newDate;
    }
}
