<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Domain\Validation;

use AppRestaurant\Restaurant\Clients\Domain\Contract\ClientRepository;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientEmail;
use AppRestaurant\Restaurant\User\Domain\Exception\EmailExistsException;

final class ClientEmailExists
{
    private $repository;

    public function __construct(
        ClientRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientEmail $email): void
    {
        $exists = $this->repository->existsEmail($email);

        if($exists)
            throw new EmailExistsException();
    }
}
