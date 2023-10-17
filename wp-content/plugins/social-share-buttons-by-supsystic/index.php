<?php

/**
 * Plugin Name: Social Share Buttons by Supsystic
 * Plugin URI: http://supsystic.com
 * Description: Social share buttons to increase social traffic and popularity. Social sharing to Facebook, Twitter and other social networks
 * Version: 2.2.9
 * Author: supsystic.com
 * Author URI: http://supsystic.com
 **/

 //Fix RSC Class rename for PRO plugin
 function sssChangeProVersionNotice(){
	 global $pagenow;
	 if ( $pagenow == 'admin.php' || $pagenow == 'plugins.php' ) {
		 echo '<div class="notice notice-warning is-dismissible"><p><b>WARNING!</b> You using <b>OLD Social Share Buttons by Supsystic PRO</b> version! For continued use and before activating the PRO plugin - please <b>UPDATE PRO VERSION</b>. Thank you. <br><b>You can download new compatible PRO version direct from this <a href="https://supsystic.com/pro/social-share-pro.zip">LINK</a></b>.</p></div>';
	 }
 }
 require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 $proPluginPath = dirname(__FILE__);
 $proPluginPath = str_replace('social-share-buttons-by-supsystic', 'social-share-pro', $proPluginPath);
 $proPluginPath = $proPluginPath . '/index.php';
 if (file_exists($proPluginPath)) {
	$pluginData = get_file_data($proPluginPath, array('Version' => 'Version'), false);
	if (!empty($pluginData['Version']) && version_compare($pluginData['Version'], '1.2.3', '<')) {
		add_action('admin_notices', 'sssChangeProVersionNotice');
		deactivate_plugins('social-share-pro/index.php');
	}
 }

include dirname(__FILE__) . '/app/SupsysticSocialSharing.php';

if (!defined('SSS_PLUGIN_URL')) {
	define('SSS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
if (!defined('SSS_PLUGIN_ADMIN_URL')) {
	define('SSS_PLUGIN_ADMIN_URL', admin_url());
}

$supsysticSocialSharing = new SupsysticSocialSharing();

$supsysticSocialSharing->run();
$supsysticSocialSharing->activate(__FILE__);
$supsysticSocialSharing->deactivate(__FILE__);
