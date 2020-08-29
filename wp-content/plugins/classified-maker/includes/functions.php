<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 









	
	function classified_maker_ajax_remove_wishlist_ads(){
		
		$ads_id 	= sanitize_text_field($_POST['ads_id']); 
		$user_id	= get_current_user_id();
		
		global $wpdb;
		
		$ret = $wpdb->delete( 
			$wpdb->prefix . classified_maker_wishlist_table_name,
			array( 
				'ads_id' => $ads_id,
				'user_id' => $user_id,
			) 
		);

		
		if( $ret == false ) echo 'error';
		else echo 'removed';
		die();
	}
	add_action('wp_ajax_classified_maker_ajax_remove_wishlist_ads', 'classified_maker_ajax_remove_wishlist_ads');
	add_action('wp_ajax_nopriv_classified_maker_ajax_remove_wishlist_ads', 'classified_maker_ajax_remove_wishlist_ads');
	
	
	function classified_maker_ajax_ads_wishlist(){
		
		$ads_id = sanitize_text_field($_POST['ads_id']); 
		
		$user_id = get_current_user_id();
		
		global $wpdb;
		$wishlist_item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . classified_maker_wishlist_table_name ." WHERE ads_id=$ads_id AND user_id=$user_id" );
		
		// echo '<pre>'; print_r( $wishlist_item ); echo '</pre>';
		
		if( !empty( $wishlist_item ) ) {
			echo '<p class="wishlist_notice" style="color:#C13C31;">' . __('This item is already in your wishlist!!!', classified_maker_textdomain). '</p>';
			die();
		}
		
		$gmt_offset	= get_option('gmt_offset');
		$date_time 	= date('Y-m-d H:i:s', strtotime('+'.$gmt_offset.' hour'));
		
		
		$wpdb->insert(
			$wpdb->prefix . classified_maker_wishlist_table_name,
			array(
				'ads_id' => $ads_id,
				'user_id' => $user_id,
				'date_time' => $date_time 
			)
		);
		
		echo '<p class="wishlist_notice" style="color:#3879D9;">' . __('Successfully added to your wishlist', classified_maker_textdomain). '</p>';
		die();
	}
	add_action('wp_ajax_classified_maker_ajax_ads_wishlist', 'classified_maker_ajax_ads_wishlist');
	add_action('wp_ajax_nopriv_classified_maker_ajax_ads_wishlist', 'classified_maker_ajax_ads_wishlist');
	
	
	function classified_maker_ajax_report_ads(){
		
		$ads_id = sanitize_text_field($_POST['ads_id']); 
		$input_reason = sanitize_text_field($_POST['input_reason']); 
		$input_message = sanitize_text_field($_POST['input_message']); 
		
		
		$wp_report_query = new WP_Query(
			array (
				'post_type' => 'reports',
				'post_status' => 'publish',
				'meta_query' => array(
					array(
						'key'     => 'ads_id',
						'value'   => $ads_id,
						'compare' => '=',
					),
				),
				'author'   => get_current_user_id(),
		) );
		
		if( $wp_report_query->found_posts > 0 ) {
			echo '<p class="report_screen_notice" style="color:#C13C31;">' . __("You can't report here more than Once!", classified_maker_textdomain). '</p>';
			die();
		}
		
		if( empty( $ads_id ) || empty( $input_reason ) || empty( $input_message ) ) {
			echo '<p class="report_screen_notice" style="color:#C13C31;">' . __('Something went wrong!', classified_maker_textdomain). '</p>';
			die();
		}
		
		$Report_post_ID = wp_insert_post( 
			array(
				'post_title'	=> 'Report On# '. get_the_title( $ads_id ),
				'post_type'		=> 'reports',
				'post_status'	=> 'publish',
				'post_author'   => get_current_user_id(),
			)
		);
		
		if( !empty( $Report_post_ID ) ) {
		
			update_post_meta( $Report_post_ID, 'input_reason', $input_reason );
			update_post_meta( $Report_post_ID, 'input_message', $input_message );
			update_post_meta( $Report_post_ID, 'ads_id', $ads_id );
			
			echo sprintf(
				'<p class="report_screen_notice" style="color:#16A05C;">%s <strong><i>%s</i></strong></p>',
				__('You just Reported successfully', classified_maker_textdomain),
				get_the_title( $ads_id )
			);
			die();
		}
		
		echo '<p class="report_screen_notice" style="color:#C13C31;">' . __('Something went wrong!', classified_maker_textdomain). '</p>';
		die();
	}
	add_action('wp_ajax_classified_maker_ajax_report_ads', 'classified_maker_ajax_report_ads');
	add_action('wp_ajax_nopriv_classified_maker_ajax_report_ads', 'classified_maker_ajax_report_ads');

	
	
	function classified_maker_ajax_company() {
		
		$search = strip_tags(trim($_GET['q'])); 
		
		$data = array();
		
		
		$wp_query = new WP_Query ( array (
			'post_type' => 'company',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			's' => "$search",
		));
		
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
			$data[] = array('id' => get_the_ID() , 'text' => get_the_title() );
			
		
		endwhile;
		wp_reset_query();
		endif;
		
	
		echo json_encode( $data );
		
		die();
}
add_action('wp_ajax_classified_maker_ajax_company', 'classified_maker_ajax_company');
add_action('wp_ajax_nopriv_classified_maker_ajax_company', 'classified_maker_ajax_company');


