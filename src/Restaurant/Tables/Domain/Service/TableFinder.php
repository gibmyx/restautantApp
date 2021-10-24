<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Domain\Service;


use AppRestaurant\Restaurant\Tables\Domain\Contract\TableRepository;
use AppRestaurant\Restaurant\Tables\Domain\Entity\Table;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;

final class TableFinder
{
    private $repository;

    public function __construct(
        TableRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(TableId $id): Table
    {
        $table = $this->repository->find($id);

        if(empty($table))
            throw new TableNotExistsException();

        return $table;
    }

}
