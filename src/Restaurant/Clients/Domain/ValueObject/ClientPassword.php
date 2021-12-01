<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Clients\Domain\ValueObject;

use AppRestaurant\Restaurant\Shared\Domain\ValueObject\StringValueObject;

final class ClientPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

}
