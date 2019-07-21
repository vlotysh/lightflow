<?php

namespace Core\Interfaces;

use Core\ServiceLocator;

/**
 * Interface ServiceProviderInterface
 *
 * @package Core\Interfaces
 */
interface ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
     */
    public function bind(ServiceLocator $serviceLocator);
}
