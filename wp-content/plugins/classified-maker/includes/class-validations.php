<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_validations{
	
	public function __construct(){


	

		}
		
		
		
	public function validation($cat_id, $_post){
		
		$classified_maker_field_set = get_option( 'classified_maker_field_set' );
		$cat_fields = $classified_maker_field_set[$cat_id];
		
		if(!empty($cat_fields))
		foreach($cat_fields as $key=>$field){
				
			if($field['checked'] == 'yes'){
				
				//$meta_value = sanitize_text_field($_post[$key]);				
				$meta_value = $_post[$key];
				if(empty($meta_value)){
				
					$validation_error[$key]= 'is_empty';

					}

				//update_post_meta($ads_ID, $key , $meta_value);
				
				}

			}
		
		
		unset($validation_error['classified_maker_ads_recaptcha']);
		
		
		return $validation_error;
		
		}	
		

	
		
		
		
		
		

	}
	
new class_classified_validations();