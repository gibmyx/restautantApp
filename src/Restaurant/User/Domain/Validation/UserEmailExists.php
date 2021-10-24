<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\User\Domain\Validation;


use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use AppRestaurant\Restaurant\User\Domain\Exception\EmailExistsException;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;

final class UserEmailExists
{
    private $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(UserEmail $email): void
    {
        $exists = $this->repository->existsEmail($email);

        if($exists)
            throw new EmailExistsException();
    }
}
