<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Application\Searcher;

use AppRestaurant\Restaurant\Tables\Application\Response\TableResponse;
use AppRestaurant\Restaurant\Tables\Application\Response\TablesResponse;
use AppRestaurant\Restaurant\Tables\Domain\Contract\TableRepository;
use function Lambdish\Phunctional\map;

final class TablesSearcher
{
    private $repository;

    public function __construct(
        TableRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(TablesSearcherRequest $request)
    {
        $result = $this->repository->searcherList($request->filters());

        $response = new TablesResponse(...map(
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
        return function ($table) {
            return new TableResponse(
                (string)$table->id,
                (string)$table->code,
                (string)$table->state,
                (int)$table->max_people,
                (int)$table->min_people,
                (string)$table->description,
                (string)$table->created_at,
                (string)$table->updated_at,
            );
        };
    }

}
