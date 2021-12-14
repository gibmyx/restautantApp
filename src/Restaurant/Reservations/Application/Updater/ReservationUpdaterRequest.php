<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Updater;


final class ReservationUpdaterRequest
{
    public function __construct(
        private string $id,
        private string $tableId,
        private int    $userId,
        private int    $people,
        private string $date,
        private string $state,
        private int    $numberTable,
        private string $userName
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function tableId(): string
    {
        return $this->tableId;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function people(): int
    {
        return $this->people;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function numberTable(): int
    {
        return $this->numberTable;
    }

    public function userName(): string
    {
        return $this->userName;
    }

}
