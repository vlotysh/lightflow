<?php

namespace Core\Framework\Http\Router;

use Core\Framework\Http\Router\Route\RegexpRoute;

use \Aura\Router\Route;

class RouteCollection
{
    private $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function add($name, $path, $handler, array $methods = ['GET'])
    {
        $route = new Route;
        $route->name($name);
        $route->path($path);
        $route->handler($handler);
        $route->allows($methods);

        $this->addRoute($route);
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
