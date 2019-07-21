<?php

namespace App\Listeners;

use Core\Listeners\EventListenerInterface;
use Core\Framework\Http\ResponseSender;

use Core\Services\TemplateService;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class NotFoundListener
 *
 * @package App\Listeners
 */
class NotFoundListener implements EventListenerInterface
{
    const NOT_FOUND_TEMPLATE = '404.html.twig';

    /**
     * @var TemplateService
     */
    private $renderService;

    /**
     * NotFoundListener constructor.
     *
     * @param TemplateService $renderService
     */
    public function __construct(TemplateService $renderService)
    {
        $this->renderService = $renderService;
    }

    /**
     * @param array $data
     *
     * @return mixed|void
     */
    public function dispatch(array $data)
    {
        $response = $this->renderService->render(self::NOT_FOUND_TEMPLATE);

        return (new ResponseSender())->send(new HtmlResponse($response, 404));
    }
}
