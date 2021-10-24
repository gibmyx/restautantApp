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
        return new TablesResponse(...map(
            $this->toResponse(),
            $this->repository->searcherList($request->filters())
        ));
    }


    private function toResponse(): callable
    {
        return function ($table) {
            return new TableResponse(
                (string)$table->id,
                (int)$table->number,
                (int)$table->max_people,
                (int)$table->min_people,
                (string)$table->description,
                (string)$table->created_at,
                (string)$table->updated_at,
            );
        };
    }

}
