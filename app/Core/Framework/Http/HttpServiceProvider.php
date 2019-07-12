<?php


namespace App\Core\Framework\Http;


use App\{Core\Framework\Http\Router\RouterResolver,
    Core\Framework\Http\Router\RouterDispatcher,
    Core\Interfaces\ServiceProviderInterface,
    Core\ServiceLocator};

use Aura\Router\RouterContainer;

/**
 * Class HttpDependencyInjection
 *
 * @package App\Core\Framework\Http
 */
class HttpServiceProvider implements ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
     *
     * @return ServiceLocator
     */
    public function bind(ServiceLocator $serviceLocator)
    {
        $serviceLocator->set('router.container', function () {
            return new RouterContainer;
        });

        $serviceLocator->set('router.dispatcher', function (ServiceLocator $serviceLocator) {
            $routeResolver = $serviceLocator->get('route.resolver');

            return new RouterDispatcher($serviceLocator, $routeResolver);
        });

        $serviceLocator->set('route.resolver', function (ServiceLocator $serviceLocator) {
            $routerContainer =  $serviceLocator->get('router.container');
            $request = $serviceLocator->get('request');

            return new RouterResolver($routerContainer, $request);
        });
    }
}
