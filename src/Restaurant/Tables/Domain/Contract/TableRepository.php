<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Tables\Domain\Contract;


use AppRestaurant\Restaurant\Tables\Domain\Entity\Table;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;

interface TableRepository
{
    public function create(Table $table): void;

    public function update(Table $table): void;

    public function find(TableId $id): ?Table;

    public function searcherList(array $clause): array;

}
