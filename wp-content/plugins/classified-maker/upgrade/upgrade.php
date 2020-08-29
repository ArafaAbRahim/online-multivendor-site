<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

function classified_maker_versions_save(){
		
		$classified_maker_versions_saved = get_option('classified_maker_versions');
		if(empty($classified_maker_versions_saved)){
			$classified_maker_versions_saved = array();
			}
		
		$plugin_data = get_plugin_data( classified_maker_plugin_dir.'classified-maker.php' );
		$classified_maker_versions[$plugin_data['Version']] = $plugin_data['Version'];
		
		$classified_maker_versions = array_merge($classified_maker_versions_saved, $classified_maker_versions);
		
		
		update_option('classified_maker_versions', $classified_maker_versions);
	
	
	}
	
	
//add_action('classified_maker_action_deactivation', 'classified_maker_versions_save');
//add_action('classified_maker_action_uninstall', 'classified_maker_versions_save');	
	
	
	
add_action('classified_maker_action_install', 'classified_maker_upgrade_1_0_4');			
function classified_maker_upgrade_1_0_4(){
	
	$classified_maker_versions_saved = get_option('classified_maker_versions');
	$classified_maker_upgrade = get_option('classified_maker_upgrade');	
	
	$last_upgrade_version = $classified_maker_upgrade['last_upgrade_version'];
	$last_upgrade_status = $classified_maker_upgrade['last_upgrade_status'];	
	
	if($last_upgrade_version=='1.0.4' && $last_upgrade_status=='done'){
		
		 // 1.0.4 already upgrade
		}
	else{
		
			$wp_query = new WP_Query(
				array (
					'post_type' => 'ads',
					'post_status' => 'any',
					'orderby' => 'Date',				
					'order' => 'DESC',
					'posts_per_page' => -1,

					
					) );
	
	
			if ( $wp_query->have_posts() ) :		
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$classified_maker_ads_thumbs = get_post_meta(get_the_ID(), 'classified_maker_ads_thumbs', true);
			if(!empty($classified_maker_ads_thumbs)){
				
				$classified_maker_ads_thumbs = explode(',',$classified_maker_ads_thumbs);
				
				// Add featured image
				if(!empty($classified_maker_ads_thumbs[0]))
				update_post_meta( get_the_ID(), '_thumbnail_id', $classified_maker_ads_thumbs[0] );
				
				
				$classified_maker_ads_thumbs = serialize($classified_maker_ads_thumbs);
				
				update_post_meta( get_the_ID(), 'classified_maker_ads_thumbs', $classified_maker_ads_thumbs);
				
				}

			endwhile;
			wp_reset_query();
			endif;
	
			$classified_maker_upgrade = array('last_upgrade_version'=>'1.0.4','last_upgrade_status'=>'done' );
			update_option('classified_maker_upgrade', $classified_maker_upgrade);
		
		}

	

	
	
	
	}	
	
	
	
	
	
	
	