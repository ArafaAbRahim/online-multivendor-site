<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_shortcodes_edit_ads{
	
    public function __construct(){
		
		add_shortcode( 'classified_maker_edit_ads', array( $this, 'post_ads' ) );

   		}
		



	public function post_ads($atts, $content = null ) {
		
		$atts = shortcode_atts(
			array(
				'themes' => 'flat',

				), $atts);
	
	
		if(isset($_GET['ads_id'])){
			$ads_ID = (int)$_GET['ads_id'];

			$category = get_the_terms($ads_ID, 'ads_cat');
			$cat_id = $category[0]->term_id;

			//var_dump($cat_id);


	

	

		
		//$class_classified_validations = new class_classified_validations();

		$class_classified_maker_functions = new class_classified_maker_functions();
		$post_type_input_fields = $class_classified_maker_functions->post_type_input_fields();
		$submitted_ads_status = $class_classified_maker_functions->submitted_ads_status();
			
			
		$ads_post = get_post($ads_ID);

		//var_dump($ads_post);

		$ads_title = $post_type_input_fields['post_title'];

		$ads_title =  array_replace($ads_title, array('input_values'=>$ads_post->post_title));

		$ads_content = $post_type_input_fields['post_content'];
		$ads_content =  array_replace($ads_content, array('input_values'=>$ads_post->post_content));

		$ads_thumbnail = $post_type_input_fields['post_thumbnail'];
		$recaptcha = $post_type_input_fields['recaptcha'];

		$post_taxonomies = $post_type_input_fields['post_taxonomies'];
		$ads_category = $post_taxonomies['ads_cat'];
			
			
			
		$meta_fields = $post_type_input_fields['meta_fields'];

		$class_pickform = new class_pickform();

		$classified_maker_submitted_ads_status = get_option('classified_maker_submitted_ads_status');
		if(empty($classified_maker_submitted_ads_status)) {$classified_maker_submitted_ads_status = 'pending';}

		$classified_maker_account_required_post_ads = get_option('classified_maker_account_required_post_ads');
		$classified_maker_reCAPTCHA_enable = get_option('classified_maker_reCAPTCHA_enable');
		$classified_maker_field_set = get_option( 'classified_maker_field_set' );
		$classified_maker_account_required_post_ads = get_option( 'classified_maker_account_required_post_ads' );

		$classified_maker_edit_ads_page_id = get_option('classified_maker_edit_ads_page_id');
		$post_ads_page_url = get_permalink($classified_maker_edit_ads_page_id);

		$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
		$account_page_url = get_permalink($classified_maker_account_page_id);

		$classified_maker_allow_edit_published_ads = get_option('classified_maker_allow_edit_published_ads');

		if($classified_maker_allow_edit_published_ads=='no'){
			return '<i class="fa fa-ban"></i> '.__('Sorry you are not authorized edit this ads.',classified_maker_textdomain);;
			}


		$taxonomy = 'ads_cat';
					
					
			
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
			
		// echo '<pre>'; print_r( $_POST ); echo '</pre>';
						

				
		//var_dump($_POST);

		$html.= '<div class="post-ads pickform">';


		$html.= '<div class="editing-title"><i class="fa fa-pencil" aria-hidden="true"></i> '.get_the_title($ads_ID).'</div>';


		$html.= '<div class="post-status">';

		if(isset($_POST['post_ads_hidden'])){

			$cat_fields = $classified_maker_field_set[$cat_id];


			if(empty($_POST['post_title'])){

				$validations['post_title'] = '';
				$html.= '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$ads_title['title'].'</b> '.__('missing',classified_maker_textdomain).'.</div>';
			}

			if(empty($_POST['post_content'])){
				$validations['post_content'] = '';
				$html.= '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$ads_content['title'].'</b> '.__('missing',classified_maker_textdomain).'.</div>';
			}

			if( $classified_maker_reCAPTCHA_enable=='yes') {
				if( empty($_POST['g-recaptcha-response'])){

				 $validations['recaptcha'] = '';
				 $html.= '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$recaptcha['title'].'</b> '.__('missing',classified_maker_textdomain).'.</div>';
				}
			}


		if(empty($_POST['ads_cat'])){

			 $validations['job_category'] = '';
			 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$ads_category['title'].'</b> '.__('missing',classified_maker_textdomain).'.</div>';
			}



				foreach($meta_fields as $key=>$field_data){

					$meta_key = $field_data['meta_key'];
					$meta_title = $field_data['title'];

					if(isset($_POST[$meta_key])){
						 $valid = $class_pickform->validations($field_data, $_POST[$meta_key]);
						}


					 if(!empty( $valid)){
						 $validations[$meta_key] = $valid;
						 $html.= '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$meta_title.'</b> '.$valid.'.</div>';

						 }
					}



				
			/*

			if(!empty($validations)){



				foreach($validations as $key=>$validation){


					$validation_html.= '<span class="failed"><i class="fa fa-times"></i> <strong>'.$meta_fields[$key]['title'].'</strong> '.__('is empty.',classified_maker_textdomain).'</span>';


					}



				}

			*/
				
				

					
					
			//$html.= $validation_html;
				

				
			$post_thumbnail =	$_POST['classified_maker_ads_thumbs'];
			$post_thumbnail_id = $post_thumbnail[0];
				
				
			/*

			$post_ads = array(
			  'post_title'    => ($_POST['post_title']),
			  'post_content'  => ($_POST['post_content']),
			  'post_status'   => $classified_maker_submitted_ads_status,
			  'post_type'   => 'ads',
			  'post_author'   => $userid,
			);

			*/
				
				//var_dump($_POST['ads_cat']);
				
			$classified_maker_ads_category = (int)$_POST['ads_cat'];
			$taxonomy = 'ads_cat';
			$html_after_submited = '';
				
				

			if(empty($validations)){

				// var_dump('go update');



				$ads_title_val = $class_pickform->sanitizations($_POST['post_title'], 'text');
				$ads_content_val = $class_pickform->sanitizations($_POST['post_content'], 'wp_editor');
				//$ads_category_val = $class_pickform->sanitizations($_POST['job_category'], 'select_multi');

				$ads_post = array(
				  'ID'           => $ads_ID,
				  'post_title'    => $ads_title_val,
				  'post_content'  => $ads_content_val,
				  'post_status'   => $classified_maker_submitted_ads_status,

				);

				// Update the post into the database

				$is_update = wp_update_post($ads_post);



				// Insert the post into the database
				//$ads_ID = wp_insert_post($post_ads);


				// Set ad thumbnail.
				update_post_meta( $ads_ID, '_thumbnail_id', $post_thumbnail_id );

				// update meta data
				wp_set_post_terms( $ads_ID, $classified_maker_ads_category, $taxonomy );

				if(!empty($cat_fields))
				foreach($cat_fields as $key=>$field) {

					if(isset($field['checked']) && $field['checked'] == 'yes' && isset($_POST[$key])) {

						if(is_array($_POST[$key])){

								$meta_value = serialize($_POST[$key]);
								update_post_meta($ads_ID, $key , $meta_value);
						}
						else {
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

				$email_body = strtr($classified_maker_email_templates_data['ads_update']['html'], $email_parameter_vars);
				$email_subject =strtr($classified_maker_email_templates_data['ads_update']['subject'], $email_parameter_vars);



				$classified_maker_send_email = $class_classified_maker_emails->classified_maker_send_email($admin_email, $email_subject, $email_body);


				$html_after_submited.= '<span class="success"><i class="fa fa-check"></i> '.__('Ads Update Successful.',classified_maker_textdomain).'</span>';
				$html_after_submited.= '<span class="success"><i class="fa fa-check"></i> '.__('Ads Status:',classified_maker_textdomain).' '.$submitted_ads_status[$classified_maker_submitted_ads_status].'</span>';

				$html.= apply_filters('classified_maker_filter_after_submit_ads',$html_after_submited);

				}
				
					
				else{
					
					
					
					
					//$meta_fields = $meta_fields;
					
					
					foreach($cat_fields as $key=>$field){
							
						if(isset($field['checked']) && $field['checked'] == 'yes'){
							
								if(is_array($_POST[$key])){
									$meta_value = $_POST[$key];
									}
								else{
									$meta_value = sanitize_text_field($_POST[$key]);
									}
							
								
								$meta_fields[$key] = array_replace($meta_fields[$key], array('input_values'=>$meta_value));
								
								
								
								
							//update_post_meta($ads_ID, $key , $meta_value);
							
							}
	
						}
					
					
					
					
					
					
					//$html.= '<span class="failed"><i class="fa fa-times"></i> '.__('reCAPTCHA is missing.',classified_maker_textdomain).'</span>';
					
					}

				//var_dump($meta_fields);
			

				}
			
			
			$html.= '</div>';

			
			
			
			
			
			$html.= '<form enctype="multipart/form-data"   method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">';

			$html.= '<input type="hidden" name="post_ads_hidden" value="Y">';	
			
			
			
			
			
			if($step ==1)	{

				//unset($_COOKIE['classified_maker_cat_id']);
				//unset($_COOKIE['classified_maker_location']);

				
				//var_dump($_COOKIE['classified_maker_cat_id']);


				$taxonomy = 'ads_cat';
				$args=array(
				  'orderby' => 'name',
				  'order' => 'ASC',
				  'taxonomy' => $taxonomy,
				  'hide_empty' => false,
				  'parent'  => 0,
				  );
				
				$categories = get_categories($args);
	
				
				
				
				$html.= '<div class="item">';
				$html.= '<div class="title">'.__('Select Category',classified_maker_textdomain).'</div>';
				$html.= '<div class="option-details"></div>';
				
				
				//$html.= '<p>'.__('Select Category',classified_maker_textdomain).'</p>';			
				
				$html.= '<ul class="ads-cats">';			
				
				if(!empty($categories)){
					
					//var_dump($cat_id);
					
						$category = get_term_by('id', $cat_id, 'ads_cat');
						$category_parent_id = $category->parent;
					
					
					foreach($categories as $category){
						
						$name = $category->name;
						$category_id = $category->cat_ID;	
			
						if($category_id == $cat_id || $category_parent_id == $category_id){
							$html.= '<li class="active" cat-id="'.$category_id.'">';
							}
						else{
							$html.= '<li cat-id="'.$category_id.'">';
							}		
						
						
						
						$html.= $name;						
						$html.= ' <i class="fa fa-chevron-right"></i></li>';
	
						}
					
					
					}
				else{
					
						$html.= '<li ><i class="fa fa-exclamation-triangle"></i> '.__('No categories found.',classified_maker_textdomain);
						$html.= '</li>';
					
					}


				$html.= '</ul>';	
							
				$html.= '<ul class="ads-child-cats">';
				
				if(!empty($category_parent_id)){
					
					$taxonomy = 'ads_cat';
					
					
					//var_dump($category_parent_id);
					
					$args=array(
					  'orderby' => 'name',
					  'order' => 'ASC',
					  'taxonomy' => $taxonomy,
					  'hide_empty' => false,
					  'child_of'  => $category_parent_id,
					  );
					
					$categories = get_categories($args);
			
					//var_dump();
					
					
					if(!empty($categories)){
						
						foreach($categories as $category){
							
							$name = $category->name;
							$category_id = $category->cat_ID;	
								
								if($category_id == $cat_id ){
									
									$html.= '<li class="active" cat-id="'.$category_id.'"><i class="fa fa-check"></i> '.$name.'</li>';
									}
								else{
									$html.= '<li cat-id="'.$category_id.'"><i class="fa fa-check"></i> '.$name.'</li>';
									}
									
								
				
							}
						
						}					
					
					
					}
				

				
				
				$html.= '</ul>';
				
				$html.= '</div>';
				$html.= '<p class=""><a class="next-step-2" href="'.$post_ads_page_url.'?step=2&ads_id='.$ads_ID.'">'.__('Next',classified_maker_textdomain).' <i class="fa fa-angle-double-right"></i></a></p>';	
				
				
				
			}
			elseif($step ==2){
				
				
				if(!empty($_COOKIE['classified_maker_cat_id'])){
					
					$cat_id = $_COOKIE['classified_maker_cat_id'];
					
					wp_set_post_terms( $ads_ID, $cat_id, $taxonomy );
					
					$category = get_term_by('id', $cat_id, 'ads_cat');
					
						if(!empty($category)){
							
							$category_parent_id = $category->parent;
							$category_parent = get_term_by('id', $category_parent_id, 'ads_cat');
							
							
	
	
						
						
						$html.= '<div class="item">';
						$html.= '<div class="title">'.__('Category:',classified_maker_textdomain).'</div>';
						//$html.= '<div class="option-details">'.__('',classified_maker_textdomain).'</div>';
							
							
							
						//$html.= '<p>'.__('Category:',classified_maker_textdomain).'</p>';
						if(!empty($category_parent)){
							$html.= '<p class="">'.$category_parent->name.' » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
						else{
							$html.= '<p class=""> » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
						
							
						$html.= '</div>';
						
						
						}
					else{
						$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Category missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
						
						}
					
					
					}
				else{
					$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Category missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
					
					}
					
					$html.= '<div class="option">';
					$html.= '<div class="option-title">'.__('Select Location:',classified_maker_textdomain).'</div>';
					
					//$html.= '<p>'.__('Select Location:',classified_maker_textdomain).'</p>';	
					
				$location = get_post_meta($ads_ID, 'classified_maker_ads_location', true );
					
				//var_dump($location);
					
				if(empty($location)){
					$location = $_COOKIE['classified_maker_location'];
					}
					
					
					$html.= '<p><input type="text" class="location" placeholder="Location" value="'.$location.'" /></p>';
					//$html.= '<p><input type="text" class="city" placeholder="City" value="" /></p>';
						
					$html.= '</div>';		
					$html.= '<p class=""><a class="next-step-3" href="'.$post_ads_page_url.'?step=3&ads_id='.$ads_ID.'">'.__('Next',classified_maker_textdomain).' <i class="fa fa-angle-double-right"></i></a></p>';					
				
			}
			
			elseif($step == 3){
				
				if(isset($_COOKIE['classified_maker_location'])){
					$location = $_COOKIE['classified_maker_location'];
					
					
					}
				else{
					$location = '';
					}
					
					
				update_post_meta($ads_ID, 'classified_maker_ads_location',$location );
				
				$html.= '<div class="item">';
				$html.= '<p class=""><i class="fa fa-check"></i> Location Saved.</p>';				
				$html.= '</div>';
				
				$html.= '<p class=""><a class="next-step-4" href="'.$post_ads_page_url.'?step=4&ads_id='.$ads_ID.'">'.__('Next',classified_maker_textdomain).' <i class="fa fa-angle-double-right"></i></a></p>';
				
				$html.= '
				<script>
				window.location.replace("'.$post_ads_page_url.'?step=4&ads_id='.$ads_ID.'");
				</script>
				
				';

				
			}
			elseif($step == 4){
				
				//var_dump($_COOKIE['classified_maker_cat_id']);
				//var_dump($cat_id);
				
				//unset($_COOKIE['classified_maker_cat_id']);
				//unset($_COOKIE['classified_maker_location']);


/*

				if(isset($_COOKIE['classified_maker_cat_id'])){
					
					$cat_id = $_COOKIE['classified_maker_cat_id'];
					}
				else{
					$cat_id = $cat_id;
					}

*/



				if(!empty($cat_id)){

					$category = get_term_by('id', $cat_id, 'ads_cat');
					
					if(!empty($category)){
						
						$category_parent_id = $category->parent;
						$category_parent = get_term_by('id', $category_parent_id, 'ads_cat');
						
						$classified_maker_edit_ads_page_id = get_option('classified_maker_edit_ads_page_id');
						$post_ads_page_url = get_permalink($classified_maker_edit_ads_page_id);
						
						$html.= '<div class="item">';
						$html.= '<div class="title">'.__('Category:',classified_maker_textdomain).'</div>';
						
						//$html.= '<p>'.__('Category:',classified_maker_textdomain).'</p>';
						
						if(!empty($category_parent)){
							
							$html.= '<p class="">'.$category_parent->name.' » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							
							
							
							}
						else{
								$html.= '<p class=""> » '.$category->name.' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
							}
												
						$html.= '<input type="hidden" value="'.$cat_id.'"  name="ads_cat" />';
					
						$html.= '</div>';
						
						}

					}
					
				else{
					$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Category missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=1&ads_id='.$ads_ID.'">'.__('Change Category',classified_maker_textdomain).'</a>)</p>';
					
					}
					
					
				
				$location = get_post_meta($ads_ID,'classified_maker_ads_location', true);
	
	
				if(isset($_COOKIE['classified_maker_location'])){
					$location = $_COOKIE['classified_maker_location'];
					}
				else{
					$location = $location;
					}
	
				//var_dump($location);			
/*




				if(isset($_COOKIE['classified_maker_city'])){
					$city = $_COOKIE['classified_maker_city'];
					}
				else{
					$city = '';
					}
» '.$city.'
*/
				
				$html.= '<div class="item">';
				$html.= '<div class="title">'.__('Location:',classified_maker_textdomain).'</div>';
								
				//$html.= '<p>'.__('Location:',classified_maker_textdomain).'</p>';
				
				if(!empty($location)){
					
					$html.= '<p class="">'.$location.'  (<a href="'.$post_ads_page_url.'?step=2&ads_id='.$ads_ID.'">'.__('Change Location',classified_maker_textdomain).'</a>)</p>';
					}
				else{
					$html.= '<p class=""><i class="fa fa-exclamation-triangle"></i> '.__('Location missing',classified_maker_textdomain).' (<a href="'.$post_ads_page_url.'?step=2&ads_id='.$ads_ID.'">'.__('Change Location',classified_maker_textdomain).'</a>)</p>';
					}

				$html.= '</div>';	
				
				$cookie_name = 'classified_maker_ads_thumbs';
				
					if(isset($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						
						$attach_ids = explode(',',$attach_ids);

						//var_dump($attach_ids);
						
						
					}
			
			

			
				$html.= '<div class="item">';
				$html.= $class_pickform->field_set($ads_title);
				$html.= '</div>';	
			
			
				$html.= '<div class="item">';
				$html.= $class_pickform->field_set($ads_content);
				$html.= '</div>';			
			
			
			
			
/*

				$html.= '<div class="item">';
				$html.= $class_pickform->field_set($ads_thumbnail);
				$html.= '</div>';

*/				
			
				
				//var_dump(classified_maker_get_cookie_value('classified_maker_cat_id'));
			
/*

				$html.= '<div class="item">';
				$html.= $class_pickform->field_set($ads_category);
				$html.= '</div>';

*/	
						


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
					
					
					// echo '<pre>';  print_r( $meta_fields ); echo '</pre>'; 
				
					foreach($cat_fields as $key=>$field){
						
							
						if(isset($field['checked']) && $field['checked'] == 'yes'){
							
							if(!empty($meta_fields[$key])){
								$html.= '<div class="item">';
								
								$meta_value = get_post_meta($ads_ID, $key, true);
								
								if(is_serialized($meta_value)){
									
									//$meta_value = $meta_value[0];									
									$meta_value = unserialize($meta_value);
									//echo '<pre>'.var_export($meta_value, true).'</pre>';
									}
								else{
									$meta_value = $meta_value;
									}
								
								
								$meta_field_data = array_replace($meta_fields[$key], array('input_values'=>$meta_value));
								
								$html.= $class_pickform->field_set($meta_field_data);
								
								$html.= '</div>';
								}

							}
	
						}
					
					
					}

			
				if($classified_maker_reCAPTCHA_enable=='yes'){
					$html.= '<div class="item">';
					$html.= $class_pickform->field_set($recaptcha);
					$html.= '</div>';
					
					}
				
			

			
			
			
			
			
			
			
			
				$html.= '<input class="post-ads-submit" type="submit" value="'.__('Update',classified_maker_textdomain).'" />';
			
			}
			
			elseif($step == 5){
				
				
				
				
				
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
					$category_id = $category->cat_ID;	
					
								
						$html.= '<li cat-id="'.$category_id.'">'.$name;
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
			else{

				?>
				<div class="error"><i class="fa fa-exclamation-triangle"></i> Sorry ads id is missing</div>
				<?php

			}
		}
		
			
			
			
			
			
	}
	
	new class_classified_maker_shortcodes_edit_ads();