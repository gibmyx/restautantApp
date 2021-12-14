<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Updater;


use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Service\ReservationFinder;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationDate;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationNumberTable;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationPeoples;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationState;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationTableId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserName;

final class ReservationUpdater
{
    private $repository;
    private $finder;

    public function __construct(
        ReservationRepository $repository
    )
    {
        $this->repository = $repository;
        $this->finder = new ReservationFinder($repository);
    }

    public function __invoke(ReservationUpdaterRequest $request)
    {
        $reservation = ($this->finder)(new ReservationId($request->id()));

        $reservation->changeTable(new ReservationTableId($request->tableId()));
        $reservation->changePeoples(new ReservationPeoples($request->people()));
        $reservation->changeDate(new ReservationDate($request->date()));
        $reservation->changeState(new ReservationState($request->state()));
        $reservation->changeNumberTable(new ReservationNumberTable($request->numberTable()));
        $reservation->changeUserName(new ReservationUserName($request->userName()));

        $this->repository->update($reservation);
    }

}
