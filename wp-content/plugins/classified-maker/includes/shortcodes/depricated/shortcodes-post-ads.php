<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_shortcodes_post_ads{
	
    public function __construct(){
		
		add_shortcode( 'classified_maker_post_ads', array( $this, 'post_ads' ) );

   		}
		



	public function post_ads($atts, $content = null ) {
		
			$atts = shortcode_atts(
				array(
					'themes' => 'flat',
											
					), $atts);
	
	
	

		
			$class_classified_validations = new class_classified_validations();			

			$class_classified_maker_functions = new class_classified_maker_functions();
			$meta_fields_data = $class_classified_maker_functions->meta_fields_data();
			$submitted_ads_status = $class_classified_maker_functions->submitted_ads_status();			
			
			
			$meta_fields = $meta_fields_data[0]['meta_fields'];
			
			$class_classified_maker_form = new class_classified_maker_form();

			$classified_maker_submitted_ads_status = get_option('classified_maker_submitted_ads_status');
			if(empty($classified_maker_submitted_ads_status)) {$classified_maker_submitted_ads_status = 'pending';}
			
			$classified_maker_account_required_post_ads = get_option('classified_maker_account_required_post_ads');	
			$classified_maker_reCAPTCHA_enable = get_option('classified_maker_reCAPTCHA_enable');
			$classified_maker_field_set = get_option( 'classified_maker_field_set' );
			$classified_maker_account_required_post_ads = get_option( 'classified_maker_account_required_post_ads' );			

			$classified_maker_submit_ads_page_id = get_option('classified_maker_submit_ads_page_id');
			$post_ads_page_url = get_permalink($classified_maker_submit_ads_page_id);
			
			$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
			$account_page_url = get_permalink($classified_maker_account_page_id);
			
					
			
			$html = '';
			
			if($classified_maker_account_required_post_ads=='yes' && !is_user_logged_in()){
				return __(sprintf('Please <a href="%s">login</a> to post ads.',$account_page_url),classified_maker_textdomain);;
				}
			
			if ( is_user_logged_in() ) {
					$userid = get_current_user_id();
				}
			else{
				$userid = 0;
				}
			

			
			//$classified_maker_themes = $atts['themes'];
			
			if(isset($_GET['step'])){
				$step = sanitize_text_field($_GET['step']);
				}
			else{
				
				$step = 1;
				}
			

						

				
			//var_dump($_POST);
			
			$html.= '<div class="post-ads">';
			
						
			$html.= '<div class="post-status">';
			
			if(isset($_POST['post_ads_hidden'])){
				
				
				//var_dump($_POST);
				
				
				if(isset($_COOKIE['classified_maker_cat_id'])){
					
					$cat_id = $_COOKIE['classified_maker_cat_id'];
					}
				else{
					$cat_id = '';
					}
				$cat_fields = $classified_maker_field_set[$cat_id];
				
				$validations = $class_classified_validations->validation($cat_id, $_POST);
				
				$validation_html = '';
				
				if(!empty($validations)){
					
					
					
					foreach($validations as $key=>$validation){
						
						
						$validation_html.= '<span class="failed"><i class="fa fa-times"></i> <strong>'.$meta_fields[$key]['title'].'</strong> '.__('is empty.',classified_maker_textdomain).'</span>';
						
						
						}
					
						
					
					}
					
					
				$html.= $validation_html;
				//var_dump($validations);
				
				$post_thumbnail =	$_POST['classified_maker_ads_thumbs'];
				$post_thumbnail_id = $post_thumbnail[0];
				
				
				$post_ads = array(
				  'post_title'    => sanitize_text_field($_POST['classified_maker_ads_title']),
				  'post_content'  => ($_POST['classified_maker_ads_content']),
				  'post_status'   => $classified_maker_submitted_ads_status,
				  'post_type'   => 'ads',
				  'post_author'   => $userid,
				);
				
				$classified_maker_ads_category = (int)$_POST['classified_maker_ads_category'];
				$taxonomy = 'ads_cat';
				$html_after_submited = '';
				
				
				if(!empty($_POST['g-recaptcha-response']) && $classified_maker_reCAPTCHA_enable=='yes' && empty($validations)){

					// Insert the post into the database
					$ads_ID = wp_insert_post($post_ads);
					
					
					// Set ad thumbnail.
					update_post_meta( $ads_ID, '_thumbnail_id', $post_thumbnail_id );
					
					// update meta data
					wp_set_post_terms( $ads_ID, $classified_maker_ads_category, $taxonomy );
					
					if(!empty($cat_fields))
					foreach($cat_fields as $key=>$field){
							
						if($field['checked'] == 'yes'){
							
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
					
					
					global $current_user; // to get user display name
					
					$ads_data = get_post($ads_ID);
					
					$post_title = $ads_data->post_title;
					$post_content = $ads_data->post_content;
					
					$email_parameter_vars = array(
						'{site_name}'=> get_bloginfo('name'),
						'{site_description}' => get_bloginfo('description'),
						'{site_url}' => get_bloginfo('url'),						
					 	'{site_logo_url}' => get_option('ads_bm_logo_url'),
					  
					  	'{user_name}' => $current_user->display_name,						  
					  	'{user_avatar}' => get_avatar( $current_user->user_email, 60 ),
					  	'{user_email}' => $current_user->user_email,
													
					  	'{ads_title}'  => get_the_title($ads_ID),						  			
					  	'{ads_url}'  => get_permalink($ads_ID),
					  	'{ads_edit_url}'  => get_admin_url().'post.php?post='.$ads_ID.'&action=edit',						
					  	'{ads_id}'  => $ads_ID,	
					  	'{ads_content}'  => $post_content,												

					);
					
					$email_parameter_vars = apply_filters('classified_maker_email_parameter_vars',$email_parameter_vars);
					
					$admin_email = get_option('admin_email');					
					$classified_maker_email_templates_data = get_option( 'classified_maker_email_templates_data' );

					$class_classified_maker_emails = new class_classified_maker_emails();
					$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
	

					
					if(empty($classified_maker_email_templates_data)){
						//$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
						$classified_maker_email_templates_data = $templates_data;
						
						}
					else{
						//$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
						$classified_maker_email_templates_data =array_merge($templates_data, $classified_maker_email_templates_data);
						
						}	

					$email_body = strtr($classified_maker_email_templates_data['new_ads_submitted']['html'], $email_parameter_vars);
					$email_subject =strtr($classified_maker_email_templates_data['new_ads_submitted']['subject'], $email_parameter_vars);
					
					

					$classified_maker_send_email = $class_classified_maker_emails->classified_maker_send_email($admin_email, $email_subject, $email_body);

					
					$html_after_submited.= '<span class="success"><i class="fa fa-check"></i> '.__('Ads Submitted.',classified_maker_textdomain).'</span>';				
					$html_after_submited.= '<span class="success"><i class="fa fa-check"></i> '.__('Submission Status:',classified_maker_textdomain).' '.$submitted_ads_status[$classified_maker_submitted_ads_status].'</span>';	
					$html.= apply_filters('classified_maker_filter_after_submit_ads',$html_after_submited);					

					}
				elseif($classified_maker_reCAPTCHA_enable=='no' && empty($validations)){
					
					// Insert the post into the database
					$ads_ID = wp_insert_post($post_ads);
					
					// Set ad thumbnail.
					update_post_meta( $ads_ID, '_thumbnail_id', $post_thumbnail_id );
					
					
					// update meta data
					wp_set_post_terms( $ads_ID, $classified_maker_ads_category, $taxonomy );
				
					foreach($cat_fields as $key=>$field){
							
						if($field['checked'] == 'yes'){
							
							//$meta_value = sanitize_text_field($_POST[$key]);
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
					
					
					
					
					global $current_user; // to get user display name
					
					$email_parameter_vars = array(
						'{site_name}'=> get_bloginfo('name'),
						'{site_description}' => get_bloginfo('description'),
						'{site_url}' => get_bloginfo('url'),						
					 	'{site_logo_url}' => get_option('ads_bm_logo_url'),
					  
					  	'{user_name}' => $current_user->display_name,						  
					  	'{user_avatar}' => get_avatar( $userid, 60 ),
					  	'{user_email}' => '',
													
					  	'{ads_title}'  => get_the_title($ads_ID),						  			
					  	'{ads_url}'  => get_permalink($ads_ID),
					  	'{ads_edit_url}'  => get_admin_url().'post.php?post='.$ads_ID.'&action=edit',						
					  	'{ads_id}'  => $ads_ID,	
					  	'{ads_content}'  => $post_content,												

					);
					
					$email_parameter_vars = apply_filters('classified_maker_email_parameter_vars',$email_parameter_vars);
					
					$admin_email = get_option('admin_email');					
					$classified_maker_email_templates_data = get_option( 'classified_maker_email_templates_data' );

					$class_classified_maker_emails = new class_classified_maker_emails();
					$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
	

					
					if(empty($classified_maker_email_templates_data)){
						//$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
						$classified_maker_email_templates_data = $templates_data;
						
						}
					else{
						//$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
						$classified_maker_email_templates_data =array_merge($templates_data, $classified_maker_email_templates_data);
						
						}	

					$email_body = strtr($classified_maker_email_templates_data['new_ads_submitted']['html'], $email_parameter_vars);
					$email_subject =strtr($classified_maker_email_templates_data['new_ads_submitted']['subject'], $email_parameter_vars);
					
					

					$classified_maker_send_email = $class_classified_maker_emails->classified_maker_send_email($admin_email, $email_subject, $email_body);
					
					$html_after_submited.= '<span class="success"><i class="fa fa-check"></i> '.__('Ads Submitted.',classified_maker_textdomain).'</span>';				
					$html_after_submited.= '<span class="success"><i class="fa fa-check"></i> '.__('Submission Status: '.$classified_maker_submitted_ads_status,classified_maker_textdomain).'</span>';	
					$html.= apply_filters('classified_maker_filter_after_submit_ads',$html_after_submited);	
					
					}
					
					
				else{
					
					//var_dump($meta_fields);
					
					//$meta_fields = $meta_fields;
					
					
					foreach($cat_fields as $key=>$field){
							
						if($field['checked'] == 'yes'){
							
								$meta_value = sanitize_text_field($_POST[$key]);
								$meta_fields[$key] = array_replace($meta_fields[$key], array('input_values'=>$meta_value));
							//update_post_meta($ads_ID, $key , $meta_value);
							
							}
	
						}
					
					
					
					
					
					
					$html.= '<span class="failed"><i class="fa fa-times"></i> '.__('reCAPTCHA is missing.',classified_maker_textdomain).'</span>';
					
					}

				
			

				}
			
			
			$html.= '</div>';

			
			
			
			
			
			$html.= '<form enctype="multipart/form-data"   method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">';

			$html.= '<input type="hidden" name="post_ads_hidden" value="Y">';	
			
			
			
			
			
			if($step ==1)	{

				$taxonomy = 'ads_cat';
				$args=array(
				  'orderby' => 'name',
				  'order' => 'ASC',
				  'taxonomy' => $taxonomy,
				  'hide_empty' => false,
				  'parent'  => 0,
				  );
				
				$categories = get_categories($args);
	
				
				
				
				$html.= '<div class="option">';
				$html.= '<div class="option-title">'.__('Select Category',classified_maker_textdomain).'</div>';
				$html.= '<div class="option-details"></div>';
				
				
				//$html.= '<p>'.__('Select Category',classified_maker_textdomain).'</p>';			
				
				$html.= '<ul class="ads-cats">';			
				
				if(!empty($categories)){
					
					foreach($categories as $category){
						
						$name = $category->name;
						$cat_ID = $category->cat_ID;	
						
									
						$html.= '<li cat-id="'.$cat_ID.'">'.$name;
						$html.= ' <i class="fa fa-chevron-right"></i></li>';
	
						}
					
					
					}
				else{
					
						$html.= '<li ><i class="fa fa-exclamation-triangle"></i> '.__('No categories found.',classified_maker_textdomain);
						$html.= '</li>';
					
					}


				$html.= '</ul>';	
							
				$html.= '<ul class="ads-child-cats">';
				$html.= '</ul>';
				
				$html.= '</div>';
				$html.= '<p class=""><a class="next-step-2" href="'.$post_ads_page_url.'?step=2">'.__('Next',classified_maker_textdomain).' <i class="fa fa-angle-double-right"></i></a></p>';	
				
				
				
				}
			elseif($step ==2){
				
				
				if(!empty($_COOKIE['classified_maker_cat_id'])){
					
					$cat_id = $_COOKIE['classified_maker_cat_id'];
					
					$category = get_term_by('id', $cat_id, 'ads_cat');
					
						if(!empty($category)){
							
							$category_parent_id = $category->parent;
							$category_parent = get_term_by('id', $category_parent_id, 'ads_cat');
							
							
	
	
						
						
						$html.= '<div class="option">';
						$html.= '<div class="option-title">'.__('Category:',classified_maker_textdomain).'</div>';
						//$html.= '<div class="option-details">'.__('',classified_maker_textdomain).'</div>';
							
							
							
						//$html.= '<p>'.__('Category:',classified_maker_textdomain).'</p>';
						if(!empty($category_parent)){
							$html.= '<p class="">'.$category_parent->name.' » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
						else{
							$html.= '<p class=""> » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
						
							
						$html.= '</div>';
						
						
						}
					else{
						$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Category missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
						
						}
					
					
					}
				else{
					$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Category missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
					
					}
					
					$html.= '<div class="option">';
					$html.= '<div class="option-title">'.__('Select Location:',classified_maker_textdomain).'</div>';
					
					//$html.= '<p>'.__('Select Location:',classified_maker_textdomain).'</p>';	
					
				if(isset($_COOKIE['classified_maker_location'])){
					$location = $_COOKIE['classified_maker_location'];
					}
				else{
					$location = '';
					}
					
					
					$html.= '<p><input type="text" class="location" placeholder="Location" value="'.$location.'" /></p>';
					//$html.= '<p><input type="text" class="city" placeholder="City" value="" /></p>';
						
					$html.= '</div>';		
					$html.= '<p class=""><a class="next-step-3" href="'.$post_ads_page_url.'?step=3">'.__('Next',classified_maker_textdomain).' <i class="fa fa-angle-double-right"></i></a></p>';					
				
				}	
			
			
			elseif($step ==3){
				
				if(isset($_COOKIE['classified_maker_cat_id'])){
					
					$cat_id = $_COOKIE['classified_maker_cat_id'];
					}
				else{
					$cat_id = '';
					}
				
				
				if(!empty($cat_id)){

					$category = get_term_by('id', $cat_id, 'ads_cat');
					
					if(!empty($category)){
						
						$category_parent_id = $category->parent;
						$category_parent = get_term_by('id', $category_parent_id, 'ads_cat');
						
						$classified_maker_submit_ads_page_id = get_option('classified_maker_submit_ads_page_id');
						$post_ads_page_url = get_permalink($classified_maker_submit_ads_page_id);
						
						$html.= '<div class="option">';
						$html.= '<div class="option-title">'.__('Category:',classified_maker_textdomain).'</div>';
						
						//$html.= '<p>'.__('Category:',classified_maker_textdomain).'</p>';
						
						if(!empty($category_parent)){
							
							$html.= '<p class="">'.$category_parent->name.' » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
						else{
								$html.= '<p class=""> » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
						
	
						$html.= '</div>';
						
						}
					
		
					}
					
				else{
					$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Category missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=1">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
					
					}
					
					
				
				if(isset($_COOKIE['classified_maker_location'])){
					$location = $_COOKIE['classified_maker_location'];
					}
				else{
					$location = '';
					}
				
/*

				if(isset($_COOKIE['classified_maker_city'])){
					$city = $_COOKIE['classified_maker_city'];
					}
				else{
					$city = '';
					}
» '.$city.'
*/
				
				$html.= '<div class="option">';
				$html.= '<div class="option-title">'.__('Location:',classified_maker_textdomain).'</div>';
								
				//$html.= '<p>'.__('Location:',classified_maker_textdomain).'</p>';
				
				if(!empty($location)){
					
					$html.= '<p class="">'.$location.'  (<a href="'.$post_ads_page_url.'?step=2">'.__('Change Location',classified_maker_textdomain).'</a>)</p>';
					}
				else{
					$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Location missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=2">'.__('Change Location',classified_maker_textdomain).'</a>)</p>';
					}
				
				
				
				$html.= '</div>';	
				
				$cookie_name = 'classified_maker_ads_thumbs';
				
					if(isset($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						
						$attach_ids = explode(',',$attach_ids);

						//var_dump($attach_ids);
						
						
					}
			
			
				$html.= '<div class="meta-data">';

				if(!empty($cat_id)){
					//var_dump($cat_id);
					$cat_fields = $classified_maker_field_set[$cat_id];
					//var_dump($cat_id);
					if(empty($cat_fields)){
							
							
							foreach($meta_fields as $field_key=>$field){
								
								//$cat_fields[$field_key] = $field['meta_key'];
								$cat_fields[$field_key]['checked'] = 'yes';								
								}
						
						}
					
					
					//var_dump($cat_fields);
				
					foreach($cat_fields as $key=>$field){
						
							
						if(isset($field['checked']) && $field['checked'] == 'yes'){
							
							if(!empty($meta_fields[$key])){
								$html.= $class_classified_maker_form->form_input($meta_fields[$key]);
								}

							}
	
						}
					
					
					}

				$html.= '</div><br />';			
			
				$html.= '<input class="post-ads-submit" type="submit" value="'.__('Submit',classified_maker_textdomain).'" />';
			
			}
			
			elseif($step == 4){
				
				
				
				
				
				}
			
			
			else{
				
				$taxonomy = 'ads_cat';
				$args=array(
				  'orderby' => 'name',
				  'order' => 'ASC',
				  'taxonomy' => $taxonomy,
				  'hide_empty' => false,
				  'parent'  => 0,
				  );
				
				$categories = get_categories($args);
	
				//var_dump($categories_all);
				
				
				
				
				$html.= '<p>'.__('Select Category',classified_maker_textdomain).'</p>';			
				
				$html.= '<ul class="ads-cats">';			
				
				foreach($categories as $category){
					
					$name = $category->name;
					$cat_ID = $category->cat_ID;	
					
								
						$html.= '<li cat-id="'.$cat_ID.'">'.$name;
						$html.= ' <i class="fa fa-chevron-right"></i></li>';
						
					
					
					}
				
				
				
				$html.= '</ul>';				
				$html.= '<ul class="ads-child-cats">';
				$html.= '</ul>';
				
				}
			
			
			
			$html.= '</form>';
			
			$html.= '</div>';			
			


			return $html;
	
	
		}
		
			
			
			
			
			
	}
	
	new class_classified_maker_shortcodes_post_ads();