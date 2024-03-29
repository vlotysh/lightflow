<?php


namespace Core;

use App\Helpers\NameHelper;

use Core\{
    Event\EventDispatcher,
    Interfaces\ServiceProviderInterface,
    Services\TemplateService
};

use Zend\Diactoros\ServerRequestFactory;

/**
 * Class DependencyInjection
 *
 * @package App\Core
 */
class CoreServiceProvider implements ServiceProviderInterface
{
    /**
     * @param ServiceLocator $serviceLocator
     */
    public function bind(ServiceLocator $serviceLocator)
    {
        $serviceLocator->set('name.helper', function () {
            return new NameHelper();
        });

        $serviceLocator->set('request', function () {
            return ServerRequestFactory::fromGlobals(
                $_SERVER,
                $_GET,
                $_POST,
                $_COOKIE,
                $_FILES
            );
        });

        $serviceLocator->set('event.dispatcher', function () {
            return new EventDispatcher();
        });

        $serviceLocator->set('template.service', function () {
            return new TemplateService();
        });
    }
}
