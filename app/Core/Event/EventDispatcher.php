<?php


namespace App\Core\Event;


use App\Core\Listeners\EventListenerInterface;

/**
 * Class EventListener
 *
 * @package App\Core
 */
class EventDispatcher
{
    /**
     * @var array
     */
    private $listeners = array();

    /**
     * @param string $event
     * @param array  $args
     */
    public function publish(string $event, $args = array())
    {
        if(isset($this->listeners[$event]))
        {

            foreach($this->listeners[$event] as $listener)
            {

                call_user_func([$listener, 'dispatch'], $args);
            }
        }
    }

    /**
     * @param $event
     *
     * @param EventListenerInterface $eventListener
     */
    public function attach(string $event, EventListenerInterface $eventListener)
    {
        $this->listeners[$event][] = $eventListener;
    }
}
