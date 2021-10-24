<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\User\Application\Create;


use AppRestaurant\Restaurant\User\Domain\Entity\User;
use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use AppRestaurant\Restaurant\User\Domain\Validation\UserEmailExists;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserName;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserOrigin;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserPassword;

final class UserCreate
{
    private $userEmailExists;
    private $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->userEmailExists = new UserEmailExists($repository);
        $this->repository = $repository;
    }

    public function __invoke(UserCreateRequest $request)
    {
        ($this->userEmailExists)(new UserEmail($request->email()));

        $use = User::create(
            new UserName($request->name()),
            new UserEmail($request->email()),
            new UserPassword($request->password()),
            new UserOrigin($request->origin())
        );

        $this->repository->create($use);
    }


}
