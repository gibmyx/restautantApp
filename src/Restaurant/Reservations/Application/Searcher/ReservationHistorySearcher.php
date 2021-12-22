<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Application\Searcher;

use AppRestaurant\Restaurant\Reservations\Application\Response\ReservationHistoryResponse;
use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;

final class ReservationHistorySearcher
{
    private $history = [];
    private $months = [];
    private $a = 0;

    public function __construct(
        private ReservationRepository $repository
    ) {
    }

    public function __invoke(): ReservationHistoryResponse
    {
        $startMonth = (new \DateTime())->format("Y-01-01");
        $endMonth = (new \DateTime())->format("Y-m-01");

        $this->getDataMonths($startMonth, $endMonth);

        return new ReservationHistoryResponse(
            array_reverse($this->history),
            array_reverse($this->months)
        );
    }

    private function getDataMonths(string $startMonth, string $endMonth)
    {
        $startMonth = (new \DateTime($startMonth));
        $endMonth = (new \DateTime($endMonth));

        $resul = $this->repository->searcherHistory($startMonth, Reservation::STATE_COMPLETED);

        $this->history = array_merge([$resul], $this->history);
        $this->months = array_merge([$startMonth->format("M")], $this->months);

        if($startMonth != $endMonth){
            $startMonth = $startMonth->add(new \DateInterval("P1M"));
            $this->getDataMonths($startMonth->format("Y-m-d"), $endMonth->format("Y-m-d"));
        }
    }
}
