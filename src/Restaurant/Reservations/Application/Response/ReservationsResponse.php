<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Response;


use function Lambdish\Phunctional\map;

final class ReservationsResponse
{
    private $response;

    public function __construct(
        ReservationResponse ...$response
    )
    {
        $this->response = $response;
    }

    public function toResponse(): array
    {
        return map(function(ReservationResponse $table) {
            return [
                'id' => $table->id(),
                'tableId' => $table->tableId(),
                'userId' => $table->userId(),
                'peoples' => $table->peoples(),
                'date' => $table->date(),
            ];
        }, $this->response);
    }
}
