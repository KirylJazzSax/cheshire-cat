<?php

namespace Src\Exceptions;

use LogicException;
use Throwable;

class NotFoundException extends LogicException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Not found', 404, $previous);
    }
}