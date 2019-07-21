<?php

namespace Core;

use Core\{
    Exception\ExceptionHandler,
    Framework\Http\HttpServiceProvider,
    Framework\Http\ResponseSender,
    Framework\Http\Router\RouteProvider,
    Framework\Http\Router\RouteProviderInterface,
    Interfaces\ServiceProviderInterface
};

use App\Routes\MainRouteProvider;

use Aura\Router\RouterContainer;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use \Exception;

/**
 * Class App
 *
 * @package App\Core
 */
class App
{

    /**
     * @var
     */
    private $rootPath;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->rootPath = APP_ROOT;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        set_exception_handler(function ($e) {
            $handler = new ExceptionHandler();
            $handler->handle($e);
        });

        $serviceLocator = new ServiceLocator();

        $this->initServiceProviders([
            new CoreServiceProvider(),
            new HttpServiceProvider(),
            new ListenersServiceProvider()
        ], $serviceLocator);

        $eventDispatcher = $serviceLocator->get('event.dispatcher');

        $eventDispatcher->attach('404.exception', $serviceLocator->get('not-found.listener'));

        $routerContainer = $serviceLocator->get('router.container');

        $this->initRoutes([
            new MainRouteProvider()
        ], $routerContainer);

        $routerDispatcher = $serviceLocator->get('router.dispatcher');

        try {
            $response = $routerDispatcher->dispatch($routerContainer);

            (new ResponseSender())->send($response);
        } catch (NotFoundHttpException $e) {
            $eventDispatcher->publish('404.exception');
        }
    }

    /**
     * @param array          $providersList
     * @param ServiceLocator $serviceLocator
     *
     * @throws Exception
     */
    private function initServiceProviders(array $providersList, $serviceLocator): void
    {
        foreach ($providersList as $provider) {
            /**
             * @var $provider DependencyInjectionInterface
             */
            if (! $provider instanceof ServiceProviderInterface) {
                throw new Exception('Service provider Must be implement of DependencyInjectionInterface');
            }

            $provider->bind($serviceLocator);
        }
    }

    /**
     * @param array $routeList
     * @param RouterContainer $routerContainer
     *
     * @throws Exception
     */
    private function initRoutes(array $routeList, RouterContainer $routerContainer): void
    {
        $mapper = $routerContainer->getMap();

        foreach ($routeList as $route) {
            /**
             * @var $route RouteProvider
             */
            if (! $route instanceof RouteProviderInterface) {
                throw new Exception('Route Must be implement of RouteProvider');
            }

            $route->bind($mapper);
        }
    }
}
