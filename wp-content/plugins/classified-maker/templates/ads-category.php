<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

		get_header();

		//do_action('classified_maker_action_before_single_ads');

		$term = get_queried_object();
		//var_dump($term);
		$term_slug = $term->slug;
		echo do_shortcode('[classified_maker_archive category='.$term_slug.']');
       // do_action('classified_maker_action_after_single_ads');

		get_footer();
		
