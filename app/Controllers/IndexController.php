<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class IndexController
 *
 * @package App\Controllers
 */
class IndexController extends AbstractController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render('index/default.html.twig');
    }
}
