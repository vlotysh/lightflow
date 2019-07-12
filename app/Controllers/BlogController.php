<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class BlogController
 *
 * @package App\Controllers
 */
class BlogController extends AbstractController
{
    /**
     * @param ServerRequestInterface $request
     * @return HtmlResponse
     */
    public function index(ServerRequestInterface $request)
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return HtmlResponse
     */
    public function show(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');

        return $this->render('blog/show.html.twig', ['id' => $id]);
    }
}
