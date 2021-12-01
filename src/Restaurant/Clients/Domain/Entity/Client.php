<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Domain\Entity;

use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientCreatedAt;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientEmail;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientId;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientName;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientOrigin;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientPassword;
use AppRestaurant\Restaurant\Clients\Domain\ValueObject\ClientUpdatedAt;

final class Client
{
    const TABLE_NAME = "clients";

    private $id;
    private $name;
    private $email;
    private $password;
    private $origin;
    private $createdAt;
    private $updateAt;

    private function __construct(
        ClientId $id,
        ClientName $name,
        ClientEmail $email,
        ClientPassword $password,
        ClientOrigin $origin,
        ClientCreatedAt $createdAt,
        ClientUpdatedAt $updateAt
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
        ClientId $id,
        ClientName $name,
        ClientEmail $email,
        ClientPassword $password,
        ClientOrigin $origin
    ): self
    {
        return new self(
            $id,
            $name,
            $email,
            $password,
            $origin,
            new ClientCreatedAt(),
            new ClientUpdatedAt()
        );
    }

    public static function FormDataBase(
        ClientId $id,
        ClientName $name,
        ClientEmail $email,
        ClientPassword $password,
        ClientOrigin $origin,
        ClientCreatedAt $createdAt,
        ClientUpdatedAt $updateAt
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

    public function id(): ClientId
    {
        return $this->id;
    }

    public function name(): ClientName
    {
        return $this->name;
    }

    public function email(): ClientEmail
    {
        return $this->email;
    }

    public function password(): ClientPassword
    {
        return $this->password;
    }

    public function origin(): ClientOrigin
    {
        return $this->origin;
    }

    public function createdAt(): ClientCreatedAt
    {
        return $this->createdAt;
    }

    public function updateAt(): ClientUpdatedAt
    {
        return $this->updateAt;
    }
}
