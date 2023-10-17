<?php

/**
 * Class SocialSharing_Core_BaseController
 */
class SocialSharing_Core_BaseController extends RscSss_Mvc_Controller
{
    /**
     * @var SocialSharing_Core_ModelsFactory
     */
    protected $modelsFactory;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        RscSss_Environment $environment,
        RscSss_Http_Request $request
    ) {
        parent::__construct(
            $environment,
            $request
        );

        $this->modelsFactory = new SocialSharing_Core_ModelsFactory(
            $environment
        );
    }

    /**
     * Creates new response
     * @param string $template The name of the template
     * @param array $data An associative array of the data
     * @param string $filter Filter name
     * @return RscSss_Http_Response
     */
    public function response($template, array $data = array(), $filter = null)
    {
        $request = $this->getRequest();
        $dispatcher = $this->getEnvironment()->getDispatcher();

        if (null === $filter) {
            $filter = '@';

            if ($request->post->has('route')) {
                $route = $request->post->get('route');
                $filter.= $route['module'] . '/';

                if (!array_key_exists('action', $route)) {
                    $route['action'] = 'index';
                }

                $filter.= $route['action'];
            } else {
                $filter.= $request->query->get(
                    'module',
                    $this->getEnvironment()->getConfig()->get('default_module')
                ) . '/';

                $filter.= $request->query->get('action', 'index');
            }
        }

        $data = $dispatcher->apply($filter, array($data));

        if ($template !== RscSss_Http_Response::AJAX) {
            try {
                $twig = $this->getEnvironment()->getTwig();
                $content = $twig->render($template, $data);
            } catch (Exception $e) {
                wp_die (esc_html($e->getMessage()));
            }
        } else {
            wp_send_json($data);
        }

        return RscSss_Http_Response::create()->setContent($content);
    }

    /**
     * @return SocialSharing_Core_ModelsFactory
     */
    public function getModelsFactory()
    {
        return $this->modelsFactory;
    }

    public function translate($string)
    {
        return $this->getEnvironment()->translate($string);
    }

    /**
     * @param string $message
     * @return ErrorException
     */
    public function error($message = null)
    {
        if (!$message) {
            $message = $this->translate('An error has occurred');
        }

        return new ErrorException($message);
    }

    public function ajaxSuccess(array $data = array())
    {
        return $this->response(
            RscSss_Http_Response::AJAX,
            array_merge(array('success' => true), $data)
        );
    }

    public function ajaxError($message, array $data = array())
    {
        return $this->response(
            RscSss_Http_Response::AJAX,
            array_merge(array('success' => false, 'message' => $message), $data)
        );
    }

    public function _checkNonce($request){
        $nonce = '';
        if (!empty($requestRoute = $request->post->get('route'))) {
           if (!empty($requestRoute['nonce'])) {
              $nonce = $requestRoute['nonce'];
           }
        }
        if (!empty($request->post->get('nonce'))) {
           $nonce = $request->post->get('nonce');
        }
        if (!empty($request->query->get('nonce'))) {
           $nonce = $request->query->get('nonce');
        }
        if ( !empty($nonce) && wp_verify_nonce($nonce, 'sss_nonce') && is_admin() && current_user_can('administrator') ) {
           return true;
        }
        return false;
     }

     public function _checkNonceFrontend($request){
       $nonce = '';
       if (!empty($requestRoute = $request->post->get('route'))) {
          if (!empty($requestRoute['nonce'])) {
             $nonce = $requestRoute['nonce'];
          }
       }
       if (!empty($request->post->get('nonce'))) {
          $nonce = $request->post->get('nonce');
       }
       if (!empty($request->query->get('nonce'))) {
          $nonce = $request->query->get('nonce');
       }
       if ( !empty($nonce) && wp_verify_nonce( $nonce, 'sss_nonce_frontend') ) {
          return true;
       }
       return false;
    }
}
