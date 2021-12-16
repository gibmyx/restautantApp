<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationCreatedAt;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationDate;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationCodeTable;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationPeoples;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationState;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationTableId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUpdatedAt;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserId;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationUserName;
use AppRestaurant\Restaurant\Shared\Infrastructure\TraitRepository;
use Illuminate\Support\Facades\DB;

final class ReservationMysqlRepository implements ReservationRepository
{
    use TraitRepository;

    private $table = Reservation::TABLE;
    private $prefix = Reservation::PREFIJO;

    public function create(Reservation $reservation): void
    {
        $code = $this->setCodigo();
        DB::table(Reservation::TABLE)
            ->insert([
                'id'            => $reservation->id()->value(),
                'code'          => $code,
                'table_id'      => $reservation->tableId()->value(),
                'user_id'       => $reservation->userId()->value(),
                'peoples'       => $reservation->peoples()->value(),
                'date'          => $reservation->date()->value(),
                'state'         => $reservation->state()->value(),
                'code_table'    => $reservation->codeTable()->value(),
                'user_name'     => $reservation->userName()->value(),
                'created_at'    => $reservation->createdAt()->value(),
                'updated_at'    => $reservation->updatedAt()->value()
            ]);
    }

    public function searcherList(array $clause)
    {
        $query = DB::table(Reservation::TABLE);
        $query = (new ReservationMySqlFilters($query))($clause);
        $query->orderBy('created_at', 'desc');
        return $query->paginate(5);
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
                new ReservationState($object->state),
                new ReservationCodeTable((int) $object->code_table),
                new ReservationUserName($object->user_name),
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
                'user_id'       => $reservation->userId()->value(),
                'peoples'       => $reservation->peoples()->value(),
                'date'          => $reservation->date()->value(),
                'state'         => $reservation->state()->value(),
                'code_table'  => $reservation->codeTable()->value(),
                'user_name'     => $reservation->userName()->value(),
                'created_at'    => $reservation->createdAt()->value(),
                'updated_at'    => $reservation->updatedAt()->value()
            ]);
    }
}
