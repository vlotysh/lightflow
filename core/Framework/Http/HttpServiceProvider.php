<?php


namespace Core\Framework\Http;

use Core\{
    Framework\Http\Router\RouterResolver,
    Framework\Http\Router\RouterDispatcher,
    Interfaces\ServiceProviderInterface,
    ServiceLocator
};

use Aura\Router\RouterContainer;

/**
 * Class HttpDependencyInjection
 *
 * @package Core\Framework\Http
 */
class HttpServiceProvider implements ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
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
            $routerContainer = $serviceLocator->get('router.container');
            $request = $serviceLocator->get('request');

            return new RouterResolver($routerContainer, $request);
        });
    }
}
