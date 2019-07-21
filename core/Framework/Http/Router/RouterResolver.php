<?php


namespace Core\Framework\Http\Router;

use Aura\{
    Router\Exception\RouteAlreadyExists,
    Router\Route,
    Router\RouterContainer
};

use Psr\Http\Message\RequestInterface;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouterResolver
{
    /**
     * @var RouterContainer
     */
    private $routeContainer;

    /**
     * Router constructor.
     *
     * @param RouterContainer $routeContainer
     */
    public function __construct(RouterContainer $routeContainer)
    {
        $this->routeContainer = $routeContainer;
    }

    /**
     * @param RequestInterface $request
     *
     * @return Route
     */
    public function match(RequestInterface $request): Route
    {
        $matcher = $this->routeContainer->getMatcher();
        $route = $matcher->match($request);

        if ($route === false) {
            throw new NotFoundHttpException();
        }

        return $route;
    }

    /**
     * @param RouteCollection $routeCollection
     *
     * @throws RouteAlreadyExists
     */
    public function bindRoutes(RouteCollection $routeCollection)
    {
        $mapper = $this->routeContainer->getMap();

        foreach ($routeCollection->getRoutes() as $route) {
            /**
             * @var $route Route
             */
            $mapper->addRoute($route);
        }
    }
}
