<?php


namespace Core;

use App\Listeners\NotFoundListener;

use Core\{
    Interfaces\DependencyInjectionInterface,
    Interfaces\ServiceProviderInterface
};

/**
 * Class DependencyInjection
 *
 * @package App\Core
 */
class ListenersServiceProvider implements ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
     *
     * @return ServiceLocator
     */
    public function bind(ServiceLocator $serviceLocator)
    {
        $serviceLocator->set('not-found.listener', function (ServiceLocator $serviceLocator) {
            $templateService = $serviceLocator->get('template.service');

            return new NotFoundListener($templateService);
        });
    }
}
