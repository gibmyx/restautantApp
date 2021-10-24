<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Domain\Contract;

use AppRestaurant\Restaurant\User\Domain\Entity\User;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserPassword;

interface UserRepository
{
    public function create(User $user): void;

    public function existsEmail(UserEmail $email): bool;

    public function find(UserEmail $email): ?user;

    public function auth(UserEmail $email, UserPassword $password): bool;
}