// Replace your Title Column with the Existing one //
function replace_title_column($columns) {

    $new = array();

    foreach($columns as $key => $title) {
        if ($key=='title') 
        $new['new-title'] = 'New Title'; // Our New Colomn Name
        $new[$key] = $title;
    }

    unset($new['title']); 
    return $new;
}

// Replace the title with your custom title
function replace_title_products($column_name, $post_ID) {
    if ($column_name == 'new-title') {
		
		$get_post_status = get_post_status(get_the_ID());
		
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
		
		if(!empty($thumb['0'])){
			$thumb_url = $thumb['0'];
			}

		else{
			$thumb_url = classified_maker_plugin_url.'assets/front/images/thumb.png';
			
			}
		
		echo '<img style="vertical-align:top;" width="40" height="40" src="'.$thumb_url.'" /> ';	
		
		
       // $oldtitle = '<a href="'.get_edit_post_link(get_the_ID()).'">'.get_the_title().'</a>';
       // $newtitle = str_replace(array("<span class='sub-title'>", "</span>"), array("", ""),$oldtitle);
       // $title = esc_attr($newtitle); 
	   
        echo '<strong><a class="row-title" href="'.get_edit_post_link(get_the_ID()).'">'.get_the_title().'</a> ';
		
		if($get_post_status!= 'publish'){
			echo '— '.ucfirst($get_post_status);
			}
		
		echo '</strong>';
		
		
    }
}

add_filter('manage_ads_posts_columns', 'replace_title_column');
add_action('manage_ads_posts_custom_column', 'replace_title_products', 10, 2);









function classified_maker_ads_posts_thumb_column( $columns ) {
    return array_merge( $columns, 
        array( 'thumb' => __( 'Thumb', 'classified_maker' ) ) );
}
//add_filter( 'manage_ads_posts_columns' , 'classified_maker_ads_posts_thumb_column', 0 );


function ads_posts_shortcode_display( $column, $post_id ) {
    if ($column == 'thumb'){
		?>

        <?php		
		
    }
}

//add_action( 'manage_ads_posts_custom_column' , 'ads_posts_shortcode_display', 0, 2 );





function classified_maker_filter_post_ads_inputs_shortcode(){
	
	
	$class_classified_maker_functions = new class_classified_maker_functions();
	
	$post_type_input_fields = $class_classified_maker_functions->post_type_input_fields();
	
	echo '<pre>'.var_export($post_type_input_fields[0]['meta_fields']);
	
	}
add_shortcode('classified_maker_filter_post_ads_inputs','classified_maker_filter_post_ads_inputs_shortcode');


