<?php

namespace App\Core\Exception;

use \Throwable;

/**
 * Interface ExceptionHandlerInterface
 */
interface ExceptionHandlerInterface
{
    public function handle(Throwable $e);
}
