<?php

// We don't want to allow direct access to this
defined( 'ABSPATH' ) OR die( 'No direct script access allowed' );

/*
Plugin Name: Security Header Generator
Description: Generates proper security headers for the front-end & admin of your site.  Includes WP CLI processing for generating a Content Security Policy.
Plugin URI: https://kevinpirnie.com/blog/2021/10/13/wordpress-plugin-security-header-generator/
Author: Kevin C. Pirnie
Author URI: https://kevinpirnie.com/
Requires at least: 5.6.10
Requires PHP: 7.4
Version: 4.0.01
Network: false
Text Domain: security-header-generator
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Update URI: https://wordpress.org/plugins/security-header-generator/
*/

// setup the full page to this plugin
define( 'WPSH_PATH', dirname( __FILE__ ) );

// setup the directory name
define( 'WPSH_DIRNAME', basename( dirname( __FILE__ ) ) );

// setup the primary plugin file name
define( 'WPSH_FILENAME', basename( __FILE__ ) );

// Require our primary
require( dirname( __FILE__ ) . '/work/common.php' );
