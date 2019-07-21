<?php

namespace Core\Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Pipeline
 *
 * @package Core\Framework\Http\Pipeline
 */
class Pipeline
{
    /**
     * @var \SplQueue
     */
    private $queue;

    /**
     * Pipeline constructor.
     */
    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    /**
     * @param callable $middleware
     */
    public function pipe(callable $middleware)
    {
        $this->queue->enqueue($middleware);
    }

    /**
     * @param ServerRequestInterface $request
     * @param callable $default
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, callable $default): ResponseInterface
    {
        $delegate = new Next(clone $this->queue, $default);
        return $delegate($request);
    }
}
