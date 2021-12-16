<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Response;


final class ReservationResponse
{
    public function __construct(
        private string $id,
        private string $code,
        private string $tableId,
        private int    $userId,
        private int    $peoples,
        private string $date,
        private string $state,
        private string    $codeTable,
        private string $userName,
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

    public function tableId(): string
    {
        return $this->tableId;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function peoples(): int
    {
        return $this->peoples;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function codeTable(): string
    {
        return $this->codeTable;
    }

    public function userName(): string
    {
        return $this->userName;
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
