<?php

namespace Core;

use \Closure;
use \Exception;

/**
 * Class ServiceLocator
 *
 * @package App\Core
 */
class ServiceLocator
{
    /**
     * @var array
     */
    private $services = [];

    /**
     * @var array
     */
    private $instantiated = [];

    /**
     * @param string $alias
     * @param Closure $callback
     */
    public function set(string $alias, Closure $callback)
    {
        $this->services[$alias] = $callback;
    }

    /**
     * @param string $alias
     *
     * @return bool
     */
    public function has(string $alias): bool
    {
        return isset($this->services[$alias]) || isset($this->instantiated[$alias]);
    }

    /**
     * @param string $alias
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function get(string $alias)
    {
        if (isset($this->instantiated[$alias])) {
            return $this->instantiated[$alias];
        }

        if (! $this->has($alias)) {
            throw new Exception("Service with alias {$alias} doesn't exist");
        }

        $instance = $this->getInstance($alias);
        $this->instantiated[$alias] = $instance;

        return $instance;
    }

    /**
     * @param string $alias
     *
     * @return mixed
     */
    private function getInstance(string $alias)
    {
        $callback = $this->services[$alias];

        return $callback($this);
    }
}
