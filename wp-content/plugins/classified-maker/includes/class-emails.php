<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_emails{
	
	public function __construct(){


	

		}
		
		
		
	public function classified_maker_send_email($to_email='', $email_subject='', $email_body='', $attachments=''){
		
		// $classified_maker_from_email = get_option('classified_maker_from_email');
		
		// var_dump( $classified_maker_from_email );
		
		
		// $headers = "";
		// $headers .= "From: ".$classified_maker_from_email." \r\n";
		// $headers .= "MIME-Version: 1.0\r\n";
		// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		// $status = wp_mail($to_email, $email_subject, $email_body, $headers, $attachments);
		
		// return $status;
		
		}	
		
		
		
		
		

	public function classified_maker_email_templates_data(){
		
		include( 'emails-templates/new_ads_submitted.php');	
		include( 'emails-templates/new_ads_published.php');
		include( 'emails-templates/ads_update.php');				
		
		$templates_data = array(
							
			'new_ads_submitted'=>array(	'name'=>__('New Ads Submitted','classified_maker'),
										'subject'=>__('New Ads Submitted - {site_url}','classified_maker'),
										'html'=>$templates_data_html['new_ads_submitted'],
						
									),
									
			'new_ads_published'=>array(	'name'=>__('New Ads Published','classified_maker'),
										'subject'=>__('New Ads Published - {site_url}','classified_maker'),
										'html'=>$templates_data_html['new_ads_published'],
						
									),	
									
			'ads_update'=>array( 'name'=>__('Ads Update','classified_maker'),
										'subject'=>__('Ads Update - {site_url}','classified_maker'),
										'html'=>$templates_data_html['ads_update'],
						
									),									
		);
		
		$templates_data = apply_filters('classified_maker_filters_email_templates_data', $templates_data);
		
		return $templates_data;

		}
		


	public function classified_maker_email_templates_parameters(){
		
		
			$parameters['site_parameter'] = array(
												'title'=>__('Site Parameters','classified_maker'),
												'parameters'=>array('{site_name}','{site_description}','{site_url}','{site_logo_url}'),										
												);
												
			$parameters['user_parameter'] = array(
												'title'=>__('Users Parameters','classified_maker'),
												'parameters'=>array('{user_name}','{user_avatar}','{user_email}'),										
												);	
												
			$parameters['ads_parameter'] = array(
												'title'=>__('Ads Parameters','classified_maker'),
												'parameters'=>array('{ads_id}','{ads_edit_url}','{ads_title}','{ads_shortcontent}','{ads_url}'),										
												);										
																
		
												
			$parameters = apply_filters('classified_maker_emails_templates_parameters',$parameters);
		
		
			return $parameters;
		
		}
	
		
		
		
		
		

	}
	
new class_classified_maker_emails();