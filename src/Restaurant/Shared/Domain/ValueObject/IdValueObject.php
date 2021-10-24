<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Shared\Domain\ValueObject;

use AppRestaurant\Restaurant\Shared\Domain\Exception\EmptyArgumentException;

class IdValueObject
{
    private $value;
    private $exceptionMessage;
    private $exceptionCode;

    public function __construct(?int $value = null)
    {
        $this->value = $value;
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }
}
