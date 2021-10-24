<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Infrastructure\Persistence;

use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use AppRestaurant\Restaurant\User\Domain\Entity\User;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserCreatedAt;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;

use AppRestaurant\Restaurant\User\Domain\ValueObject\UserId;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserName;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserOrigin;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserPassword;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserUpdatedAt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

final class UserMysqlRepository implements UserRepository
{

    public function create(User $user): void
    {
        DB::table(User::TABLE_NAME)
            ->insert([
                'name' => $user->name()->value(),
                'email' => $user->email()->value(),
                'password' => $user->password()->value(),
                'origin' => $user->origin()->value(),
                'created_at' => $user->createdAt()->value(),
                'updated_at' => $user->updateAt()->value()
            ]);
    }

    public function existsEmail(UserEmail $email): bool
    {
        return DB::table(User::TABLE_NAME)
            ->where('email', $email->value())
            ->get()->count() > 0;
    }

    public function auth(UserEmail $email, UserPassword $password): bool
    {
        return Auth::attempt(['email' => $email->value(), 'password' => $password->value()]);
    }

    public function find(UserEmail $email): ?user
    {
        $object = DB::table(user::TABLE_NAME)
            ->where('email', $email->value())
            ->first();

        return empty($object)
            ? null
            : user::FormDataBase(
                new UserId($object->id),
                new UserName($object->name),
                new UserEmail($object->email),
                new UserPassword($object->password),
                new UserOrigin($object->origin),
                new UserCreatedAt($object->created_at),
                new UserUpdatedAt($object->updated_at)
            );
    }
}
