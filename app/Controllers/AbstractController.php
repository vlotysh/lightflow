<?php


namespace App\Controllers;

use App\Core\ServiceLocator;

use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class AbstractController
 *
 * @package App\Controllers
 */
class AbstractController
{
    /**
     * @var ServiceLocator
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function setServiceLocator(ServiceLocator $serviceLocator): void
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param string $path
     * @param array $data
     *
     * @return HtmlResponse
     */
    public function render(string $path, array $data = [])
    {
        return new HtmlResponse($this->serviceLocator->get('template.service')->render($path,$data));
    }
}
