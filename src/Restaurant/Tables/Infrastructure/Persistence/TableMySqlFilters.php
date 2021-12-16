<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Shared\Infrastructure\Persistence\MysqlQueryFilters;

final class TableMySqlFilters extends MysqlQueryFilters
{
    public function code($value):void
    {
        $this->builder->where('tables.code',  "like", "%{$value}%");
    }

}
