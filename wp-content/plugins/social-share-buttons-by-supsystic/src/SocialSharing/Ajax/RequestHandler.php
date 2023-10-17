<?php


class SocialSharing_Ajax_RequestHandler implements SocialSharing_Ajax_RequestHandlerInterface
{
    /**
     * @var RscSss_Environment
     */
    private $environment;

    /**
     * @param RscSss_Environment $environment
     */
    public function __construct(RscSss_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Takes AJAX request and re-route it to requested module.
     * @param RscSss_Http_Request $request
     * @return mixed
     */
    public function handleRequest(RscSss_Http_Request $request)
    {
        $request->server->set('X_REQUESTED_WITH', 'XMLHttpRequest');

        /** @var RscSss_Mvc_Module $module */
        if (!$request->post->has('route')) {
            return false;
        }

        $route = $request->post->get('route');
        $module = (isset($route['module']) ? $route['module'] : $this->environment->getConfig()->get('default_module'));
        $action = (isset($route['action']) ? $route['action'] : 'index');

        if (null !== $module = $this->environment->getModule(strtolower($module))) {
            $controller = $module->getController();

            if ($controller !== null && method_exists($controller, $action = sprintf('%sAction', $action))) {
                return call_user_func_array(array($controller, $action), array($request));
            }
        }

        return false;
    }
}