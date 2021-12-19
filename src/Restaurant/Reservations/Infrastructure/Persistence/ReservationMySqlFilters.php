<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Shared\Infrastructure\Persistence\MysqlQueryFilters;

final class ReservationMySqlFilters extends MysqlQueryFilters
{

    public function code($value):void
    {
        $this->builder->where('reservation.code',  "like", "%{$value}%");
    }

    public function codeTable($value):void
    {
        $this->builder->where('reservation.code_table',  "like", "%{$value}%");
    }

    public function dateFrom($value):void
    {
        $value = $this->getDate($value);
        $this->builder->where('reservation.date',  ">=", $value);
    }

    public function dateTo($value):void
    {
        $value = $this->getDate($value);
        $this->builder->where('reservation.date',  "<=", $value);
    }
}
