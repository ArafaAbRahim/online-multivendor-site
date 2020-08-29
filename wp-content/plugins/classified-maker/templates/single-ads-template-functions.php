<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_title', 10 );
add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_meta', 10 );

add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_sidebar', 20 );

add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_details', 20 );
//add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_images', 20 );
//add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_meta_cat', 20 );	
//add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_content', 20 );	



//add_action( 'classified_maker_action_single_ads_main', 'classified_maker_template_single_ads_css', 20 );





if ( ! function_exists( 'classified_maker_template_single_ads_title' ) ) {

	
	function classified_maker_template_single_ads_title() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-title.php');
	}
}

if ( ! function_exists( 'classified_maker_template_single_ads_meta' ) ) {

	
	function classified_maker_template_single_ads_meta() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-meta.php');
	}
}


if ( ! function_exists( 'classified_maker_template_single_ads_sidebar' ) ) {

	
	function classified_maker_template_single_ads_sidebar() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-sidebar.php');
	}
}


if ( ! function_exists( 'classified_maker_template_single_ads_details' ) ) {

	
	function classified_maker_template_single_ads_details() {
		
		echo '<div class="ads-details">';
		require_once( classified_maker_plugin_dir. 'templates/single-ads-images.php');
		require_once( classified_maker_plugin_dir. 'templates/single-ads-meta-cat.php');
		require_once( classified_maker_plugin_dir. 'templates/single-ads-content.php');
		
		echo '</div>';
	}
}



if ( ! function_exists( 'classified_maker_template_single_ads_content' ) ) {

	
	function classified_maker_template_single_ads_content() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-content.php');
	}
}

if ( ! function_exists( 'classified_maker_template_single_ads_images' ) ) {

	
	function classified_maker_template_single_ads_images() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-images.php');
	}
}

if ( ! function_exists( 'classified_maker_template_single_ads_meta_cat' ) ) {

	
	function classified_maker_template_single_ads_meta_cat() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-meta-cat.php');
	}
}











if ( ! function_exists( 'classified_maker_template_single_ads_css' ) ) {

	
	function classified_maker_template_single_ads_css() {
				
		require_once( classified_maker_plugin_dir. 'templates/single-ads-css.php');
	}
}








