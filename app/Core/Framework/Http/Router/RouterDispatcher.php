<?php


namespace App\Core\Framework\Http\Router;


use App\Core\ServiceLocator;
use Aura\Router\Route;

use Aura\Router\RouterContainer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Twig\Error\LoaderError;

use \Throwable;
use \Exception;

/**
 * Class RouteDispatcher
 *
 * @package App\Core\Framework\Http\Router
 */
class RouterDispatcher
{
    /**
     * @var ServiceLocator
     */
    private $serviceLocator;

    /**
     * @var RouterResolver
     */
    private $routeResolver;

    /**
     * RouteDispatcher constructor.
     *
     * @param ServiceLocator $serviceLocator
     * @param RouterResolver $routeResolver
     */
    public function __construct(
        ServiceLocator $serviceLocator,
        RouterResolver $routeResolver
    )
    {
        $this->routeResolver = $routeResolver;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param RouterContainer $routerContainer
     *
     * @return ResponseInterface
     *
     * @throws Exception
     */
    public function dispatch(RouterContainer $routerContainer)
    {
        $request = $this->serviceLocator->get('request');

        $matcher = $routerContainer->getMatcher();
        $route = $matcher->match($request);

        if (!$route) {
            throw new NotFoundHttpException();
        }

        return $this->invoke($route, $request);
    }

    /**
     * @param Route $route
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws Exception
     */
    private function invoke(Route $route, RequestInterface $request): ResponseInterface
    {
        $handler = $route->handler;
        $serviceLocator = $this->serviceLocator;

        foreach ($route->attributes as $key => $val) {
            $request = $request->withAttribute($key, $val);
        }

        try {
            list($controller, $action) = explode('::', $handler);

            $controllerObject = new $controller();
            $controllerObject->setServiceLocator($serviceLocator);

            return call_user_func([$controllerObject, $action], $request);
        } catch (LoaderError $e) {
            throw new Exception($e->getMessage());
        } catch (Throwable $e) {
            var_dump($e);
            exit();
            throw new Exception("Unable to load handler {$handler}");
        }
    }
}
