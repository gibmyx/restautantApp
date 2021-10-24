<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\User\Domain\Entity;


use AppRestaurant\Restaurant\User\Domain\ValueObject\UserCreatedAt;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserEmail;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserId;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserName;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserOrigin;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserPassword;
use AppRestaurant\Restaurant\User\Domain\ValueObject\UserUpdatedAt;

final class User
{
    const TABLE_NAME = "users";

    private $id;
    private $name;
    private $email;
    private $password;
    private $origin;
    private $createdAt;
    private $updateAt;

    private function __construct(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserOrigin $origin,
        UserCreatedAt $createdAt,
        UserUpdatedAt $updateAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->origin = $origin;
        $this->createdAt = $createdAt;
        $this->updateAt = $updateAt;
    }

    public static function create(
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserOrigin $origin
    ): self
    {
        return new self(
            new UserId(),
            $name,
            $email,
            $password,
            $origin,
            new UserCreatedAt(),
            new UserUpdatedAt()
        );
    }

    public static function FormDataBase(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserOrigin $origin,
        UserCreatedAt $createdAt,
        UserUpdatedAt $updateAt
    ): self
    {
        return new self(
            $id,
            $name,
            $email,
            $password,
            $origin,
            $createdAt,
            $updateAt
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function origin(): UserOrigin
    {
        return $this->origin;
    }

    public function createdAt(): UserCreatedAt
    {
        return $this->createdAt;
    }

    public function updateAt(): UserUpdatedAt
    {
        return $this->updateAt;
    }
}
