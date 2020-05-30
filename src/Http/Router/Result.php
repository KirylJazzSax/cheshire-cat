<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 12:05
 */

namespace Src\Http\Router;


class Result
{
    private $name;
    private $handler;
    private $attributes;

    public function __construct($name, $handler, $attributes)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}