<?php
/*
	Plugin Name: tagDiv Composer
	Plugin URI: http://tagdiv.com
	Description: tagDiv Composer
	Author: tagDiv
	Version: 1.0
	Author URI: http://tagdiv.com
*/


require_once 'td_deploy_mode.php';


add_action('td_wp_booster_loaded', 'tdc_plugin_init',  10001);
function tdc_plugin_init() {

	// load the plugin config
	require_once('includes/tdc_config.php');

	// load the plugin
	require_once "includes/tdc_main.php";

	// register 'css-live' extension
	require_once "css-live/css-live.php";
}
