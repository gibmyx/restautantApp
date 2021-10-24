<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Domain\Service;

use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;

final class ReservationFinder
{
    private $repository;

    public function __construct(
        ReservationRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ReservationId $id): Reservation
    {
        $reservation = $this->repository->find($id);

        if(empty($reservation))
            throw new ReservationNotExistsException();

        return $reservation;
    }

}
