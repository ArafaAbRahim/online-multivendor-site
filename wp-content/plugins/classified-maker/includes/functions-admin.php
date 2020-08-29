<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	
	
	
	
		
	function classified_maker_select_category($ads_id, $cat_id){
		
		
		
		}
	
	
	
	
	
	
	
		
	function classified_maker_ads_meta_html($ads_id, $cat_id){
		
		$html = '';
		$class_pickform = new class_pickform();
		$classified_maker_field_set = get_option( 'classified_maker_field_set' );
		$class_classified_maker_functions = new class_classified_maker_functions();
		$post_type_input_fields = $class_classified_maker_functions->post_type_input_fields();
		$cat_fields = $classified_maker_field_set[$cat_id];
		$meta_fields = $post_type_input_fields['meta_fields'];
		
		//echo '<pre>'.var_export($cat_fields, true).'</pre>';
		
		
		
		
		if(!empty($cat_id)){
			//var_dump($cat_id);
			$cat_fields = $classified_maker_field_set[$cat_id];
			//var_dump($cat_fields);
			if(empty($cat_fields)){
					
					
					foreach($meta_fields as $field_key=>$field){
						
						//$cat_fields[$field_key] = $field['meta_key'];
						$cat_fields[$field_key]['checked'] = 'yes';								
						}
				
				}
			
			
			//var_dump($cat_fields);
		
			foreach($cat_fields as $key=>$field){
				
					//var_dump($field);
				if(isset($field['checked']) && $field['checked'] == 'yes'){
					
					//var_dump($key);
					
					if(!empty($meta_fields[$key])){
						
						$meta_value = get_post_meta($ads_id, $key, true);
						
						if(is_serialized($meta_value)){
							
							$meta_value = unserialize($meta_value);
							
							}
						
						
						$args = $meta_fields[$key];
						$args = array_merge($args,array('input_values'=>$meta_value));						
						
						
						//var_dump($args);
						
						$html.= '<div class="item">';
						
						$html.= $class_pickform->field_set($args);
						
						$html.= '</div>';
						}

					}

				}
			
			
			}
			
		return $html;
			
			
			
			
		
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function classified_maker_admin_update_field_set() {
		
		
		$classified_maker_field_set_saved = get_option('classified_maker_field_set');

		
		
		$class_classified_maker_functions = new class_classified_maker_functions();
		//$meta_fields_data = $class_classified_maker_functions->meta_fields_data();
		
		$input_fields = $class_classified_maker_functions->post_type_input_fields();
		
		
		$meta_fields = $input_fields['meta_fields'];
		
		
		$taxonomy = 'ads_cat';

		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  //'parent'  => 0,
		  );
		
		$categories = get_categories($args);
		foreach($categories as $category){
			
			foreach($meta_fields as $field_id=>$field){
				
				$classified_maker_field_set[$category->cat_ID][$field_id]['checked'] = 'yes';
				$classified_maker_field_set[$category->cat_ID][$field_id]['display_ads_page'] = 'yes';
				$classified_maker_field_set[$category->cat_ID][$field_id]['id'] = $field_id;
				
				}
			
			}

		
		//echo '<pre>';
		//print_r($classified_maker_field_set_saved);
		//echo '</pre>';
		if(!empty($classified_maker_field_set_saved))
		foreach( $classified_maker_field_set_saved as $catID => $catSettings ) {

			$difference = array_diff_key($meta_fields,$catSettings);
			
				//echo '<pre>';
				//print_r($difference);
				//echo '</pre>';
				
			if ( sizeof($difference) > 0 ) {
				
				//$field_id = $difference['meta_key'];
				
				
				
				//$difference[$catID][$field_id]['checked'] = 'yes';
				//$difference[$catID][$field_id]['display_ads_page'] = 'yes';
				//$difference[$catID][$field_id]['id'] = $field_id;
				
				$classified_maker_field_set_saved[$catID] =	 array_merge( $classified_maker_field_set_saved[$catID], $difference );
			}
				
			
		}
		

		update_option('classified_maker_field_set', $classified_maker_field_set_saved);
		
		//die();
		
		}

	add_action('wp_ajax_classified_maker_admin_update_field_set', 'classified_maker_admin_update_field_set');
	add_action('wp_ajax_nopriv_classified_maker_admin_update_field_set', 'classified_maker_admin_update_field_set');





	function classified_maker_admin_reset_field_set() {
		
		
		$class_classified_maker_functions = new class_classified_maker_functions();
		//$meta_fields_data = $class_classified_maker_functions->meta_fields_data();
		
		$input_fields = $class_classified_maker_functions->post_type_input_fields();
		
		$meta_fields = $input_fields['meta_fields'];
		
		
		$taxonomy = 'ads_cat';

		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  //'parent'  => 0,
		  );
		
		$categories = get_categories($args);
		
		foreach($categories as $category){
			
			foreach($meta_fields as $field_id=>$field){
				
				$classified_maker_field_set[$category->cat_ID][$field_id]['checked'] = 'yes';
				$classified_maker_field_set[$category->cat_ID][$field_id]['display_ads_page'] = 'yes';
				$classified_maker_field_set[$category->cat_ID][$field_id]['id'] = $field_id;
				
				}
			
			}

		
		
		
		update_option('classified_maker_field_set', $classified_maker_field_set);
		
		die();
		
		}

add_action('wp_ajax_classified_maker_admin_reset_field_set', 'classified_maker_admin_reset_field_set');
add_action('wp_ajax_nopriv_classified_maker_admin_reset_field_set', 'classified_maker_admin_reset_field_set');





