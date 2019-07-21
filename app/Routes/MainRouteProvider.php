<?php


namespace App\Routes;

use Core\Framework\Http\Router\RouteProviderInterface;

use Aura\Router\Map;

/**
 * Class MainRouteProvider
 *
 * @package App\Routes
 */
class MainRouteProvider implements RouteProviderInterface
{
    /**
     * @param Map $mapper
     */
    public function bind(Map $mapper): void
    {
        $mapper->get('index', '/', 'App\Controllers\IndexController::index');

        $mapper->attach('blog', '/blog', function (Map $mapper) {
            $mapper->get('blog-index', '', 'App\Controllers\BlogController::index');
            $mapper->get('blog-one', '/{id}', 'App\Controllers\BlogController::show');
        });
    }
}
