<?php

namespace Core\Framework\Http\Router;

class Result
{
    private $name;
    private $handler;
    private $path;
    private $method;

    public function __construct(string $name, string $path, $handler, string $method = 'GET')
    {
        $this->name = $name;
        $this->path = $path;
        $this->handler = $handler;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
