<?php


namespace App\Core\Framework\Http\Router;


use Aura\Router\Map;

/**
 * Interface RouteProvider
 *
 * @package App\Core\Framework\Http\Router
 */
interface RouteProviderInterface
{
    /**
     * @param Map $mapper
     */
    public function bind(Map $mapper): void;
}