function classified_maker_filter_post_ads_inputs($input_fields){
	
			
		$meta_fields = $input_fields['meta_fields'];
		
		$new_meta_input = array(
		
								'classified_maker_new_input'=>array(
									'meta_key'=>'classified_maker_new_input',
									'css_class'=>'new_input',
									'placeholder'=>'',
									'title'=>__('New input', classified_maker_textdomain),
									'option_details'=>__('New input', classified_maker_textdomain),					
									'input_type'=>'text', // text, radio, checkbox, select,
									'input_values'=>'', // could be array
									//'field_args'=> array('size'=>'',),
									),
		
		
								);
	$new_meta = array_merge($meta_fields, $new_meta_input);						
	
	$input_fields['meta_fields'] = 	$new_meta;
	

	
	return $input_fields;
	
	}
	
//add_filter('classified_maker_filter_post_ads_inputs','classified_maker_filter_post_ads_inputs');















add_action('wp_ajax_photo_gallery_upload', function(){

  check_ajax_referer('photo-upload');

  // you can use WP's wp_handle_upload() function:
  $file = $_FILES['async-upload'];
  
  
//var_dump( $status);
  
  
  
  
  
  $status = wp_handle_upload($file, array('action' => 'photo_gallery_upload'));
//var_dump( $status);
  // and output the results or something...
  //echo 'Uploaded to: '.$status['url'];

  //Adds file as attachment to WordPress
/*

  echo "\n Attachment ID: " .wp_insert_attachment( array(
     'post_mime_type' => $status['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['name'])),
     'post_content' => '',
     'post_status' => 'inherit'
  ), $status['file']);

*/


		$file_loc = $status['file'];
		$file_name = basename($status['name']);
		$file_type = wp_check_filetype($file_name);
	
		$attachment = array(
			'post_mime_type' => $status['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['name'])),
			'post_content' => '',
			'post_status' => 'inherit'
		);
	
		$attach_id = wp_insert_attachment($attachment, $file_loc);
		$attach_data = wp_generate_attachment_metadata($attach_id, $file_loc);
		wp_update_attachment_metadata($attach_id, $attach_data);
		//echo $attach_id;
	
		$attach_title = get_the_title($attach_id);
	
		$html['attach_url'] = wp_get_attachment_url($attach_id);
		$html['attach_id'] = $attach_id;
		$html['attach_title'] = get_the_title($attach_id);	
	
		$response = array(
							'status'=>'ok',
							'html'=>$html,
							
							
							);
	
		echo json_encode($response);

  exit;
});











add_action('classified_maker_action_post_ads_save','classified_maker_action_post_ads_save_data');
	
	
function classified_maker_action_post_ads_save_data(){
	
		$class_classified_maker_functions = new class_classified_maker_functions();
		$post_type_input_fields = $class_classified_maker_functions->post_type_input_fields();
		$ads_posttype = $class_classified_maker_functions->ads_posttype();	
		$ads_taxonomy = $class_classified_maker_functions->ads_taxonomy();				
		
		$classified_maker_submitted_ads_status = get_option('classified_maker_submitted_ads_status');
		
		if(empty($classified_maker_submitted_ads_status)){
			$classified_maker_submitted_ads_status='pending';
			}
		
		//var_dump($_POST);
		$userid = get_current_user_id();
		
		$post_title = sanitize_text_field($_POST['post_title']);
		$post_content = sanitize_text_field($_POST['post_content']);
		$post_thumbnail_id = ($_POST['post_thumbnail']);					
		
		$ads_post_data = array(
		  'post_title'    => $post_title,
		  'post_content'  => $post_content,
		  'post_status'   => $classified_maker_submitted_ads_status,
		  'post_type'   => $ads_posttype,
		  'post_author'   => $userid,
		);
		
		// Insert the post into the database
		//wp_insert_post( $my_post );
		$ads_ID = wp_insert_post($ads_post_data);
		
		//var_dump($post_thumbnail_id[0]);
		
		update_post_meta( $ads_ID, '_thumbnail_id', $post_thumbnail_id[0] );
		wp_set_post_terms( $ads_ID, $classified_maker_ads_category, $ads_taxonomy );
	
	

		
	
		$meta_fields = $post_type_input_fields[0]['meta_fields'];

	
		foreach($meta_fields as $field_key=>$field){

				
				if(!empty($_POST[$field_key])){
					
					if(is_array($_POST[$field_key])){
						$option_value = serialize($_POST[$field_key]);
						}
					else{
						$option_value = sanitize_text_field($_POST[$field_key]);
						}
					
					
					//var_dump($option_value);
					//$option_value = job_bm_sanitize_data($option_info['input_type'],$_POST[$option_key]);
					}
				else{
					$option_value = '';
					}

				
				
				//var_dump($option_value);
				
				update_post_meta($ads_ID, $field_key , $option_value);
				
				
			
			
			}
	
	
	
	
	
	
	}
	
	

add_action('classified_maker_action_post_ads_main','classified_maker_action_post_ads_field_set');
	
	
function classified_maker_action_post_ads_field_set(){
	
			$class_classified_maker_pickform = new class_classified_maker_pickform();		
		
			$class_classified_maker_functions = new class_classified_maker_functions();
			$post_type_input_fields = $class_classified_maker_functions->post_type_input_fields();
			
			
			$top_input_field['post_title'] = $post_type_input_fields[0]['post_title'];	
			$top_input_field['post_content'] = $post_type_input_fields[0]['post_content'];
			$top_input_field['post_thumbnail'] = $post_type_input_fields[0]['post_thumbnail'];
			$post_taxonomies = $post_type_input_fields[0]['post_taxonomies'];	
			$meta_fields = $post_type_input_fields[0]['meta_fields'];
			
			//var_dump($post_taxonomies);
			

			//var_dump($_POST);
			
			foreach($top_input_field as $key=>$field){
					
					//$field_type = $field['input_type'];
					?>
                    <div class="item">
                    <?php
					
					if(!empty($top_input_field[$key])){
						$output_html = $class_classified_maker_pickform->field_set($field);
						
						echo $output_html;
						}
					?>
                    </div>
                    <?php

				}			


			foreach($post_taxonomies as $taxonomie){
				
					$meta_key = $taxonomie['meta_key'];
					$trems = classified_maker_get_terms($meta_key);
					
					$taxonomie = array_replace($taxonomie, array('input_args'=>$trems));
					
					//$field_type = $field['input_type'];
					?>
                    <div class="item">
                    <?php
					$output_html = $class_classified_maker_pickform->field_set($taxonomie);
					echo $output_html;
					?>
                    </div>
                    <?php

				}


			foreach($meta_fields as $key=>$field){
					
					$field_type = $field['input_type'];
					?>
                    <div class="item">
                    <?php
					
					if(!empty($meta_fields[$key])){
						$output_html = $class_classified_maker_pickform->field_set($field);
						
						echo $output_html;
						
						}
					?>
                    </div>
                    <?php
					

				}

	}
	




	
function classified_maker_email_ads_published($ads_ID){
	
	$ads_data =get_post($ads_ID);
	global $current_user;
		$vars = array(
			'{site_name}'=> get_bloginfo('name'),
			'{site_description}' => get_bloginfo('description'),
			'{site_url}' => get_bloginfo('url'),						
			'{site_logo_url}' => get_option('classified_maker_logo_url'),
		  
			'{user_name}' => $current_user->display_name,						  
			'{user_avatar}' => get_avatar( $current_user->ID, 60 ),
			'{user_email}' => $current_user->user_email,
										
			'{ads_title}'  => $ads_data->post_title,						  			
			'{ads_url}'  => get_permalink($ads_ID),
			'{ads_edit_url}'  => get_admin_url().'post.php?post='.$ads_ID.'&action=edit',						
			'{ads_id}'  => $ads_ID,
			'{ads_content}'  => $ads_data->post_content,												

		);
	
	
	
		$admin_email = get_option('admin_email');
		$classified_maker_email_templates_data = get_option( 'classified_maker_email_templates_data' );
		
		
		if(empty($classified_maker_email_templates_data)){
			
			$class_classified_maker_emails = new class_classified_maker_emails();
			$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
			$classified_maker_email_templates_data = $templates_data;
			
			}
		else{

			$class_classified_maker_emails = new class_classified_maker_emails();
			$templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();

			$classified_maker_email_templates_data =array_merge($templates_data, $classified_maker_email_templates_data);
			
			}
	
		//$class_classified_maker_emails = new class_classified_maker_emails();
		//$classified_maker_email_templates_data = $class_classified_maker_emails->classified_maker_email_templates_data();
	
		$email_body = strtr($classified_maker_email_templates_data['new_ads_published']['html'], $vars);
		$email_subject =strtr($classified_maker_email_templates_data['new_ads_published']['subject'], $vars);
		
		// $headers = "";
		// $headers .= "From: ".get_option('classified_maker_from_email')." \r\n";
		// $headers .= "MIME-Version: 1.0\r\n";
		// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		// wp_mail($admin_email, $email_subject, $email_body, $headers);
	
	
	
	}

	// here is action hook
	add_action(  'publish_ads',  'classified_maker_email_ads_published');






	//add_action( 'transition_post_status', 'classified_maker_transition_post_status', 10, 3 );


	function classified_maker_transition_post_status($new_status, $old_status, $post) {
		if( 'publish' == $new_status && 'publish' == $old_status && $post->post_type == 'my_post_type' ) {
		
				//DO SOMETHING IF A POST IN POST TYPE IS EDITED
		
			}	
		}




	add_filter('post_row_actions', 'classified_maker_make_duplicate_link_row',10,2);

	function classified_maker_make_duplicate_link_row($actions, $post) {
			if($post->post_type == 'ads'){
				$classified_maker_edit_ads_page_id = get_option('classified_maker_edit_ads_page_id');
				$edit_page_url = get_permalink($classified_maker_edit_ads_page_id);
		
				$actions['edit_frontend'] = '<a href="'.$edit_page_url.'?ads_id='.$post->ID.'" title="">'.__('Frontend Edit',classified_maker_textdomain).'</a>';
				return $actions;
				}
			else{
				return $actions;
				}
	
		
	}










	function classified_maker_send_email_to_seller() {
		
		$ads_id = (int)$_POST['ads_id'];
		$email = sanitize_email($_POST['email']);		
		$name = sanitize_text_field($_POST['name']);		
		$phone = sanitize_text_field($_POST['phone']);		
		$message = sanitize_text_field($_POST['message']);
		$subject = 'Buyer query for your Ads #'.$ads_id;
		
		
		if(empty($name)){
			$data['error_name'] = '<span class="missed"><i class="fa fa-times"></i> '.__('Name is missing',classified_maker_textdomain).'</span>';
			}
			
		if(empty($email)){
			$data['error_email'] = '<span class="missed"><i class="fa fa-times"></i> '.__('Email address is missing',classified_maker_textdomain).'</span>';
			}
			
		if(empty($phone)){
			$data['error_phone'] = '<span class="missed"><i class="fa fa-times"></i> '.__('Phone is missing',classified_maker_textdomain).'</span>';
			}			
			
		if(empty($message)){
			$data['error_message'] = '<span class="missed"><i class="fa fa-times"></i> '.__('Message is missing',classified_maker_textdomain).'</span>';
			}					
			
		if(empty($data)){
			
			//$seller_email = get_post_meta($ads_id, 'classified_maker_ads_email', true);
			
			
			$ads_author_id = get_post_field( 'post_author', $ads_id );
			//$user = get_user_by( 'email', 'user@example.com' );
			$seller_email = get_the_author_meta( 'classified_maker_account_contact_email', $ads_author_id );
			
			$i = 0;
			foreach($seller_email as $email){
				
				$seller_email[$i] = $email;
				$i++;
				}
			
			$seller_email = $seller_email[0];
			
			
			
			$message = $message . '<br /><br /> <strong>Buyer Phone: </strong>'.$phone;
			
			
			$headers = '';
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "From:".$name.'<'. $email.'>'."\r\n";	
			
			if (mail($seller_email, $subject, stripslashes($message), $headers )){
					
					$data['success'] = '<span class="success"><i class="fa fa-check"></i> '.__('Message sent successfully.',classified_maker_textdomain).'</span>';
				} 
			else
				{
					$data['failed'] = '<span class="missed"><i class="fa fa-times"></i> '.__('Something went wrong with server.',classified_maker_textdomain).'</span>';	
				}
			
			
			
			
			
			}

			
		echo json_encode($data);
		
		die();
		}



	add_action('wp_ajax_classified_maker_send_email_to_seller', 'classified_maker_send_email_to_seller');
	add_action('wp_ajax_nopriv_classified_maker_send_email_to_seller', 'classified_maker_send_email_to_seller');


	
	function classified_maker_see_phone_number() {
		
		
		$ads_id = (int)$_POST['ads_id'];
		$classified_maker_ads_phone = get_post_meta($ads_id, 'classified_maker_ads_phone', true);
		
		$classified_maker_ads_phone = unserialize($classified_maker_ads_phone);
			
		//var_dump($classified_maker_ads_phone);
			
		if(!empty($classified_maker_ads_phone)){
			
			foreach($classified_maker_ads_phone as $number){
				
				echo '<a href="tel:'.$number.'">'.$number.'</a>';
				}
			}
		
		else{
			
			$ads_author_id = get_post_field( 'post_author', $ads_id );
			//$user = get_user_by( 'email', 'user@example.com' );
			$phone_number = get_the_author_meta( 'classified_maker_account_contact_phone', $ads_author_id );
			
			//$i = 0;
			foreach($phone_number as $phone){
				
				echo '<a href="tel:'.$phone.'">'.$phone.'</a>';
				//$phone_number[$i] = $phone;
				//$i++;
				}
			
			
			//echo $phone_number[0];
			
			}
		
			
			
		//$phone_number = get_post_meta($ads_id, 'classified_maker_ads_phone', true);
		

		
		die();
		}

	add_action('wp_ajax_classified_maker_see_phone_number', 'classified_maker_see_phone_number');
	add_action('wp_ajax_nopriv_classified_maker_see_phone_number', 'classified_maker_see_phone_number');




	function classified_maker_ajax_delete_ads() {
		
		$html = '';
		
		$ads_id = (int)$_POST['ads_id'];

		$current_user_id = get_current_user_id();
		
		$post_data = get_post($ads_id, ARRAY_A);

		$author_id = $post_data['post_author'];		
	
		if( $current_user_id == $author_id ) {
			
			if(wp_delete_post($ads_id)){
				$html.=	__('Ads deleted.',classified_maker_textdomain);
				}
			else{
				$html.=	__('Something going wrong.',classified_maker_textdomain);
				}
			}
			
		else{
			
			$html.=	__('You are not authorized to delete this ads.',classified_maker_textdomain);
			}
		
		echo $html;
		
		die();
		}

	add_action('wp_ajax_classified_maker_ajax_delete_ads', 'classified_maker_ajax_delete_ads');
	add_action('wp_ajax_nopriv_classified_maker_ajax_delete_ads', 'classified_maker_ajax_delete_ads');








	function classified_maker_post_duration($post_id) {

		$post_time = get_post_time();
		$today = time();		
		
		//var_dump($post_time);
		
		
		$diff = $today - $post_time;
		
		$minute = floor(($diff % 3600)/60);
		$hour = floor(($diff % 86400)/3600);
		$day = floor(($diff % 2592000)/86400);
		$month = floor($diff/2592000);
		$year = floor($diff/(86400*365));		
		
		if($year>0){
			return number_format_i18n($year) .' '.__('year ago',classified_maker_textdomain);
			}
				
		elseif($month > 0 && $day<=12 ){
			return number_format_i18n($month) .' '.__('month ago',classified_maker_textdomain);
			}
			
		elseif($day > 0 && $day<=30){
			return number_format_i18n($day).' '.__('day ago',classified_maker_textdomain);
			}
			
		elseif($hour > 0 && $hour<=24){
			return number_format_i18n($hour).' '.__('hour ago',classified_maker_textdomain);
			}		
			
		elseif($minute > 0 && $minute<60){
			return number_format_i18n($minute).' '.__('minute ago',classified_maker_textdomain);
			}	
				
		else{
			return $diff.' second ago';
			}
		
	}

	






	function classified_maker_single_ads_template($single_template) {
		 global $post;
	
		 if ($post->post_type == 'ads') {
			  $single_template = classified_maker_plugin_dir . 'templates/single-ads.php';
		 }
		 return $single_template;
	}
	add_filter( 'single_template', 'classified_maker_single_ads_template' );


	function classified_maker_category_ads_template($single_template) {
		 global $post;
	
		 if ($post->post_type == 'ads' && is_archive('ads_cat')) {
			  $single_template = classified_maker_plugin_dir . 'templates/ads-category.php';
		 }
		 
		 return $single_template;
	}
	add_filter( 'archive_template', 'classified_maker_category_ads_template' );






	function classified_maker_page_list_ids()
		{	
			$wp_query = new WP_Query(
				array (
					'post_type' => 'page',
					'posts_per_page' => -1,
					) );
					
			$pages_ids = array();
					
			if ( $wp_query->have_posts() ) :
			
	
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$pages_ids[get_the_ID()] = get_the_title();
			
			
			endwhile;
			wp_reset_query();
			endif;
			
			
			return $pages_ids;
		
		}








/*

function hide_publish_metabox() {
    $post_types = array('ads');

    if( ! empty( $post_types ) ) {
        foreach( $post_types as $type ) {
            remove_meta_box( 'submitdiv', $type, 'side' );
        }
    }
}
add_action( 'do_meta_boxes', 'hide_publish_metabox' );

*/

function classified_maker_get_cookie_value($cookie_name){
	
	
		if(isset($_COOKIE[$cookie_name])){
			$cookie_value = $_COOKIE[$cookie_name];
			}
		else{
			$cookie_value = '';
			}
			
		return $cookie_value;
	}
	
	
function classified_maker_get_child_cats(){

		$html = '';
		$cat_id = (int)$_POST['cat_id'];
		
		$taxonomy = 'ads_cat';
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'child_of'  => $cat_id,
		  );
		
		$categories = get_categories($args);

		//var_dump();
		
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
				$name = $category->name;
				$cat_ID = $category->cat_ID;	
		
					$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name.'</li>';
	
				}
			
			}
		
		

		
		
		echo $html;
		
		
		die();
		
	}





