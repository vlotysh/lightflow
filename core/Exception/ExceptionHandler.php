<?php

namespace Core\Exception;

use \Throwable;

/**
 * Class ExceptionHandler
 */
class ExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @param Throwable $e
     */
    public function handle(Throwable $e)
    {
        dd($e);
        exit();
    }
}
