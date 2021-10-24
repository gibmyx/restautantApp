<?php

declare(strict_types=1);

namespace AppRestaurant\Restaurant\User\Domain\Exception;

final class EmailExistsException extends \Exception
{
    const BAD_REQUEST = 400;

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct("The email is already registered", self::BAD_REQUEST, $previous);
    }

}
