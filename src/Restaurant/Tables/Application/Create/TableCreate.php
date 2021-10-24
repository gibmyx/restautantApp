<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Application\Create;


use AppRestaurant\Restaurant\Tables\Domain\Contract\TableRepository;
use AppRestaurant\Restaurant\Tables\Domain\Entity\Table;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableDescription;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMaxPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMinPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableNumber;

final class TableCreate
{
    private $repository;

    public function __construct(
        TableRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(TableCreateRequest $request)
    {
        $table = Table::create(
            new TableId($request->id()),
            new TableNumber($request->number()),
            new TableMaxPeople($request->maxPeople()),
            new TableMinPeople($request->minPeople()),
            new TableDescription($request->description())
        );

        $this->repository->create($table);
    }

}
