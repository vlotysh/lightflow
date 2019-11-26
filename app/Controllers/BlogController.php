<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class BlogController
 *
 * @package App\Controllers
 */
class BlogController extends AbstractController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function show(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        return $this->render('blog/show.html.twig', ['id' => $id]);
    }
}
