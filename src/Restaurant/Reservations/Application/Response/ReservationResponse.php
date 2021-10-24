<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Response;


final class ReservationResponse
{
    private $id;
    private $tableId;
    private $userId;
    private $peoples;
    private $date;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        string $id,
        string $tableId,
        int    $userId,
        int    $peoples,
        string $date,
        string $createdAt,
        string $updatedAt
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

    public function peoples(): int
    {
        return $this->peoples;
    }

    public function date(): string
    {
        return $this->date;
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
