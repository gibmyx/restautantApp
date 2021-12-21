<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Dashboard\Application\Searcher;

use AppRestaurant\Restaurant\Dashboard\Application\Response\InformationHeaderResponse;
use AppRestaurant\Restaurant\Dashboard\Domain\Entity\DashboardInformationHeader;
use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;

final class InformationHeaderSearcher
{

    public function __construct(
        private UserRepository $userRepository,
        private ReservationRepository $reservationRepository
    )
    {
    }

    public function __invoke(InformationHeaderSearcherRequest $request): InformationHeaderResponse
    {
        $dashboardInformationHeader = DashboardInformationHeader::make(
            $request->startLastMonth(),
            $request->endLastMonth(),
            $request->startCurrentMonth(),
            $request->endCurrentMonth()
        );

        $clients = $this->userRepository->searcherInformationHeader($dashboardInformationHeader);
        $reservations = $this->reservationRepository->searcherInformationHeader($dashboardInformationHeader);
        $reservationsCompleted = $this->reservationRepository->searcherInformationHeader($dashboardInformationHeader, Reservation::STATE_COMPLETED);
        $reservationsCanceled = $this->reservationRepository->searcherInformationHeader($dashboardInformationHeader, Reservation::STATE_CANCELED);

        return InformationHeaderResponse::make($clients, $reservations, $reservationsCompleted, $reservationsCanceled);
    }

}