add_action('wp_ajax_classified_maker_get_child_cats', 'classified_maker_get_child_cats');
add_action('wp_ajax_nopriv_classified_maker_get_child_cats', 'classified_maker_get_child_cats');



function classified_maker_get_terms($taxonomy){

		
		//$cat_id = (int)$_POST['cat_id'];
		if(!isset($taxonomy)){
			$taxonomy = 'ads_cat';
			}
		
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  );
		
		$categories = get_categories($args);

			
		$html = '';

		foreach($categories as $category){
			
				$name = $category->name;
				$cat_ID = $category->cat_ID;	
			
				$terms[$cat_ID] = 	$name;	
				//$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name;
				//$html.= '</li>';
				
			
			
			}
		
		
		return $terms;
		
		
		
		
	}









function classified_maker_delete_attachment(){

		
		$attach_id = (int)$_POST['attach_id'];
		
		if(is_user_logged_in()){
	
			$current_user_id = get_current_user_id();
			$post_data = get_post($attach_id, ARRAY_A);

			$author_id = $post_data['post_author'];
			
			if( $current_user_id == $author_id ) {
				
				
				$cookie_name = 'classified_maker_ads_thumbs';
				
					if(isset($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						$attach_ids = explode(',',$attach_ids);
						
						if(($key = array_search($attach_id, $attach_ids)) !== false) {
						unset($attach_ids[$key]);
						$cookie_value = implode(',',$attach_ids);
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
						
						$html =  $cookie_value;
						}
						
						
					}
				
				
				
				
				wp_delete_attachment( $attach_id );
				
				
				
				
				
				
				}
			else{
				
				$html = __('You are not authorized',classified_maker_textdomain);
				}
			
			
			}



		echo $html;
		
		
		die();
		
	}


add_action('wp_ajax_classified_maker_delete_attachment', 'classified_maker_delete_attachment');
add_action('wp_ajax_nopriv_classified_maker_delete_attachment', 'classified_maker_delete_attachment');





