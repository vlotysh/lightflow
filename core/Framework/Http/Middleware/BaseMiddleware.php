<?php


namespace Core\Framework\Http\Middleware;

use Core\ServiceLocator;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class BaseMiddleware
 *
 * @package Core\Framework\Http\Middleware
 */
abstract class BaseMiddleware
{
    /**
     * @var
     */
    protected $serviceLocator;

    /**
     * @param mixed $serviceLocator
     */
    public function setServiceLocator(ServiceLocator $serviceLocator): void
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param ServerRequestInterface $request
     * @param callable|null          $next
     *
     * @return mixed
     */
    abstract public function __invoke(ServerRequestInterface $request, ?callable $next = null);
}
