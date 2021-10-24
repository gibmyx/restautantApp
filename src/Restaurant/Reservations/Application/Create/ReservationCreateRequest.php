<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Create;


final class ReservationCreateRequest
{
    private $id;
    private $tableId;
    private $userId;
    private $people;
    private $date;

    public function __construct(
        string $id,
        string $tableId,
        int    $userId,
        int    $people,
        string $date
    )
    {
        $this->id = $id;
        $this->tableId = $tableId;
        $this->userId = $userId;
        $this->people = $people;
        $this->date = $date;
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

}
