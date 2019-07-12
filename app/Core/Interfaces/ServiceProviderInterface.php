<?php

namespace App\Core\Interfaces;

use App\Core\ServiceLocator;

/**
 * Interface ServiceProviderInterface
 *
 * @package App\Core\Interfaces
 */
interface ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
     */
    public function bind(ServiceLocator $serviceLocator);
}
