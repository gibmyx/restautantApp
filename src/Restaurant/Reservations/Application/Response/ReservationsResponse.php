<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Application\Response;

use function Lambdish\Phunctional\map;

final class ReservationsResponse
{
    private $response;
    private $pagination;

    private $stateClass = [
        "pending" => "bg-warning",
        "approved" => "bg-info",
        "to_be_confirmed" => "bg-info",
        "completed" => "bg-success",
        "canceled" => "bg-danger",
        "incompleted" => "bg-danger",
    ];

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
                'code' => $reservationResponse->code(),
                'tableId' => $reservationResponse->tableId(),
                'userId' => $reservationResponse->userId(),
                'peoples' => $reservationResponse->peoples(),
                'date' => (new \DateTime($reservationResponse->date()))->format("Y-m-d H:i"),
                'state' => $reservationResponse->state(),
                'codeTable' => $reservationResponse->codeTable(),
                'userName' => $reservationResponse->userName(),
                'stateClass' => key_exists($reservationResponse->state(), $this->stateClass) ? $this->stateClass[$reservationResponse->state()] : '',
            ];
        }, $this->response);
    }
}
