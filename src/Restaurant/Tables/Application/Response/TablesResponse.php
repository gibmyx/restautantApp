<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Application\Response;

use function Lambdish\Phunctional\map;

final class TablesResponse
{
    private $table;
    private $pagination;

    public function __construct(
        TableResponse ...$table
    )
    {
        $this->table = $table;
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
        return map(function(TableResponse $table) {
            return [
                'id' => $table->id(),
                'description' => $table->description(),
                'code' => $table->code(),
                'maxPeople' => $table->maxPeople(),
                'minPeople' => $table->minPeople(),
            ];
        }, $this->table);
    }

}
