<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Infrastructure\Persistence;

use AppRestaurant\Restaurant\Clients\Domain\Contract\ClientRepository;
use AppRestaurant\Restaurant\Clients\Domain\Entity\Client;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientEmail;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientId;
use Illuminate\Support\Facades\DB;

final class ClientMysqlRepository implements ClientRepository
{

    public function create(Client $user): void
    {
        DB::table(Client::TABLE_NAME)
            ->insert([
                'id' => $user->id()->value(),
                'name' => $user->name()->value(),
                'email' => $user->email()->value(),
                'password' => $user->password()->value(),
                'origin' => $user->origin()->value(),
                'created_at' => $user->createdAt()->value(),
                'updated_at' => $user->updateAt()->value()
            ]);
    }

    public function existsEmail(ClientEmail $email): bool
    {
        return DB::table(Client::TABLE_NAME)
                ->where('email', $email->value())
                ->get()->count() > 0;    }

    public function find(ClientEmail $email): ?Client
    {
        return null;
    }

    public function findId(ClientId $clientId): ?Client
    {
        return null;
    }
}
