<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Application\Searcher;

use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;

final class ReservationsLastUserSearcher
{

    public function __construct(
      private ReservationRepository $repository
    ) {
    }

    public function __invoke(ReservationsLastUserSearcherRequest $request): array
    {
        $startMonth = (new \DateTime())->format("Y-01-01");
        $endMonth = (new \DateTime())->format("Y-m-t 23:59:59");

        $reservationsTotal = $this->repository->searcherHistory($startMonth, $endMonth, "", $request->userId());
        $reservationsCompleted = $this->repository->searcherHistory($startMonth, $endMonth, Reservation::STATE_COMPLETED, $request->userId());
        $reservationsCanceled = $this->repository->searcherHistory($startMonth, $endMonth, Reservation::STATE_CANCELED, $request->userId());

        return [
            "reservationsTotal" => $reservationsTotal,
            "reservationsCompleted" => $reservationsCompleted,
            "reservationsCanceled" => $reservationsCanceled,
        ];
    }
}
