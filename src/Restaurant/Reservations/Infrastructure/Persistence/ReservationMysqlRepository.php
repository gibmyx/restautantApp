<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationCreatedAt;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationDate;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationPeoples;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationTableId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUpdatedAt;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserId;
use Illuminate\Support\Facades\DB;

final class ReservationMysqlRepository implements ReservationRepository
{

    public function create(Reservation $reservation): void
    {
        DB::table(Reservation::TABLE)
            ->insert([
                'id'            => $reservation->id()->value(),
                'table_id'      => $reservation->tableId()->value(),
                'user_id'      => $reservation->userId()->value(),
                'peoples'       => $reservation->peoples()->value(),
                'date'          => $reservation->date()->value(),
                'created_at'    => $reservation->createdAt()->value(),
                'updated_at'    => $reservation->updatedAt()->value()
            ]);
    }

    public function searcherList(array $clause): array
    {
        $query = DB::table(Reservation::TABLE);
        $query = (new ReservationMySqlFilters($query))($clause);
        return $query->get()->toArray();
    }

    public function find(ReservationId $id): ?Reservation
    {
        $object = DB::table(Reservation::TABLE)
            ->where('id', $id->value())
            ->first();

        return empty($object)
            ? null
            : Reservation::FormDataBase(
                new ReservationId($object->id),
                new ReservationTableId($object->table_id),
                new ReservationUserId($object->user_id),
                new ReservationPeoples($object->peoples),
                new ReservationDate($object->date),
                new ReservationCreatedAt($object->created_at),
                new ReservationUpdatedAt($object->updated_at),
            );
    }

    public function update(Reservation $reservation): void
    {
        DB::table(Reservation::TABLE)
            ->where('id', $reservation->id()->value())
            ->take(1)
            ->update([
                'id'            => $reservation->id()->value(),
                'table_id'      => $reservation->tableId()->value(),
                'user_id'      => $reservation->userId()->value(),
                'peoples'       => $reservation->peoples()->value(),
                'date'          => $reservation->date()->value(),
                'created_at'    => $reservation->createdAt()->value(),
                'updated_at'    => $reservation->updatedAt()->value()
            ]);
    }
}
