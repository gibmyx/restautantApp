<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Clients\Domain\Contract;


use AppRestaurant\Restaurant\Clients\Domain\Entity\Client;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientEmail;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientId;

interface ClientRepository
{
    public function create(Client $client): void;

    public function existsEmail(ClientEmail $email): bool;

    public function find(ClientEmail $email): ?Client;

    public function findId(ClientId $clientId): ?Client;
}
