<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Domain\Contract;


use AppRestaurant\Restaurant\Dashboard\Domain\Entity\DashboardInformationHeader;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;

interface ReservationRepository
{
    public function find(ReservationId $id): ?Reservation;

    public function update(Reservation $reservation): void;

    public function create(Reservation $reservation): void;

    public function searcherList(array $clause, int $limit);

    public function searcherInformationHeader(DashboardInformationHeader $informationHeader, string $state): array;

    public function searcherHistory(string $dateFrom, string $dateTo, string $state = '', ?int $userId = null): int;
}
