<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Tables\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Shared\Infrastructure\TraitRepository;
use AppRestaurant\Restaurant\Tables\Domain\Contract\TableRepository;
use AppRestaurant\Restaurant\Tables\Domain\Entity\Table;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableCreatedAt;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableDescription;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableId;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMaxPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableMinPeople;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableCode;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableState;
use AppRestaurant\Restaurant\Tables\Domain\ValueObject\TableUpdatedAt;
use Illuminate\Support\Facades\DB;

final class TableMysqlRepository implements TableRepository
{

    use TraitRepository;

    private $table = Table::TABLE;
    private $prefix = Table::PREFIJO;

    public function create(Table $table): void
    {
        $code = $this->setCodigo();

        DB::table(Table::TABLE)
            ->insert([
                'id' => $table->id()->value(),
                'code' => $code,
                'state' => $table->state()->value(),
                'max_people' => $table->maxPeople()->value(),
                'min_people' => $table->minPeople()->value(),
                'description' => $table->description()->value(),
                'created_at' => $table->createdAt()->value(),
                'updated_at' => $table->updatedAt()->value(),
            ]);
    }

    public function find(TableId $id): ?Table
    {
        $object = DB::table(Table::TABLE)
            ->where('id', $id->value())
            ->first();

        return empty($object)
            ? null
            : Table::FormDataBase(
                new TableId($object->id),
                new TableCode($object->code),
                new TableState($object->state),
                new TableMaxPeople($object->max_people),
                new TableMinPeople($object->min_people),
                new TableDescription($object->description),
                new TableCreatedAt($object->created_at),
                new TableUpdatedAt($object->updated_at)
            );
    }

    public function update(Table $table): void
    {
        DB::table(Table::TABLE)
            ->where('id', $table->id()->value())
            ->take(1)
            ->update([
                'id' => $table->id()->value(),
                'code' => $table->code()->value(),
                'state' => $table->state()->value(),
                'max_people' => $table->maxPeople()->value(),
                'min_people' => $table->minPeople()->value(),
                'description' => $table->description()->value(),
                'created_at' => $table->createdAt()->value(),
                'updated_at' => $table->updatedAt()->value(),
            ]);
    }

    public function searcherList(array $clause)
    {
        $query = DB::table(Table::TABLE);
        $query = (new TableMySqlFilters($query))($clause);
        $query->orderBy('created_at', 'desc');
        return $query->paginate(5);
    }
}
