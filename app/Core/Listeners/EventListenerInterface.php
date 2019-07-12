<?php


namespace App\Core\Listeners;


/**
 * Interface EventListenerInterface
 *
 * @package App\Core\Event
 */
interface EventListenerInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function dispatch(array $data);
}
