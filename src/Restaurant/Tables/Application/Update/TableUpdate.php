<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Application\Update;


use AppRestaurant\Restaurant\Tables\Domain\Contract\TableRepository;
use AppRestaurant\Restaurant\Tables\Domain\Service\TableFinder;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableDescription;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMaxPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMinPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableNumber;

final class TableUpdate
{
    private $repository;

    public function __construct(
        TableRepository $repository
    )
    {
        $this->repository = $repository;
        $this->finder = new TableFinder($repository);
    }

    public function __invoke(TableUpdateRequest $request)
    {
        $table = ($this->finder)(new TableId($request->id()));

        $table->changeNumber(new TableNumber($request->number()));
        $table->changeMaxPeople(new TableMaxPeople($request->maxPeople()));
        $table->changeMinPeople(new TableMinPeople($request->minPeople()));
        $table->changeDescription(new TableDescription($request->description()));

        $this->repository->update($table);
    }
}
