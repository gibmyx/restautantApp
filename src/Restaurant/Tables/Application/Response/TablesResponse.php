<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Application\Response;

use AppRestaurant\Restaurant\Tables\Domain\Entity\Table;
use function Lambdish\Phunctional\map;

final class TablesResponse
{
    private $table;
    private $pagination;

    private $stateClass = [
        Table::STATE_AVAILABLE => "bg-success",
        Table::STATE_OCCUPIED => "bg-danger",
    ];

    private $stateText = [
        Table::STATE_AVAILABLE => "Disponible",
        Table::STATE_OCCUPIED => "Fuera de Servicio",
    ];

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
                'state' => $table->state(),
                'maxPeople' => $table->maxPeople(),
                'minPeople' => $table->minPeople(),
                'stateClass' => key_exists($table->state(), $this->stateClass) ? $this->stateClass[$table->state()] : '',
                'stateText' => key_exists($table->state(), $this->stateText) ? $this->stateText[$table->state()] : '',
            ];
        }, $this->table);
    }

}
