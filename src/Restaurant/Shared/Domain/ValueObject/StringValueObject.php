<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\Shared\Domain\ValueObject;

use AppRestaurant\Restaurant\Shared\Domain\Exception\EmptyArgumentException;

class StringValueObject
{
    private $value;
    private $exceptionMessage;
    private $exceptionCode;


    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }

    protected function notEmpty(string $value): void
    {
        if (empty($value))
            throw new EmptyArgumentException($this->exceptionMessage, $this->exceptionCode);
    }
}
