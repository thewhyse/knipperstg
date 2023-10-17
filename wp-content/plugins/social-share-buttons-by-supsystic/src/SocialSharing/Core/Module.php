<?php

/**
 * Class SocialSharing_Core_Module
 */
class SocialSharing_Core_Module extends SocialSharing_Core_BaseModule
{
    /**
     * {@inheritdoc}
     */
    public function onInit()
    {
        parent::onInit();

        $dispatcher = $this->getEnvironment()->getDispatcher();
        $dispatcher->on('after_ui_loaded', array($this, 'loadScripts'), -5);
        $dispatcher->on('after_modules_loaded', array($this, 'disablePromo'), -5);

        // Improve admin_notices action
        add_action('admin_notices', array($this, 'doPluginNotices'));

        $this->registerTwigFunctions();
    }

    /**
     * Loads plugin core js.
     * @param SocialSharing_Ui_Module $ui
     */
    public function loadScripts(SocialSharing_Ui_Module $ui)
    {
        $core = new SocialSharing_Ui_Script();
        $core->setHandle('social-sharing-core-js')
            ->setModuleSource($this, 'js/core.js')
            ->setHookName('admin_enqueue_scripts');

        $ui->addAsset($core);
    }

    /**
     * Disable build-in promo module.
     */
    public function disablePromo()
    {
        $pluginName = $this->getEnvironment()->getPluginName();
		if(!get_option($pluginName.'_promo_shown')) {
			update_option($pluginName.'_promo_shown', 1);
		}
    }

    public function doPluginNotices()
    {
        if (!$this->getEnvironment()->isPluginPage()) {
            return;
        }

        $dispatcher = $this->getEnvironment()->getDispatcher();
        $dispatcher->dispatch('notices');
    }

    public function getPluginDirectoryUrl($path)
    {
        return plugin_dir_url($this->getEnvironment()->getPluginPath() . '/index.php') . '/' . $path;
    }

    private function registerTwigFunctions()
    {
        $twig = $this->getEnvironment()->getTwig();
        $twig->addFunction(
            new Twig_SupTwgSss_SimpleFunction(
                'plugin_directory_url',
                array($this, 'getPluginDirectoryUrl')
            )
        );
        $twig->addFunction(
            new Twig_SupTwgSss_SimpleFunction(
                'get_posts',
                'get_posts'
            )
        );
        $twig->addFunction(
            new Twig_SupTwgSss_SimpleFunction(
                'ucfirst',
                'ucfirst'
            )
        );
        $twig->addFunction(
            new Twig_SupTwgSss_SimpleFunction(
                'wp_get_attachment_image_url',
                'wp_get_attachment_image_url'
            )
        );
        $twig->addFunction(
            new Twig_SupTwgSss_SimpleFunction(
                'translate', array($this, 'translate')
            )
        );
        $twig->addFunction(
            new Twig_SupTwgSss_SimpleFunction(
                'getProUrl', array($this, 'getProUrl')
            )
        );
        $config = $this->getEnvironment()->getConfig();
        $twig->addGlobal('SSS_PLUGIN_URL', SSS_PLUGIN_URL);
        $twig->addGlobal('SSS_PLUGIN_VERSION', $config->get('plugin_version'));
        $twig->addGlobal('SSS_PLUGIN_NAME', $config->get('plugin_name'));
        global $current_user;
        $twig->addGlobal('SSS_USER_NAME', $current_user->user_firstname.' '.$current_user->user_lastname);
        $twig->addGlobal('SSS_USER_EMAIL', $current_user->user_email);
        $twig->addGlobal('SSS_WEBSITE', get_bloginfo('url'));
        $show = true;
        $acRemind = get_option('sss_ac_remind', false);
        if (!empty($acRemind)) {
          $currentDate = date('Y-m-d h:i:s');
          if ($currentDate > $acRemind) {
            $show = true;
          } else {
            $show = false;
          }
        }
        $acSubscribe = get_option('sss_ac_subscribe', false);
        if (!empty($acSubscribe)) {
          $show = false;
        }
        $acDisabled = get_option('sss_ac_disabled', false);
        if (!empty($acDisabled)) {
          $show = false;
        }
        $twig->addGlobal('SSS_AC_SHOW', $show);
    }
}
