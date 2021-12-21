<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Dashboard\Application\Response;


final class InformationHeaderResponse
{
    private function __construct(
        private array $newUser,
        private array $reservation,
        private array $reservationsCompleted,
        private array $reservationsCanceled
    )
    {
    }

    public static function make(
        array $newUser,
        array $reservation,
        array $reservationsCompleted,
        array $reservationsCanceled
    ): self
    {
        return new self(
            $newUser,
            $reservation,
            $reservationsCompleted,
            $reservationsCanceled
        );
    }

    public function newUser(): array
    {
        if ($this->newUser['lastMonth'] > 0)
            $porcentaje = (($this->newUser['currentMonth'] - $this->newUser['lastMonth']) / $this->newUser['lastMonth']) * 100;

        if ($this->newUser['lastMonth'] == 0)
            $porcentaje = 100;

        if ($this->newUser['lastMonth'] == 0 && $this->newUser['currentMonth'] == 0)
            $porcentaje = 0;

        return array_merge($this->newUser, [
            "porcentaje" => round($porcentaje, 2),
            "isPositive" => $porcentaje > 0
        ]);
    }

    public function reservation(): array
    {
        if ($this->reservation['lastMonth'] > 0)
            $porcentaje = (($this->reservation['currentMonth'] - $this->reservation['lastMonth']) / $this->reservation['lastMonth']) * 100;

        if ($this->reservation['lastMonth'] == 0)
            $porcentaje = 100;

        if ($this->reservation['lastMonth'] == 0 && $this->reservation['currentMonth'] == 0)
            $porcentaje = 0;

        return array_merge($this->reservation, [
            "porcentaje" => round($porcentaje, 2),
            "isPositive" => $porcentaje > 0
        ]);
    }

    public function reservationsCompleted(): array
    {
        if ($this->reservationsCompleted['lastMonth'] > 0)
            $porcentaje = (($this->reservationsCompleted['currentMonth'] - $this->reservationsCompleted['lastMonth']) / $this->reservationsCompleted['lastMonth']) * 100;

        if ($this->reservationsCompleted['lastMonth'] == 0)
            $porcentaje = 100;

        if ($this->reservationsCompleted['lastMonth'] == 0 && $this->reservationsCompleted['currentMonth'] == 0)
            $porcentaje = 0;

        return array_merge($this->reservationsCompleted, [
            "porcentaje" => round($porcentaje, 2),
            "isPositive" => $porcentaje > 0
        ]);
    }

    public function reservationsCanceled(): array
    {
        if ($this->reservationsCanceled['lastMonth'] > 0)
            $porcentaje = (($this->reservationsCanceled['currentMonth'] - $this->reservationsCanceled['lastMonth']) / $this->reservationsCanceled['lastMonth']) * 100;

        if ($this->reservationsCanceled['lastMonth'] == 0)
            $porcentaje = 100;

        if ($this->reservationsCanceled['lastMonth'] == 0 && $this->reservationsCanceled['currentMonth'] == 0)
            $porcentaje = 0;

        return array_merge($this->reservationsCanceled, [
            "porcentaje" => round($porcentaje, 2),
            "isPositive" => $porcentaje > 0
        ]);
    }

}
