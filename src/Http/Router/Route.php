<?php

namespace Src\Http\Router;

class Route
{
    public $name;
    public $pattern;
    public $handler;
    public $methods;
    public $tokens;

    public function __construct($name, $pattern, $handler, $methods, $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }
}