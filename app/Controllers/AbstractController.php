<?php

namespace App\Controllers;

use Core\ServiceLocator;
use Psr\Http\Message\ResponseInterface;
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
     * @return ResponseInterface|HtmlResponse
     * @throws \Exception
     */
    public function render(string $path, array $data = []): ResponseInterface
    {
        return new HtmlResponse($this->serviceLocator->get('template.service')->render($path, $data));
    }
}
