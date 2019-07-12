<?php


namespace App\Core\Framework\Http\Router;


use Aura\Router\Map;

/**
 * Class MainRouteProvider
 *
 * @package App\Core\Framework\Http\Router
 */
class MainRouteProvider implements RouteProviderInterface
{
    /**
     * @param Map $mapper
     */
    public function bind(Map $mapper): void
    {
        $mapper->get('index', '/', 'App\Controllers\IndexController::index');
        $mapper->get('blog-index', '/blog', 'App\Controllers\BlogController::index');
        $mapper->get('blog-one', '/blog/{id}', 'App\Controllers\BlogController::show');
    }
}
