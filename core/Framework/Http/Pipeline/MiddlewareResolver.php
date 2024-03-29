<?php

namespace Core\Framework\Http\Pipeline;

use Psr\Http\Message\ServerRequestInterface;

use \Closure;

/**
 * Class MiddlewareResolver
 *
 * @package Core\Framework\Http\Pipeline
 */
class MiddlewareResolver
{
    /**
     * @param $handler
     *
     * @return Pipeline|\Closure
     */
    public function resolve($handler)
    {
        if ($handler instanceof Closure) {
            return $handler;
        } elseif (is_string($handler) && strpos($handler, '@')) {
            list($class, $action) = explode('@', $handler);

            return function ($request) use ($class, $action) {
                return (new $class())->$action($request);
            };
        } elseif (is_string($handler)) {
            return function (ServerRequestInterface $request, callable $next) use ($handler) {
                $object = new $handler();
                return $object($request, $next);
            };
        } elseif (is_array($handler)) {
            return $this->createPipe($handler);
        } else {
            throw new \RuntimeException("Cannot resolve handler");
        }
    }

    /**git 
     * @param array $handlers
     *
     * @return Pipeline
     */
    private function createPipe(array $handlers): Pipeline
    {
        $pipeline = new Pipeline();

        foreach ($handlers as $handler) {
            $pipeline->pipe($this->resolve($handler));
        }

        return $pipeline;
    }
}
