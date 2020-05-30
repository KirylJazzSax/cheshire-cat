<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.05.2020
 * Time: 12:01
 */

namespace Src\Exceptions;

use LogicException;
use Throwable;

class MethodNotAllowedException extends LogicException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Method not allowed', 405, $previous);
    }
}