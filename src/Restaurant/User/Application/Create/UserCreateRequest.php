<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\User\Application\Create;


final class UserCreateRequest
{
    private $name;
    private $email;
    private $password;
    private $passwordConfirmation;
    private $origin;

    public function __construct(
        string $name,
        string $email,
        string $password,
        string $passwordConfirmation,
        ?string $origin
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
        $this->origin = $origin;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function passwordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }

    public function origin(): string
    {
        return empty($this->origin) ? 'web' : $this->origin;
    }

}
