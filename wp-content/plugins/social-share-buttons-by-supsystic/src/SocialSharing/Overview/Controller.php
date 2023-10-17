<?php


class SocialSharing_Overview_Controller extends SocialSharing_Core_BaseController
{
    public function indexAction(RscSss_Http_Request $request)
    {
        $serverSettings = $this->getServerSettings();
        $config = $this->getEnvironment()->getConfig();

        $user = wp_get_current_user();
        $user->url = get_site_url();

        return $this->response(
            '@overview/index.twig',
            array(
                'serverSettings' => $serverSettings,
                'news' => $this->loadNews($config['post_url']),
                'user' => $user
            )
        );
    }

    public function sendMailAction(RscSss_Http_Request $request) {
      if (!$this->_checkNonce($request)) die();
        $mail = $request->post->get('mail');
        $headers = 'From: ' . $mail['name'] . ' ' . $mail['email'] . "\r\n" . 'Website: ' . $mail['website'] . "\r\n" . 'Question: ' . $mail['question'] . "\r\n";
        $config = $this->getEnvironment()->getConfig();

        wp_mail($config['mail'], $mail['subject'], $headers, $mail['message']);

        return $this->redirect($this->generateUrl('overview', 'index'));
    }
    /**
     * @param RscSss_Http_Request $request
     */
    public function sendSubscribeMailAction(RscSss_Http_Request $request)
    {
        $apiUrl = 'https://supsystic.com/wp-admin/admin-ajax.php';
        $reqUrl = $apiUrl . '?action=ac_get_plugin_installed';
        $config = $this->getEnvironment()->getConfig();
        $mail = $request->post['route']['data'];
        $isPro = !empty($config->get('is_pro')) ? true : false;
        $data = array(
            'body' => array(
                'key' => 'kJ#f3(FjkF9fasd124t5t589u9d4389r3r3R#2asdas3(#R03r#(r#t-4t5t589u9d4389r3r3R#$%lfdj',
                'user_name' => $mail['username'],
                'user_email' => $mail['email'],
                'site_url' => get_bloginfo('wpurl'),
                'site_name' => get_bloginfo('name'),
                'plugin_code' => $config->get('plugin_name'),
                'is_pro' => $isPro,
            ),
        );

        $response = wp_remote_post(
            $reqUrl,
            $data
        );
        if (is_wp_error($response)) {
            $response = array(
                'success' => false,
                'message' => $this->translate('Some errors.')
            );
        } else {
            $response = array(
                'success' => true,
                'message' => $this->translate('Thank you for subscribtions.')
            );
            update_option('sss_ac_subscribe', true);
        }
        return $this->response(RscSss_Http_Response::AJAX, $response);
    }

    /**
     * @param RscSss_Http_Request $request
     */
    public function sendSubscribeRemindAction(RscSss_Http_Request $request)
    {
        update_option('sss_ac_remind', date("Y-m-d h:i:s", time() + 86400));
        $response = array ('success' => true);
        return $this->response(RscSss_Http_Response::AJAX, $response);
    }

    /**
     * @param RscSss_Http_Request $request
     */
    public function sendSubscribeDisableAction(RscSss_Http_Request $request)
    {
        update_option('sss_ac_disabled', true);
        $response = array ('success' => true);
        return $this->response(RscSss_Http_Response::AJAX, $response);
    }

    protected function getServerSettings() {
    	global $wpdb;
        return array(
            'Operating System' => array('value' => PHP_OS),
            'PHP Version' => array('value' => PHP_VERSION),
            'Server Software' => array('value' => sanitize_text_field($_SERVER['SERVER_SOFTWARE'])),
            'MySQL' => array('value' => $wpdb->db_version()),
            'PHP Allow URL Fopen' => array('value' => ini_get('allow_url_fopen') ? 'Yes' : 'No'),
            'PHP Memory Limit' => array('value' => ini_get('memory_limit')),
            'PHP Max Post Size' => array('value' => ini_get('post_max_size')),
            'PHP Max Upload Filesize' => array('value' => ini_get('upload_max_filesize')),
            'PHP Max Script Execute Time' => array('value' => ini_get('max_execution_time')),
            'PHP EXIF Support' => array('value' => extension_loaded('exif') ? 'Yes' : 'No'),
            'PHP EXIF Version' => array('value' => phpversion('exif')),
            'PHP XML Support' => array('value' => extension_loaded('libxml') ? 'Yes' : 'No', 'error' => !extension_loaded('libxml')),
            'PHP CURL Support' => array('value' => extension_loaded('curl') ? 'Yes' : 'No', 'error' => !extension_loaded('curl')),
        );
    }

    protected function loadNews ($url) {
        $news = wp_remote_retrieve_body(wp_remote_get($url));

        return $news;
    }
}
