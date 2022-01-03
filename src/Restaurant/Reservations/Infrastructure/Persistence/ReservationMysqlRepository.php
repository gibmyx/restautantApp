<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Reservations\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Dashboard\Domain\Entity\DashboardInformationHeader;
use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Entity\Reservation;
use AppRestaurant\Restaurant\Reservations\Domain\ValueObject\ReservationCode;
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

    private $table = Reservation::TABLE_NAME;
    private $prefix = Reservation::PREFIJO;

    public function create(Reservation $reservation): void
    {
        $code = $this->setCodigo();
        DB::table(Reservation::TABLE_NAME)
            ->insert([
                'id' => $reservation->id()->value(),
                'code' => $code,
                'table_id' => $reservation->tableId()->value(),
                'user_id' => $reservation->userId()->value(),
                'peoples' => $reservation->peoples()->value(),
                'date' => $reservation->date()->value(),
                'state' => $reservation->state()->value(),
                'code_table' => $reservation->codeTable()->value(),
                'user_name' => $reservation->userName()->value(),
                'created_at' => $reservation->createdAt()->value(),
                'updated_at' => $reservation->updatedAt()->value()
            ]);
    }

    public function searcherList(array $clause, int $limit)
    {
        $query = DB::table(Reservation::TABLE_NAME);
        $query = (new ReservationMySqlFilters($query))($clause);
        $query->orderBy('created_at', 'desc');
        return $query->paginate($limit);
    }

    public function find(ReservationId $id): ?Reservation
    {
        $object = DB::table(Reservation::TABLE_NAME)
            ->where('id', $id->value())
            ->first();

        return empty($object)
            ? null
            : Reservation::FormDataBase(
                new ReservationId($object->id),
                new ReservationCode($object->code),
                new ReservationTableId($object->table_id),
                new ReservationUserId($object->user_id),
                new ReservationPeoples($object->peoples),
                new ReservationDate($object->date),
                new ReservationState($object->state),
                new ReservationCodeTable($object->code_table),
                new ReservationUserName($object->user_name),
                new ReservationCreatedAt($object->created_at),
                new ReservationUpdatedAt($object->updated_at),
            );
    }

    public function update(Reservation $reservation): void
    {
        DB::table(Reservation::TABLE_NAME)
            ->where('id', $reservation->id()->value())
            ->take(1)
            ->update([
                'id' => $reservation->id()->value(),
                'table_id' => $reservation->tableId()->value(),
                'user_id' => $reservation->userId()->value(),
                'peoples' => $reservation->peoples()->value(),
                'date' => $reservation->date()->value(),
                'state' => $reservation->state()->value(),
                'code_table' => $reservation->codeTable()->value(),
                'user_name' => $reservation->userName()->value(),
                'created_at' => $reservation->createdAt()->value(),
                'updated_at' => $reservation->updatedAt()->value()
            ]);
    }

    public function searcherInformationHeader(DashboardInformationHeader $informationHeader, string $state = ''): array
    {

        $queryLast = DB::table(Reservation::TABLE_NAME);
        $queryLast = (new ReservationMySqlFilters($queryLast))([
            "startCreatedAt" => $informationHeader->startLastMonth(),
            "endCreatedAt" => $informationHeader->endLastMonth(),
            "state" => $state,
        ]);

        $queryCurrent = DB::table(Reservation::TABLE_NAME);
        $queryCurrent = (new ReservationMySqlFilters($queryCurrent))([
            "startCreatedAt" => $informationHeader->startCurrentMonth(),
            "endCreatedAt" => $informationHeader->endCurrentMonth(),
            "state" => $state,
        ]);

        return [
            "currentMonth" => $queryCurrent->count(),
            "lastMonth" => $queryLast->count(),
        ];
    }

    public function searcherHistory(string $dateFrom, string $dateTo, string $state = '', ?int $userId = null): int
    {
        $queryCurrent = DB::table(Reservation::TABLE_NAME);
        $queryCurrent = (new ReservationMySqlFilters($queryCurrent))([
            "startCreatedAt" => $dateFrom,
            "endCreatedAt" => $dateTo,
            "state" => $state,
            "userId" => $userId,
        ]);
        return $queryCurrent->count();
    }
}
