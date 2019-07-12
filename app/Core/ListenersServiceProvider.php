<?php


namespace App\Core;


use App\{Core\Event\EventDispatcher,
    Core\Interfaces\DependencyInjectionInterface,
    Core\Interfaces\ServiceProviderInterface,
    Core\Services\TemplateService,
    Helpers\NameHelper,
    Listeners\NotFoundListener};

use Zend\Diactoros\ServerRequestFactory;

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
