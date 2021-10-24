<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Domain\ValueObject;

use AppRestaurant\Restaurant\Shared\Domain\ValueObject\StringValueObject;

final class UserPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

}
