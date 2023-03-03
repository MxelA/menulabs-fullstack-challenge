<?php

namespace App\Exceptions;

use Exception;

class WeatherServiceErrorException extends Exception
{
    protected $message;
    protected $code;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
