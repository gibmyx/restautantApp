<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Application\Response;

use function Lambdish\Phunctional\map;

final class TablesResponse
{
    private $table;

    public function __construct(TableResponse ...$table)
    {
        $this->table = $table;
    }

    public function toResponse(): array
    {
        return map(function(TableResponse $table) {
            return [
                'id' => $table->id(),
                'description' => $table->description(),
                'number' => $table->number(),
                'maxPeople' => $table->maxPeople(),
                'minPeople' => $table->minPeople(),
            ];
        }, $this->table);
    }

}
