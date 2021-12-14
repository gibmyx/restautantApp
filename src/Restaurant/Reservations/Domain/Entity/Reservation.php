<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Domain\Entity;

use AppRestaurant\Restaurant\Reservations\Domain\Event\ReservationCreated;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationDate;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationNumberTable;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationState;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationTableId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationPeoples;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationCreatedAt;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUpdatedAt;

use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserName;
use AppRestaurant\Restaurant\Shared\Domain\AggregateRoot\AggregateRoot;

final class Reservation
{
    const TABLE = "reservation";

    const STATE_PENDING = "pending";
    const STATE_APPROVED = "approved";
    const STATE_CANCELED = "canceled";

    private function __construct(
        private ReservationId          $id,
        private ReservationTableId     $tableId,
        private ReservationUserId      $userId,
        private ReservationPeoples     $peoples,
        private ReservationDate        $date,
        private ReservationState       $state,
        private ReservationNumberTable $numberTable,
        private ReservationUserName    $userName,
        private ReservationCreatedAt   $createdAt,
        private ReservationUpdatedAt   $updatedAt
    )
    {
    }

    public static function create(
        ReservationId          $id,
        ReservationTableId     $tableId,
        ReservationUserId      $userId,
        ReservationPeoples     $peoples,
        ReservationDate        $date,
        ReservationState       $state,
        ReservationNumberTable $numberTable,
        ReservationUserName    $userName,
    ): self
    {
        return new self(
            $id,
            $tableId,
            $userId,
            $peoples,
            $date,
            $state,
            $numberTable,
            $userName,
            new ReservationCreatedAt(),
            new ReservationUpdatedAt()
        );
    }

    public static function FormDataBase(
        ReservationId          $id,
        ReservationTableId     $tableId,
        ReservationUserId      $userId,
        ReservationPeoples     $peoples,
        ReservationDate        $date,
        ReservationState       $state,
        ReservationNumberTable $numberTable,
        ReservationUserName    $userName,
        ReservationCreatedAt   $createdAt,
        ReservationUpdatedAt   $updatedAt
    ): self
    {
        return new self(
            $id,
            $tableId,
            $userId,
            $peoples,
            $date,
            $state,
            $numberTable,
            $userName,
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

    public function state(): ReservationState
    {
        return $this->state;
    }

    public function numberTable(): ReservationNumberTable
    {
        return $this->numberTable;
    }

    public function userName(): ReservationUserName
    {
        return $this->userName;
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
        if (!$this->tableId->equals($newTable))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->tableId = $newTable;
    }

    public function changePeoples(ReservationPeoples $newPeoples): void
    {
        if (!$this->peoples->equals($newPeoples))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->peoples = $newPeoples;
    }

    public function changeDate(ReservationDate $newDate): void
    {
        if (!$this->date->equals($newDate))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->date = $newDate;
    }

    public function changeState(ReservationState $newState): void
    {
        if (!$this->state->equals($newState))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->state = $newState;
    }

    public function changeNumberTable(ReservationNumberTable $numberTable): void
    {
        if (!$this->numberTable->equals($numberTable))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->numberTable = $numberTable;
    }

    public function changeUserName(ReservationUserName $userName): void
    {
        if (!$this->userName->equals($userName))
            $this->updatedAt = new ReservationUpdatedAt();

        $this->userName = $userName;
    }
}
