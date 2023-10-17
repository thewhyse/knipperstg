<?php


class RscSss_Environment_Aware implements RscSss_Environment_AwareInterface
{

    /**
     * @var RscSss_Environment
     */
    protected $environment;

    /**
     * Sets the environment.
     *
     * @param RscSss_Environment $environment
     */
    public function setEnvironment(RscSss_Environment $environment)
    {
        $this->environment = $environment;
    }
}