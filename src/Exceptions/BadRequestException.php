<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.05.2020
 * Time: 2:04
 */

namespace Src\Exceptions;


use LogicException;
use Throwable;

class BadRequestException extends LogicException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Bad request', 400, $previous);
    }
}