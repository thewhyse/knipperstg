<?php

/**
 * Describes a logger-aware instance
 */
interface RscSss_Logger_AwareInterface
{
    /**
     * Sets a logger instance on the object
     *
     * @param RscSss_Logger_Interface $logger
     * @return null
     */
    public function setLogger(RscSss_Logger_Interface $logger);
}