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
        return $this->getCalculoPorcentaje($this->newUser);
    }

    public function reservation(): array
    {
        return $this->getCalculoPorcentaje($this->reservation);
    }

    public function reservationsCompleted(): array
    {
        return $this->getCalculoPorcentaje($this->reservationsCompleted);
    }

    public function reservationsCanceled(): array
    {
        return $this->getCalculoPorcentaje($this->reservationsCanceled);
    }

    private function getCalculoPorcentaje($data): array
    {

        if ($data['lastMonth'] > 0)
            $porcentaje = (($data['currentMonth'] - $data['lastMonth']) / $data['lastMonth']) * 100;

        if ($data['lastMonth'] == 0)
            $porcentaje = 100;

        if ($data['lastMonth'] == 0 && $data['currentMonth'] == 0)
            $porcentaje = 0;

        return array_merge($data, [
            "porcentaje" => round($porcentaje, 2),
            "isPositive" => $porcentaje > 0
        ]);
    }

}
