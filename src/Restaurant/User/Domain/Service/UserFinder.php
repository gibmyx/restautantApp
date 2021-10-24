<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Domain\Service;

use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use AppRestaurant\Restaurant\User\Domain\Entity\User;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;

final class UserFinder
{
    private $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(UserEmail $email): User
    {
        $user = $this->repository->find($email);

        if(empty($user))
            throw new UserNotExistsException();

        return $user;
    }
}
