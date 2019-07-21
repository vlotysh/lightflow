<?php

namespace App\ServiceProviders;

use App\Helpers\NameHelper;

use Core\{
    Interfaces\ServiceProviderInterface,
    ServiceLocator
};

/**
 * Class CustomServiceProvider
 *
 * @package App\ServiceProviders
 */
class CustomServiceProvider implements ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
     */
    public function bind(ServiceLocator $serviceLocator)
    {
        $serviceLocator->set('name.helper', function () {
            return new NameHelper();
        });
    }
}
