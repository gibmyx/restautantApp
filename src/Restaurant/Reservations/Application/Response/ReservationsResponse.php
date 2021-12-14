<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Response;


use function Lambdish\Phunctional\map;

final class ReservationsResponse
{
    private $response;
    private $pagination;

    public function __construct(
        ReservationResponse ...$response
    )
    {
        $this->response = $response;
    }

    public function setPagination(array $pagination)
    {
        $this->pagination = $pagination;
    }

    public function pagination()
    {
        return $this->pagination;
    }

    public function toResponse(): array
    {
        return map(function (ReservationResponse $reservationResponse) {
            return [
                'id' => $reservationResponse->id(),
                'tableId' => $reservationResponse->tableId(),
                'userId' => $reservationResponse->userId(),
                'peoples' => $reservationResponse->peoples(),
                'date' => $reservationResponse->date(),
                'state' => $reservationResponse->state(),
                'numberTable' => $reservationResponse->numberTable(),
                'userName' => $reservationResponse->userName(),
            ];
        }, $this->response);
    }
}
