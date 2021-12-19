<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Application\Response;

use function Lambdish\Phunctional\map;

final class ClientsSearcherResponse
{
    private $response;
    private $pagination;

    public function __construct(
        ClientSearcherResponse ...$response
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
        return map(function (ClientSearcherResponse $reservationResponse) {
            return [
                'id' => $reservationResponse->id(),
                'name' => $reservationResponse->name(),
                'email' => $reservationResponse->email(),
                'reservations' => $reservationResponse->reservations(),
                'reservationCompleted' => $reservationResponse->reservationCompleted(),
                'reservationPeding' => $reservationResponse->reservationPeding(),
            ];
        }, $this->response);
    }

}
