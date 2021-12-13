<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Reservations\Application\Searcher;


use AppRestaurant\Restaurant\Reservations\Application\Response\ReservationResponse;
use AppRestaurant\Restaurant\Reservations\Application\Response\ReservationsResponse;
use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use function Lambdish\Phunctional\map;

final class ReservationSearcher
{
    private $repository;

    public function __construct(
        ReservationRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ReservationSearcherRequest $request): ReservationsResponse
    {
        $result = $this->repository->searcherList($request->filters());

        $response = new ReservationsResponse(...map(
            $this->toResponse(),
            $result->items()
        ));

        $response->setPagination([
            'total' => $result->total(),
            'current_page' => $result->currentPage(),
            'last_page' => $result->lastPage(),
            'per_page' => $result->perPage(),
            'from' => $result->currentPage(),
            'to' => $result->lastPage(),
        ]);

        return $response;
    }

    private function toResponse(): callable
    {
        return function ($row) {
            return new ReservationResponse(
                (string)$row->id,
                (string)$row->table_id,
                (int)$row->user_id,
                (int)$row->peoples,
                (string)$row->date,
                (string)$row->date,
                (string)$row->created_at,
                (string)$row->updated_at
            );
        };
    }

}
