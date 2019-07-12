<?php

namespace App\Core\Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Next
 *
 * @package App\Core\Framework\Http\Pipeline
 */
class Next
{
    /**
     * @var callable
     */
    private $default;

    /**
     * @var \SplQueue
     */
    private $queue;

    /**
     * Next constructor.
     * @param \SplQueue $queue
     * @param callable  $default
     */
    public function __construct(\SplQueue $queue, callable $default)
    {
        $this->default = $default;
        $this->queue = $queue;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        if($this->queue->isEmpty()) {
            $default = $this->default;
            return $default($request);
        };

        $current = $this->queue->dequeue();
        $default = $this->default;

        return $current($request, function (ServerRequestInterface $request) use ($default) {
            return $this($request, $default);
        });
    }
}
