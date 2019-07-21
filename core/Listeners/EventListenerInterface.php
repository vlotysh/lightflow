<?php


namespace Core\Listeners;

/**
 * Interface EventListenerInterface
 *
 * @package Core\Event
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
