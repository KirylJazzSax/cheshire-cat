<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 11:45
 */

namespace Src\Http\Router;

use Src\Exceptions\MethodNotAllowedException;
use Src\Exceptions\NotFoundException;
use Src\Http\Request;


class Router
{
    private $routes;

    public function __construct(RoutesCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request)
    {
        /** @var Route $route */
        foreach ($this->routes->getRoutes() as $route) {
            $matches = [];
            preg_match('#^' . $route->pattern . '$#', $request->getPath(), $matches);

            if (in_array($request->getPath(), $matches)) {
                if (!in_array($request->getMethod(), $route->methods)) {
                    throw new MethodNotAllowedException();
                }

                return new Result(
                    $route->name,
                    $route->handler,
                    array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
                );
            }
        }
        throw new NotFoundException();
    }
}