<?php


namespace App\Controllers;

use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class IndexController
 *
 * @package App\Controllers
 */
class IndexController extends AbstractController
{
    /**
     * @return HtmlResponse
     */
    public function index()
    {
        return $this->render('index/default.html.twig');
    }
}
