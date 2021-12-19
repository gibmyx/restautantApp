<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Application\Searcher;

use AppRestaurant\Restaurant\Clients\Application\Response\ClientSearcherResponse;
use AppRestaurant\Restaurant\Clients\Application\Response\ClientsSearcherResponse;
use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use function Lambdish\Phunctional\map;

final class ClientsSearcher
{

    public function __construct(
        private UserRepository $repository
    )
    {
    }

    public function __invoke(ClientsSearcherRequest $request)
    {

        $result = $this->repository->searcherList($request->filters());

        $response = new ClientsSearcherResponse(...map(
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
          return new ClientSearcherResponse(
              (int)$row->id,
              (string)$row->name,
              (string)$row->email,
              (int)$row->reservations,
              (int)$row->reservationCompleted,
              (int)$row->reservationPeding
          );
        };
    }
}
