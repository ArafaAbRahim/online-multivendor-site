<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_shortcodes_edit_ads{
	
    public function __construct(){
		

		add_shortcode( 'classified_maker_edit_ads', array( $this, 'edit_ads' ) );		

			
			

   		}
		


	public function edit_ads($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'themes' => 'flat',
											
					), $atts);
	
			if(isset($_GET['ads_id'])){
				$ads_ID = (int)$_GET['ads_id'];
				}





			$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
			$account_page_url = get_permalink($classified_maker_account_page_id);
	
			$classified_maker_submitted_ads_status = get_option('classified_maker_submitted_ads_status');
			$classified_maker_allow_edit_published_ads = get_option('classified_maker_allow_edit_published_ads');			
			

			$html = '';
			
			$html.= '<div class="post-ads">';
			
			
			//$classified_maker_themes = $atts['themes'];
			
			
			if ( is_user_logged_in() ) {
				
				$userid = get_current_user_id();
			
				$post_data = get_post($ads_ID, ARRAY_A);
	
				$author_id = $post_data['post_author'];		
			
				if( $userid == $author_id && $classified_maker_allow_edit_published_ads=='yes' ) {
						

			
				$class_classified_maker_functions = new class_classified_maker_functions();
				$meta_fields_data = $class_classified_maker_functions->meta_fields_data();
				
				$meta_fields = $meta_fields_data[0]['meta_fields'];
				
				$class_classified_maker_form = new class_classified_maker_form();
							
				$classified_maker_field_set = get_option( 'classified_maker_field_set' );
				
				//var_dump($classified_maker_field_set);
				
				
				
				$classified_maker_submit_ads_page_id = get_option('classified_maker_submit_ads_page_id');
				$post_ads_page_url = get_permalink($classified_maker_submit_ads_page_id);
				
	
					
				//var_dump($_POST);
				
				
				
				$html.= '<div class="post-status">';

				
				if(isset($_POST['post_ads_hidden'])){
					
					
					//var_dump($_POST);
	
					
	
						$post_ads = array(
						  'ID'    => $ads_ID,					
						  'post_title'    => sanitize_text_field($_POST['classified_maker_ads_title']),
						  'post_content'  => sanitize_text_field($_POST['classified_maker_ads_content']),
	 
						);
						
						
	
	
						// Update the post into the database
						wp_update_post( $post_ads );
						
						
						$post_thumbnail =	$_POST['classified_maker_ads_thumbs'];
						$post_thumbnail_id = $post_thumbnail[0];
						// Set ad thumbnail.
						update_post_meta( $ads_ID, '_thumbnail_id', $post_thumbnail_id );
						
						
						
						
						
	/*
	
						$classified_maker_ads_category = (int)$_POST['classified_maker_ads_category'];
						$taxonomy = 'ads_cat';
						wp_set_post_terms( $ads_ID, $classified_maker_ads_category, $taxonomy );
	
	*/
						$category = get_the_terms($ads_ID, 'ads_cat');
						$cat_id = $category[0]->term_id;
						
						//var_dump($cat_id);
						
						
						$cat_fields = $classified_maker_field_set[$cat_id];
	
					
						foreach($cat_fields as $key=>$field){
							
								
							if(isset($field['checked']) && $field['checked'] == 'yes'){
								
								//$meta_value = $_POST[$key];
								
								//update_post_meta($ads_ID, $key , $meta_value);
								
								
								if(is_array($_POST[$key])){
									
										$meta_value = serialize($_POST[$key]);
										update_post_meta($ads_ID, $key , $meta_value);
	
									}
								else{
										$meta_value = sanitize_text_field($_POST[$key]);
										update_post_meta($ads_ID, $key , $meta_value);
									}
								
								
								
								
								
								}
								
								

								
								
								
								
								
		
							}
	
	
					
						$html.= '<span class="success"><i class="fa fa-check"></i> '.__('Save Changed.').'</span>';
					}
				
				
				$html.= '</div>'; // .post-status	
	
				
				
	
				
				foreach($meta_fields as $field_key=>$field){
					
					$meta_fields_saved_values[$field_key] = get_post_meta($ads_ID, $field_key);
					
					//var_dump($meta_fields_saved_values[$field_key]);
					
					
					}
				
				//var_dump($meta_fields_saved_values);
				
				
				$html.= '<form enctype="multipart/form-data"   method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">';
	
				$html.= '<input type="hidden" name="post_ads_hidden" value="Y">';	
				
				
				
				
			
				$html.= '<div class="meta-data">';
	
				$category = get_the_terms($ads_ID, 'ads_cat');
				$cat_id = $category[0]->term_id;
					
				$cat_fields = $classified_maker_field_set[$cat_id];
				//var_dump();
				if(empty($cat_fields)){
						
						
						foreach($meta_fields as $field_key=>$field){
							
							//$cat_fields[$field_key] = $field['meta_key'];
							$cat_fields[$field_key]['checked'] = 'yes';								
							}
					
					}
				
				
				//var_dump($cat_fields);
			
				foreach($cat_fields as $key=>$field){
					
						//var_dump($key);				
						//var_dump($field);
						
						
					if(isset($field['checked']) && $field['checked'] == 'yes'){
						
						if(!empty($meta_fields[$key])){
							
							$meta_field_data = $meta_fields[$key];
							//var_dump($meta_fields_saved_values[$key][0]);
							if(!empty($meta_fields_saved_values[$key][0])){
								
								$meta_field_data = array_replace($meta_field_data, array('input_values'=>$meta_fields_saved_values[$key][0]));
								
								}
							
							
							//var_dump($meta_field_data);						
							//var_dump($meta_field_data);
							
							$html.= $class_classified_maker_form->form_input($meta_field_data);
							
							}
	
						}
	
					}
				
				
					
	
				$html.= '</div><br />';			
			
				$html.= '<input class="post-ads-submit" type="submit" value="'.__('Update Ads',classified_maker_textdomain).'" />';
			

				
				$html.= '</form>';
				
							
				}
			else{
				$html.= '<div class="post-status">';
				//$html.= __(sprintf('You are not authorized edit this ads. Go <a href="%s">Account</a> page to see your ads',$account_page_url),classified_maker_textdomain);	
				$html.= '<span class="failed"><i class="fa fa-times"></i> '.__(sprintf('You are not authorized edit this ads. Go <a href="%s">Account</a> page to see your ads',$account_page_url),classified_maker_textdomain).'</span>';
				$html.= '</div>';
				
				}
				
				
			}
			else{
				$html.= __(sprintf('Please <a href="%s">login</a> to edit ads',$account_page_url),classified_maker_textdomain);	
				
				
				}
			$html.= '</div>';
			
			return $html;
	
	
		}



		
			
			
			
			
			
	}
	
	new class_classified_maker_shortcodes_edit_ads();