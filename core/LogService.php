<?php

namespace Core;

/**
 * Class LogService
 * @package App\Core
 */
class LogService
{
    /**
     * @var string
     */
    private $logName;

    /**
     * LogService constructor.
     *
     * @param string $logName
     */
    public function __construct($logName = 'default')
    {
        $this->logName = $logName;
    }

    /**
     * @return string
     */
    public function getLogName()
    {
        return $this->logName;
    }
}
