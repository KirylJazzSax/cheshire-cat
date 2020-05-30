<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 11:13
 */

namespace Src\Http\Router;


class RoutesCollection
{
    private $routes = [];

    public function get($name, $pattern, $handler, array $tokens = []): void
    {
        if (isset($this->routes[$name])) {
            $this->routes[$name]->methods[] = 'GET';
            return;
        }
        $this->routes[$name] = new Route($name, $pattern, $handler, ['GET'], $tokens);
    }

    public function post($name, $pattern, $handler, array $tokens = []): void
    {
        if (isset($this->routes[$name])) {
            $this->routes[$name]->methods[] = 'POST';
            return;
        }
        $this->routes[$name] = new Route($name, $pattern, $handler, ['POST'], $tokens);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }


}