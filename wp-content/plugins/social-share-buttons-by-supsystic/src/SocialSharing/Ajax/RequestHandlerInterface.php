<?php


interface SocialSharing_Ajax_RequestHandlerInterface
{
    /**
     * Takes AJAX request and re-route it to requested module.
     * @param RscSss_Http_Request $request
     * @return mixed
     */
    public function handleRequest(RscSss_Http_Request $request);
}