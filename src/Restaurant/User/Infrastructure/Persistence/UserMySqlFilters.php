<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Shared\Infrastructure\Persistence\MysqlQueryFilters;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

final class UserMySqlFilters extends MysqlQueryFilters
{

    public function origin($value): void
    {
        if ($value == "mobile")
            $this->getQueryMobile();

        if ($value == "web")
            $this->getQueryWeb();
    }

    private function getQueryMobile(): void
    {
        $this->builder->where("users.origin", "=", "mobile")
            ->leftJoin("reservation", "reservation.user_id", "=", "users.id")
            ->leftJoin("reservation as reservationCompleted", function (JoinClause $query) {
                $query->on("reservationCompleted.user_id", "=", "users.id")
                    ->where("reservationCompleted.state", "=", "completed");
            })
            ->leftJoin("reservation as reservationPeding", function (JoinClause $query) {
                $query->on("reservationCompleted.user_id", "=", "users.id")
                    ->whereIn("reservationCompleted.state", ["pending", "to_be_confirmed", "approved"]);
            })
            ->groupBy("users.id")
            ->select([
                DB::raw("users.id as id"),
                DB::raw("users.name as name"),
                DB::raw("users.email as email"),
                DB::raw("count(reservation.id) as reservations"),
                DB::raw("count(reservationCompleted.id) as reservationCompleted"),
                DB::raw("count(reservationPeding.id) as reservationPeding"),
            ]);

    }

    private function getQueryWeb(): void
    {

    }

    public function startCreatedAt($value): void
    {
        $value = $this->getDate($value);
        $this->builder->where("users.created_at", ">=", $value);
    }

    public function endCreatedAt($value): void
    {
        $value = $this->getDate($value);
        $this->builder->where("users.created_at", "<=", $value);
    }

}
