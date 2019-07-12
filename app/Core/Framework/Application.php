<?php

namespace App\Core\Framework;

use App\Core\Framework\Http\Pipeline\Pipeline;
use App\Core\Framework\Http\Pipeline\MiddlewareResolver;

/**
 * Class Application
 *
 * @package App\Core\Framework
 */
class Application extends Pipeline
{
    /**
     * @var MiddlewareResolver
     */
    private $resolver;

    /**
     * Application constructor.
     * @param MiddlewareResolver $resolver
     */
    public function __construct(MiddlewareResolver $resolver)
    {
        parent::__construct();
        $this->resolver = $resolver;
    }

    /**
     * @param callable $middleware
     */
    public function pipe(callable $middleware)
    {
        parent::pipe($this->resolver->resolve($middleware));
    }
}
