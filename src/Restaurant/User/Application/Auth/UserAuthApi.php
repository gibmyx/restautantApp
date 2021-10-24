<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Application\Auth;

use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use AppRestaurant\Restaurant\User\Domain\Entity\User;
use AppRestaurant\Restaurant\User\Domain\Service\UserFinder;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserPassword;

final class UserAuthApi
{
    private $repository;
    private $finder;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
        $this->finder = new UserFinder($repository);
    }

    public function __invoke(UserAuthRequest $request): array
    {
        $userEmail = new UserEmail($request->email());
        $userPassword = new UserPassword($request->password());

        $user = ($this->finder)($userEmail);
        $auth = $this->repository->auth(
            $user->email(),
            $userPassword
        );

        if(false == $auth)
            $this->notAuth($user);

        return [
            'user' => [
                'email' => $user->email()->value(),
                'name' => $user->name()->value(),
                'id' => $user->id()->value()
            ]
        ];
    }

    private function notAuth(User $user)
    {

    }
}
