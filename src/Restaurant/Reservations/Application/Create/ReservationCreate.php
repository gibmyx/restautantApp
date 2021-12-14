<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Create;

use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationDate;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationNumberTable;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationPeoples;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationState;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationTableId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserName;

final class ReservationCreate
{
    private $repository;

    public function __construct(
        ReservationRepository $repository,
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ReservationCreateRequest $request)
    {
        $reservation = Reservation::create(
            new ReservationId($request->id()),
            new ReservationTableId($request->tableId()),
            new ReservationUserId($request->userId()),
            new ReservationPeoples($request->people()),
            new ReservationDate($request->date()),
            new ReservationState($request->state()),
            new ReservationNumberTable($request->numberTable()),
            new ReservationUserName($request->userName()),
        );

        $this->repository->create($reservation);
    }

}
