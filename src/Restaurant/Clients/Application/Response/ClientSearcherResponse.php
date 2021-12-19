<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Clients\Application\Response;


final class ClientSearcherResponse
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private int $reservations,
        private int $reservationCompleted,
        private int $reservationPeding
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function reservations(): int
    {
        return $this->reservations;
    }

    public function reservationCompleted(): int
    {
        return $this->reservationCompleted;
    }

    public function reservationPeding(): int
    {
        return $this->reservationPeding;
    }
}
