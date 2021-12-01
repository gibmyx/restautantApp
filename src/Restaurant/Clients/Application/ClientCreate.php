<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Clients\Application;


use AppRestaurant\Restaurant\Clients\Domain\Contract\ClientRepository;
use AppRestaurant\Restaurant\Clients\Domain\Entity\Client;
use AppRestaurant\Restaurant\Clients\Domain\Validation\ClientEmailExists;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientEmail;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientId;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientName;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientOrigin;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientPassword;

final class ClientCreate
{
    private $clientEmailExists;
    private $repository;

    public function __construct(
        ClientRepository $repository
    )
    {
        $this->clientEmailExists = new ClientEmailExists($repository);
        $this->repository = $repository;
    }

    public function __invoke(ClientCreateRequest $request)
    {

        ($this->clientEmailExists)(new ClientEmail($request->email()));

        $use = Client::create(
            new ClientId($request->id()),
            new ClientName($request->name()),
            new ClientEmail($request->email()),
            new ClientPassword($request->password()),
            new ClientOrigin($request->origin())
        );

        $this->repository->create($use);
    }
}
