<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_classified_maker_functions{
	
	public function __construct(){

	


		}


	public function submitted_ads_status(){
		
		$ads_status = array( 'draft'=>__('Draft', classified_maker_textdomain), 'pending'=>__('Pending', classified_maker_textdomain), 'publish'=>__('Published',classified_maker_textdomain), 'private'=>__('Private',classified_maker_textdomain), 'trash'=>__('Trash',classified_maker_textdomain));
		
		
		return apply_filters('classified_maker_filter_submitted_ads_status', $ads_status);
		
		}



	public function create_pages(){
		
		$page_data = array(
		
							array(
									'id'=>'classified_maker_submit_ads_page_id',		
									'title'=>__('Submit Ads',classified_maker_textdomain),
									'shortcode'=>'[classified_maker_post_ads]',							
									
									),
							array(
									'id'=>'classified_maker_edit_ads_page_id',		
									'title'=>__('Edit Ads',classified_maker_textdomain),
									'shortcode'=>'[classified_maker_edit_ads]',							
									
									),
							array(
									'id'=>'classified_maker_dashboard_page_id',
									'title'=>__('Dashboard',classified_maker_textdomain),
									'shortcode'=>'[classified_maker_dashboard]',							
									
									),						
							array(
									'id'=>'classified_maker_archive_page_id',
									'title'=>__('Ads Archive',classified_maker_textdomain),
									'shortcode'=>'[classified_maker_archive]',							
									
									)						
		
		);
																					
							
			$page_data = apply_filters( 'classified_maker_filter_create_pages', $page_data );
			
			return $page_data;			
		
		
		}



	public function tutorials(){

		$tutorials[] = array(
							'title'=>__('Classified Maker - How to install.',classified_maker_textdomain),
							'video_id'=>'4jwzy3MNKHA',
							'source'=>'youtube',
							);
							
		$tutorials[] = array(
							'title'=>__('Classified Maker - Settings.',classified_maker_textdomain),
							'video_id'=>'IzPYlIb6Bbk',
							'source'=>'youtube',
							);		
							
		$tutorials[] = array(
							'title'=>__('Classified Maker - How to publish Ads.',classified_maker_textdomain),
							'video_id'=>'YOfpn02C548',
							'source'=>'youtube',
							);								
		$tutorials[] = array(
							'title'=>__('Classified Maker - How to edit Ads.',classified_maker_textdomain),
							'video_id'=>'MzMovseYVcM',
							'source'=>'youtube',
							);								
							
							
												
							
		
		
		$tutorials = apply_filters('classified_maker_filters_tutorials', $tutorials);		

		return $tutorials;

		}	











	public function my_account_options($options = array()){

			$options[] = array(
								
								'title'=>__('General',classified_maker_textdomain),
								'description'=>'',								
								
								'options'=>array(

													'classified_maker_account_contact_phone'=>array(
														'key'=>'classified_maker_account_contact_phone',
														'css_class'=>'contact_phone',
														'placeholder'=>'',
														'title'=>__('Contact Phone Number', classified_maker_textdomain),
														'option_details'=>__('You can add multiple phone number, first number will display on ads page. you can sort number to change positions', classified_maker_textdomain),					
														'input_type'=>'text-multi', // text, radio, checkbox, select,
														'input_values'=>array(), // could be array
														'input_args'=>array('0'=>''),
														
														),								
								
								
								
													'classified_maker_account_contact_email'=>array(
														'key'=>'classified_maker_account_contact_email',
														'css_class'=>'contact_email',
														'placeholder'=>'',
														'title'=>__('Contact Email Address', classified_maker_textdomain),
														'option_details'=>__('Contact Email Address', classified_maker_textdomain),					
														'input_type'=>'text-multi', // text, radio, checkbox, select, wp_editor
														'input_values'=>'', // could be array
														),
														
													'classified_maker_account_address'=>array(
														'key'=>'classified_maker_account_address',
														'css_class'=>'account_address',
														'placeholder'=>'',
														'title'=>__('Address', classified_maker_textdomain),
														'option_details'=>__('Address', classified_maker_textdomain),					
														'input_type'=>'textarea', // text, radio, checkbox, select, wp_editor
														'input_values'=>'', // could be array
														),														
																							

												),								

								);


			
			$options = apply_filters( 'classified_maker_filter_my_account_options', $options );

			return $options;
		
		}






	public function contact_methods(){
		
			$classified_maker_ads_phone = get_post_meta(get_the_ID(), 'classified_maker_ads_phone', true);
		
		
			$phone_html = '<div ads-id="'.get_the_ID().'"  class="see-phone-number">';
			$phone_html.= '<i class="fa fa-phone" aria-hidden="true"></i>';			
			$phone_html.= '<span class="phone-number">'.__('Click to see phone number',classified_maker_textdomain).'</span>';
			//$phone_html.= '<span class="">'.$classified_maker_ads_phone.'</span>';			
			$phone_html.= '</div>';			
			
		
			$email_html = '<div  class="click-to-email">';
			$email_html.= '<i class="fa fa-paper-plane-o" ></i>';			
			$email_html.= '<span>'.__('Send Email',classified_maker_textdomain).'</span>';		
			$email_html.= '</div>';			
			
			$email_html.= '<div class="email-popup">';
			$email_html.= '<div class="container">';			
			$email_html.= '<p><strong>Name</strong><br /><input class="name" type="text" value="" /></p>';		
			$email_html.= '<p><strong>Email</strong><br /><input class="email" type="text" value="" /></p>';	
			$email_html.= '<p><strong>Phone</strong><br /><input class="phone" type="text" value="" /></p>';	
			$email_html.= '<p><strong>Message</strong><br /><textarea class="message"></textarea></p>';								
			$email_html.= '<p><input ads-id="'.get_the_ID().'" class="send-email" type="button" value="'.__('Send email',classified_maker_textdomain).'" /></p>';
			$email_html.= '<p class="status"></p>';					
			$email_html.= '</div>';						
			$email_html.= '</div>';	
			
			
		
		
			$methods = array(
							
							'phone'=>array(
											'title'=>'', //Call to seller
											'html'=>$phone_html,											
											),
											
							'email'=>array(
											'title'=>'', //Email to seller
											'html'=>$email_html,											
											),
							);
							
							
			$methods = apply_filters('classified_maker_filter_contact_methods',$methods);	
			
			
			return $methods;		
		}






	public function category_based_meta_display($meta = array()){
		
		$meta = array(
						'classified_maker_ads_location'=>array('title'=>__('Location',classified_maker_textdomain)),
						//'classified_maker_ads_city'=>array('title'=>__('City',classified_maker_textdomain)),	
						//'classified_maker_ads_region'=>array('title'=>__('Region',classified_maker_textdomain)),							
											
					);
				
					
		$meta = apply_filters('classified_maker_filter_category_based_meta',$meta);					
					
		return $meta;		
					
		
		}



	public function sidebar_widgets($widget = array()){


			/* Contact Seller */

			

			//$phone_html = '<a href="#">'.$classified_maker_ads_phone.'</a>';
			
			
			
			$price_html = '';
			$classified_maker_currency_symbol = get_option('classified_maker_currency_symbol');				
			if(empty($classified_maker_currency_symbol)){$classified_maker_currency_symbol = '$';}
			
			
			$classified_maker_ads_price = get_post_meta(get_the_ID(), 'classified_maker_ads_price', true);			
			
			//var_dump($classified_maker_currency_symbol);
			
			$price_html.= '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
			
			if(empty($classified_maker_ads_price)){
				
				$price_html.= __('Negotiable',classified_maker_textdomain);
				
				}
			else{
				$price_html.= '<span itemprop="priceCurrency" content="USD" >'.$classified_maker_currency_symbol.'</span><span itemprop="price" content="'.$classified_maker_ads_price.'">'.$classified_maker_ads_price.'</span>';
				}
				
			$price_html.= '</div>';
			
			

			$widget[10] = array(
							
							'title'=>__('Price',classified_maker_textdomain),
							'description'=>'',	
							'html'=>$price_html,														
							'css_class'=>'item-price',
							);			
			
			
			
			
			
			
			
			$contact_html = '';
			
			$contact_methods = $this->contact_methods();
			
			foreach($contact_methods as $key=>$method){
				
				$contact_html.= '<div class="contact '.$key.'">';
				
				$contact_html.= '<span>'.$method['title'].'</span>';
				$contact_html.= $method['html'];
							
				$contact_html.= '</div>';				
				
				}
			

			$widget[20] = array(
							
							'title'=>__('Contact Seller',classified_maker_textdomain),
							'description'=>'',	
							'html'=>$contact_html,														
							'css_class'=>'contact-seller',
							);



			/* Lcoation */
			$classified_maker_ads_location = get_post_meta(get_the_ID(), 'classified_maker_ads_location', true);
			//$classified_maker_ads_city = get_post_meta(get_the_ID(), 'classified_maker_ads_city', true);
			//$classified_maker_ads_region = get_post_meta(get_the_ID(), 'classified_maker_ads_region', true);
			
			$location_html= '<i class="fa fa-map-marker" ></i> ';
			
			if(!empty($classified_maker_ads_location)){
				$location_html.= '<a href="#">'.$classified_maker_ads_location.'</a>';
				}
			
/*

			if(!empty($classified_maker_ads_city)){
				$location_html.= ' » <a href="#">'.$classified_maker_ads_city.'</a>';
				}
			
			if(!empty($classified_maker_ads_region)){		
				$location_html.= ' » <a href="#">'.$classified_maker_ads_region.'</a>';
			}

*/
		

			$widget[30] = array(
							
							'title'=>__('Location',classified_maker_textdomain),
							'description'=>'',	
							'html'=>$location_html,
							'css_class'=>'location',

							);



			/* Share Buttons */
			
			
			$html_share_buttons = '

				<a class="fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'"><i class="fa fa-facebook"></i></a>
				<a  class="twitter" target="_blank" href="https://twitter.com/intent/tweet?url='.get_permalink().'&text='.get_the_title().'"><i class="fa fa-twitter"></i></a>
				<a class="gplus" target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"><i class="fa fa-google-plus"></i></a>';
			
			$html_share_buttons = apply_filters('classified_maker_filter_share_buttons',$html_share_buttons);

			$widget[40] = array(
							
							'title'=>__('Share this ad',classified_maker_textdomain),
							'description'=>'',	
							'html'=>$html_share_buttons,														
							'css_class'=>'social-share',
							);

			
							
			/* Report */
			
			$report_ads_html = '
			<div id="report-ad">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '. __('Report',classified_maker_textdomain) . '
			</div>
			<div class="report_screen" ads_id="'.get_the_ID().'">
				<div class="report_screen_box">
					<span class="screen_close"><i class="fa fa-times"></i></span>
					<div class="screen_input">
						<p>'.__('Reason', classified_maker_textdomain ).'</p>
						<select class="input_reason" required">
							<option value="">'. __('Select a Reason', classified_maker_textdomain). '</option>';
							
							foreach( $this->reason_options() as $reason_options_slug => $reason_option ) {
								
								$report_ads_html .= '<option value="'.$reason_options_slug.'">'.$reason_option.'</option>';
							}
						
			$report_ads_html .= '</select>
					</div>
					
					<div class="screen_input">
						<p>'.__('Your Message', classified_maker_textdomain ).'</p>
						<textarea class="input_message" required placeholder="'.__('Write something in details', classified_maker_textdomain ).'"></textarea>
					</div>
					
					<div class="screen_input">
						<p><div class="report_submit">'.__('Submit', classified_maker_textdomain ).'</div></p>
					</div>
				</div>
			</div>';

            $current_user_id = get_current_user_id();

			if( $current_user_id == 0 || empty( $current_user_id ) ) {
				
				$redirect = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
				$report_ads_html = sprintf('You must <a href="%s"><strong><i>Login</i></strong></a> to report here.', wp_login_url($redirect) );
			}
			
			$widget[60] = array(
				'title'=>__('Report This Ad',classified_maker_textdomain),
				'description'=>'',	
				'html'=> apply_filters( 'classified_maker_filter_report_ads_form_elements', $report_ads_html ),
				'css_class'=>'report-ad',
			);
			
			
			$wishlist_ads_html = '<div class="btn_wishlist" ads_id="'.get_the_ID().'"><i class="fa fa-heart" aria-hidden="true"></i> '.__('Save',classified_maker_textdomain).'</div>';
			
			if( get_current_user_id() == 0 || empty( get_current_user_id() ) ) {
				
				$redirect = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
				$wishlist_ads_html = sprintf('You must <a href="%s"><strong><i>Login</i></strong></a> to add this product in wishlist.', wp_login_url($redirect) );
			}
			
			$widget[70] = array(
				'title'=>__('Add to Wishlist',classified_maker_textdomain),
				'description'=>'',
				'html'=> apply_filters( 'classified_maker_filter_wishlist_html', $wishlist_ads_html ),
				'css_class'=>'report-ad',
			);
			
			
			// Return Widgets Data
			// echo '<pre>'; print_r( $widget ); echo '</pre>';
			
			
			$widget = apply_filters('classified_maker_filter_widgets', $widget);
			asort($widget);
			return $widget;

	}

	public function reason_options(){
		
		return apply_filters( 'classified_maker_filter_reason_options', 
			array(
				'fraud' => "It seems to be Fraud", 
				'des-missing' => "Description Missing", 
				'non-clear-image' => "Images are not Clear", 
			)
		);
	}

	public function setings_options($options = array()){

			$options[] = array(
								
								'title'=>__('General',classified_maker_textdomain),
								'description'=>'',								
								
								'options'=>array(

													'classified_maker_post_per_page'=>array(
														'key'=>'classified_maker_post_per_page',
														'css_class'=>'post_per_page',
														'placeholder'=>'20',
														'title'=>__('Post Per page', classified_maker_textdomain),
														'option_details'=>__('Post Per page', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'20', // could be array
														),				
								
													'classified_maker_excerpt_word_count'=>array(
														'key'=>'classified_maker_excerpt_word_count',
														'css_class'=>'excerpt_word_count',
														'placeholder'=>'20',
														'title'=>__('Excerpt word count', classified_maker_textdomain),
														'option_details'=>__('Excerpt word count', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select, wp_editor
														'input_values'=>'', // could be array
														),									

													'classified_maker_enable_report'=>array(
														'key'=>'classified_maker_enable_report',
														'css_class'=>'enable_report',
														'placeholder'=>'20',
														'title'=>__('Enable Report', classified_maker_textdomain),
														'option_details'=>__('Enable Report on Each Ads', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select, wp_editor
														'input_values'=>'yes', // could be array
														'input_args'=> array('yes'=>__('Yes', classified_maker_textdomain),'no'=>__('No',classified_maker_textdomain)), // could be array	
													),									

								
/*

													'classified_maker_ads_category'=>array(
														'meta_key'=>'classified_maker_ads_category',
														'css_class'=>'ads_title',
														'placeholder'=>'',
														'title'=>__('Ads Category', classified_maker_textdomain),
														'option_details'=>__('Ads Category', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_cat_id'), // could be array
														),
													
													'classified_maker_ads_location'=>array(
														'meta_key'=>'classified_maker_ads_location',
														'css_class'=>'ads_title',
														'placeholder'=>'',
														'title'=>__('location', classified_maker_textdomain),
														'option_details'=>__('location', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_location'), // could be array
														),			
														
													'classified_maker_ads_city'=>array(
														'meta_key'=>'classified_maker_ads_city',
														'css_class'=>'ads_title',
														'placeholder'=>'',
														'title'=>__('City', classified_maker_textdomain),
														'option_details'=>__('City', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_city'), // could be array
														),		
														
																																
													'classified_maker_ads_thumbs'=>array(
														'meta_key'=>'classified_maker_ads_thumbs',
														'css_class'=>'ads_thumbs',
														'placeholder'=>'',
														'title'=>__('Images', classified_maker_textdomain),
														'option_details'=>__('Add some awesome images', classified_maker_textdomain),					
														'input_type'=>'upload', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_ads_thumbs'), // could be array
														),								
								

													
													'classified_maker_ads_price'=>array(
														'meta_key'=>'classified_maker_ads_price',
														'css_class'=>'ads_price',
														'placeholder'=>'20',
														'title'=>__('Price', classified_maker_textdomain),
														'option_details'=>__('Ads Price', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),

*/		

												),								

								);

			$options[] = array(
								
								'title'=>__('Permissions',classified_maker_textdomain),
								'description'=>'',								
								
								'options'=>array(

													'classified_maker_account_required_post_ads'=>array(
														'key'=>'classified_maker_account_required_post_ads',
														'css_class'=>'account_required_post_ads',
														'placeholder'=>'',
														'title'=>__('Account required to post ads', classified_maker_textdomain),
														'option_details'=>__('Account required to post ads', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('yes'=>__('Yes', classified_maker_textdomain),'no'=>__('No',classified_maker_textdomain)), // could be array	
														),				
								
													'classified_maker_registration_enable'=>array(
														'key'=>'classified_maker_registration_enable',
														'css_class'=>'registration_enable',
														'placeholder'=>'',
														'title'=>__('Registration enable', classified_maker_textdomain),
														'option_details'=>__('Registration enable on My Account Page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('yes'=>__('Yes', classified_maker_textdomain),'no'=>__('No',classified_maker_textdomain)), // could be array	
														),	
	
													'classified_maker_login_enable'=>array(
														'key'=>'classified_maker_login_enable',
														'css_class'=>'login_enable',
														'placeholder'=>'',
														'title'=>__('Login enable', classified_maker_textdomain),
														'option_details'=>__('Login enable on My Account Page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('yes'=>__('Yes', classified_maker_textdomain),'no'=>__('No',classified_maker_textdomain)), // could be array	
														),		

												),								

								);



			$options[] = array(
								
								'title'=>__('Pages',classified_maker_textdomain),
								'description'=>'',								
								
								//'taxonomy'=>array(),
								
								
								
								'options'=>array(

													'classified_maker_archive_page_id'=>array(
														'key'=>'classified_maker_archive_page_id',
														'css_class'=>'archive_page_id',
														'placeholder'=>'',
														'title'=>__('Archive page', classified_maker_textdomain),
														'option_details'=>__('Select archive page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> classified_maker_page_list_ids(), // could be array	
														),				
								
													'classified_maker_submit_ads_page_id'=>array(
														'key'=>'classified_maker_submit_ads_page_id',
														'css_class'=>'submit_ads_page_id',
														'placeholder'=>'',
														'title'=>__('Submit ads page', classified_maker_textdomain),
														'option_details'=>__('Select submit ads page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> classified_maker_page_list_ids(), // could be array	
														),
														
													'classified_maker_edit_ads_page_id'=>array(
														'key'=>'classified_maker_edit_ads_page_id',
														'css_class'=>'edit_ads_page_id',
														'placeholder'=>'',
														'title'=>__('Edit ads page', classified_maker_textdomain),
														'option_details'=>__('Select edit ads page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> classified_maker_page_list_ids(), // could be array	
														),														
														
														
/*

													'classified_maker_account_page_id'=>array(
														'key'=>'classified_maker_account_page_id',
														'css_class'=>'account_page_id',
														'placeholder'=>'',
														'title'=>__('Account page', classified_maker_textdomain),
														'option_details'=>__('Select Account page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> classified_maker_page_list_ids(), // could be array	
														),

*/														
															
														
													'classified_maker_dashboard_page_id'=>array(
														'key'=>'classified_maker_dashboard_page_id',
														'css_class'=>'dashboard_page_id',
														'placeholder'=>'',
														'title'=>__('Dashboard page', classified_maker_textdomain),
														'option_details'=>__('Select dashboard page', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> classified_maker_page_list_ids(), // could be array	
														),																
															
																		

												),								

								);


			$options[] = array(
								
								'title'=>__('Ads Posting',classified_maker_textdomain),
								'description'=>'',								
								
								'options'=>array(

													'classified_maker_reCAPTCHA_enable'=>array(
														'key'=>'classified_maker_reCAPTCHA_enable',
														'css_class'=>'reCAPTCHA_enable',
														'placeholder'=>'',
														'title'=>__('reCAPTCHA enable', classified_maker_textdomain),
														'option_details'=>__('reCAPTCHA enable', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('no'=>__('No',classified_maker_textdomain),'yes'=>__('Yes', classified_maker_textdomain),), // could be array	
														),				
								
													'classified_maker_reCAPTCHA_site_key'=>array(
														'key'=>'classified_maker_reCAPTCHA_site_key',
														'css_class'=>'reCAPTCHA_site_key',
														'placeholder'=>'',
														'title'=>__('reCAPTCHA site key', classified_maker_textdomain),
														'option_details'=>__('reCAPTCHA site key', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
														
													'classified_maker_reCAPTCHA_secret_key'=>array(
														'key'=>'classified_maker_reCAPTCHA_secret_key',
														'css_class'=>'reCAPTCHA_secret_key',
														'placeholder'=>'',
														'title'=>__('reCAPTCHA secret key', classified_maker_textdomain),
														'option_details'=>__('reCAPTCHA secret key', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),	
														
													'classified_maker_submitted_ads_status'=>array(
														'key'=>'classified_maker_submitted_ads_status',
														'css_class'=>'submitted_ads_status',
														'placeholder'=>'',
														'title'=>__('New Submitted Ads Status ?', classified_maker_textdomain),
														'option_details'=>__('New Submitted Ads Status ?', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> $this->submitted_ads_status(), // could be array	
														),
														
														
														
													'classified_maker_currency_symbol'=>array(
														'key'=>'classified_maker_currency_symbol',
														'css_class'=>'currency_symbol',
														'placeholder'=>'',
														'title'=>__('Currency symbol', classified_maker_textdomain),
														'option_details'=>__('Currency symbol', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
														
														
													'classified_maker_allow_edit_published_ads'=>array(
														'key'=>'classified_maker_allow_edit_published_ads',
														'css_class'=>'allow_edit_published_ads',
														'placeholder'=>'',
														'title'=>__('Can user edit published ads ?', classified_maker_textdomain),
														'option_details'=>__('Can user edit their published ads ?', classified_maker_textdomain),	
														'input_type'=>'select', // text, radio, checkbox, select,				
														'input_values'=> array(''), // could be array
														'input_args'=> array('no'=>__('No',classified_maker_textdomain),'yes'=>__('Yes', classified_maker_textdomain),), // could be array
														),	
														
														
													'classified_maker_display_category_meta'=>array(
														'key'=>'classified_maker_display_category_meta',
														'css_class'=>'category_meta',
														'placeholder'=>'',
														'title'=>__('Display category meta', classified_maker_textdomain),
														'option_details'=>__('Display category input field data.', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('no'=>__('No',classified_maker_textdomain),'yes'=>__('Yes', classified_maker_textdomain),), // could be array	
														),
														
														
														
														
														
														
														
																											
																																									
												),								

								);


			$options[] = array(
								
								'title'=>__('Email',classified_maker_textdomain),
								'description'=>'',								
								
								'options'=>array(
	
													'classified_maker_email_logo_url'=>array(
														'key'=>'classified_maker_email_logo_url',
														'css_class'=>'email_logo_url',
														'placeholder'=>'',
														'title'=>__('Email Logo URL', classified_maker_textdomain),
														'option_details'=>__('Email Logo URL', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),	
														
													'classified_maker_from_email'=>array(
														'key'=>'classified_maker_from_email',
														'css_class'=>'email_logo_url',
														'placeholder'=>'',
														'title'=>__('From Email', classified_maker_textdomain),
														'option_details'=>__('From Email', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
														
													'classified_maker_notify_email_ads_submit'=>array(
														'key'=>'classified_maker_notify_email_ads_submit',
														'css_class'=>'notify_email_ads_submit',
														'placeholder'=>'',
														'title'=>__('Notify email new ads submit ?', classified_maker_textdomain),
														'option_details'=>__('Notify email new ads submit ?', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array( 'no'=>__('No',classified_maker_textdomain), 'yes'=>__('Yes',classified_maker_textdomain)), // could be array	
														),														
														
														
													'classified_maker_notify_email_ads_publish'=>array(
														'key'=>'classified_maker_notify_email_ads_publish',
														'css_class'=>'notify_email_ads_publish',
														'placeholder'=>'',
														'title'=>__('Notify email new ads publish ?', classified_maker_textdomain),
														'option_details'=>__('Notify email new ads publish ?', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array( 'no'=>__('No',classified_maker_textdomain), 'yes'=>__('Yes',classified_maker_textdomain)), // could be array	
														),														
																																									
												),								

								);









			
			$options = apply_filters( 'classified_maker_filter_ads_meta_fields', $options );

			return $options;
		
		}



	public function meta_fields_data($options = array()){

			$options[] = array(
								
								'title'=>'',
								'description'=>'',								
								
								'meta_fields'=>array(

													'classified_maker_ads_title'=>array(
														'meta_key'=>'classified_maker_ads_title',
														'css_class'=>'ads_title',
														'placeholder'=>'Give me a Title',
														'required'=>'yes',														
														'title'=>__('Title', classified_maker_textdomain),
														'option_details'=>__('Ads Title', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),				
								
													'classified_maker_ads_content'=>array(
														'meta_key'=>'classified_maker_ads_content',
														'css_class'=>'ads_content',
														'placeholder'=>'Give a descriptions',
														'title'=>__('Descriptions', classified_maker_textdomain),
														'option_details'=>__('Ads Descriptions', classified_maker_textdomain),					
														'input_type'=>'wp_editor', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),									

/*

													'post_thumbnail'=>array(
														'meta_key'=>'post_thumbnail',
														'css_class'=>'post_thumbnail',
														'placeholder'=>'thumbnail',
														'title'=>__('Thumbnail', classified_maker_textdomain),
														'option_details'=>__('Ads Featured Image, uplaod single image only', classified_maker_textdomain),					
														'input_type'=>'file', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														),	
			


*/
													'classified_maker_ads_thumbs'=>array(
														'meta_key'=>'classified_maker_ads_thumbs',
														'css_class'=>'ads_thumbs',
														'placeholder'=>'',
														'title'=>__('Images', classified_maker_textdomain),
														'option_details'=>__('Add some awesome images', classified_maker_textdomain),					
														'input_type'=>'file', // text, radio, checkbox, select,
														'input_values'=>'', // could be array classified_maker_get_cookie_value('classified_maker_ads_thumbs')

														),	
								
								
								
													'classified_maker_ads_category'=>array(
														'meta_key'=>'classified_maker_ads_category',
														'css_class'=>'ads_title',
														'placeholder'=>'',
														'title'=>__('Ads Category', classified_maker_textdomain),
														'option_details'=>__('Ads Category', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_cat_id'), // could be array
														),
													
													'classified_maker_ads_location'=>array(
														'meta_key'=>'classified_maker_ads_location',
														'css_class'=>'ads_location',
														'placeholder'=>'',
														'title'=>__('Location', classified_maker_textdomain),
														'option_details'=>__('Your Location', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_location'), // could be array
														),			
														
/*

													'classified_maker_ads_city'=>array(
														'meta_key'=>'classified_maker_ads_city',
														'css_class'=>'ads_title',
														'placeholder'=>'',
														'title'=>__('City', classified_maker_textdomain),
														'option_details'=>__('City', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_city'), // could be array
														),	

													'classified_maker_ads_region'=>array(
														'meta_key'=>'classified_maker_ads_region',
														'css_class'=>'ads_region',
														'placeholder'=>'',
														'title'=>__('Region', classified_maker_textdomain),
														'option_details'=>__('Region', classified_maker_textdomain),
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),



*/	
														
													'classified_maker_ads_phone'=>array(
														'meta_key'=>'classified_maker_ads_phone',
														'css_class'=>'ads_phone',
														'placeholder'=>'',
														'title'=>__('Phone numbers', classified_maker_textdomain),
														'option_details'=>__('Phone numbers to contact.', classified_maker_textdomain),					
														'input_type'=>'text_multi', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),														
														
													'classified_maker_ads_address'=>array(
														'meta_key'=>'classified_maker_ads_address',
														'css_class'=>'ads_address',
														'placeholder'=>'',
														'title'=>__('Address', classified_maker_textdomain),
														'option_details'=>__('Your full address', classified_maker_textdomain),					
														'input_type'=>'textarea', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
														
														
													
													'classified_maker_ads_owner_type'=>array(
														'meta_key'=>'classified_maker_ads_owner_type',
														'css_class'=>'ads_owner_type',
														'placeholder'=>'',
														'title'=>__('Owner type', classified_maker_textdomain),
														'option_details'=>__('Owner type of this ads', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('personal'=>__('Personal', classified_maker_textdomain),'business'=>__('Business',classified_maker_textdomain)), // could be array	
														),													
													

													'classified_maker_listing_for'=>array(
														'meta_key'=>'classified_maker_listing_for',
														'css_class'=>'listing_for',
														'placeholder'=>'',
														'title'=>__('Listing for', classified_maker_textdomain),
														'option_details'=>__('Ads Listing for', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('sell'=>__('Sell', classified_maker_textdomain),'rent'=>__('Rent',classified_maker_textdomain),'job_post'=>__('Job Post', classified_maker_textdomain),'wanted'=>__('Wanted', classified_maker_textdomain)), // could be array														
														
														), 
													
													'classified_maker_ads_price'=>array(
														'meta_key'=>'classified_maker_ads_price',
														'css_class'=>'ads_price',
														'placeholder'=>'20',
														'title'=>__('Price', classified_maker_textdomain),
														'option_details'=>__('Item Price', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),		
													
													'classified_maker_ads_featured'=>array(
														'meta_key'=>'classified_maker_ads_featured',
														'css_class'=>'ads_featured',
														'placeholder'=>'20',
														'title'=>__('Featured', classified_maker_textdomain),
														'option_details'=>__('Featured listing ?', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('no'=>__('No',classified_maker_textdomain),'yes'=>__('Yes', classified_maker_textdomain)), // could be array	
														),				
														
		
		
		
		
		
		
		
		
													
													'classified_maker_ads_recaptcha'=>array(
														'meta_key'=>'classified_maker_ads_recaptcha',
														'css_class'=>'ads_recaptcha',
														'placeholder'=>'',
														'title'=>__('reCAPTCHA', classified_maker_textdomain),
														'option_details'=>__('reCAPTCHA test.', classified_maker_textdomain),					
														'input_type'=>'recaptcha', // text, radio, checkbox, select,
														'input_values'=> '', // could be array	
														),	
														
													
													
														
		/*												
		
													'classified_maker_ads_company'=>array(
														'meta_key'=>'classified_maker_ads_company',
														'css_class'=>'ads_company',
														'placeholder'=>'',
														'title'=>__('Company', classified_maker_textdomain),
														'option_details'=>__('Company', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
		
													'classified_maker_ads_phone'=>array(
														'meta_key'=>'classified_maker_ads_phone',
														'css_class'=>'ads_phone',
														'placeholder'=>'',
														'title'=>__('Phone', classified_maker_textdomain),
														'option_details'=>__('Phone Number', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),				
														
													'classified_maker_ads_email'=>array(
														'meta_key'=>'classified_maker_ads_email',
														'css_class'=>'ads_email',
														'placeholder'=>'',
														'title'=>__('Email', classified_maker_textdomain),
														'option_details'=>__('Email', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
		
		
		
		
		
		
		
											
													// Category mobile based input


														
														
														
														
														
														
														
														
														
														
														
														
														
														
														
														
													
													'classified_maker_ads_features'=>array(
														'meta_key'=>'classified_maker_ads_features',
														'css_class'=>'ads_features',
														'placeholder'=>'',
														'title'=>__('Features', classified_maker_textdomain),
														'option_details'=>__('Ads Features', classified_maker_textdomain),					
														'input_type'=>'checkbox', // text, radio, checkbox, select,
														'input_values'=>array(''), // could be array
														'input_args'=>array('camera'=>__('Camera',classified_maker_textdomain),'touce_screen'=>__('Touce Screen',classified_maker_textdomain)), // could be array														
														
														),													
													
													'classified_maker_ads_model'=>array(
														'meta_key'=>'classified_maker_ads_model',
														'css_class'=>'ads_model',
														'placeholder'=>'',
														'title'=>__('Model', classified_maker_textdomain),
														'option_details'=>__('Ads model', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),


*/																										
													
													),								
								
								
								);


			
			$options = apply_filters( 'classified_maker_filter_ads_meta_fields', $options );

			return $options;
		
		}
		
		
		
		
		

	public function post_type_input_fields(){
		
		
		
			$input_fields = array(
								
								'title'=>'',
								'description'=>'',
								'recaptcha'=>array(
														'meta_key'=>'recaptcha',
														'css_class'=>'recaptcha',
														'required'=>'yes', // (yes, no) is this field required.
														'display'=>'yes', // (yes, no)
														//'placeholder'=>'',
														'title'=>__('reCaptcha', classified_maker_textdomain),
														'option_details'=>__('reCaptcha test.', classified_maker_textdomain),					
														'input_type'=>'recaptcha', // text, radio, checkbox, select,
														'input_values'=>get_option('classified_maker_reCAPTCHA_site_key'), // could be array
														//'field_args'=> array('size'=>'',),
														),																		
								'post_title'=>array(
														'meta_key'=>'post_title',
														'css_class'=>'post_title',
														'placeholder'=>'Write Awesome Title Here',
														'required'=>'yes',
														'title'=>__('Ads Title', classified_maker_textdomain),
														'option_details'=>__('Ads Title Write Here', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														),
								'post_content'=>array(
														'meta_key'=>'post_content',
														'css_class'=>'post_content',
														'required'=>'yes',
														'placeholder'=>'',
														'title'=>__('Ads Content', classified_maker_textdomain),
														'option_details'=>__('Write Ads Content Here', classified_maker_textdomain),					
														'input_type'=>'wp_editor', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														),
														
													
														
														
														
								'post_thumbnail'=>array(
														'meta_key'=>'post_thumbnail',
														'css_class'=>'post_thumbnail',
														'placeholder'=>'thumbnail',
														'title'=>__('Thumbnail', classified_maker_textdomain),
														'option_details'=>__('Ads Featured Image, uplaod single image only', classified_maker_textdomain),					
														'input_type'=>'file', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														),								
								'post_taxonomies'=>array(	
								
														'ads_cat'=>array(
															'meta_key'=>'ads_cat',
															'css_class'=>'ads_cat',
															'placeholder'=>'ads_cat',
															'required'=>'yes',
															'title'=>__('Ads Category', classified_maker_textdomain),
															'option_details'=>__('Select Ads Category.', classified_maker_textdomain),					
															'input_type'=>'select', // text, radio, checkbox, select,
															'input_values'=>classified_maker_get_cookie_value('classified_maker_cat_id'), // could be array
															'input_args'=> classified_maker_get_terms('ads_cat'),
															//'field_args'=> array('size'=>'',),
															),
								
/*

														array(
															'meta_key'=>'ads_tag',
															'css_class'=>'ads_tag',
															'placeholder'=>'ads_tag',
															'title'=>__('Ads tags', classified_maker_textdomain),
															'option_details'=>__('Choose Ads Tags, you can select multiple.', classified_maker_textdomain),					
															'input_type'=>'select_multi', // text, radio, checkbox, select,
															'input_values'=>array(''), // could be array
															'input_args'=> classified_maker_get_terms('ads_tag'),
															//'field_args'=> array('size'=>'',),
															),

*/								

														),							
														
								'meta_fields'=>array(



													'classified_maker_ads_thumbs'=>array(
														'meta_key'=>'classified_maker_ads_thumbs',
														'css_class'=>'ads_gallery',
														'placeholder'=>'',
														'required'=>'no',														
														'title'=>__('Ads Gallery', classified_maker_textdomain),
														'option_details'=>__('Ads Gallery Images', classified_maker_textdomain),					
														'input_type'=>'file', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														),


													'classified_maker_ads_location'=>array(
														'meta_key'=>'classified_maker_ads_location',
														'css_class'=>'ads_location',
														'placeholder'=>'',
														'required'=>'yes',
														'title'=>__('Location', classified_maker_textdomain),
														'option_details'=>__('Your Location, City ex: California', classified_maker_textdomain),					
														'input_type'=>'hidden', // text, radio, checkbox, select,
														'input_values'=>classified_maker_get_cookie_value('classified_maker_location'), // could be array
														),	

		
													'classified_maker_ads_phone'=>array(
														'meta_key'=>'classified_maker_ads_phone',
														'css_class'=>'ads_phone',
														'placeholder'=>'',
														'required'=>'yes',
														'title'=>__('Phone numbers.', classified_maker_textdomain),
														'option_details'=>__('Phone numbers to contact.', classified_maker_textdomain),					
														'input_type'=>'text_multi', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),														
														
														
													'classified_maker_ads_address'=>array(
														'meta_key'=>'classified_maker_ads_address',
														'css_class'=>'ads_address',
														'placeholder'=>'',
														'required'=>'yes',
														'title'=>__('Address', classified_maker_textdomain),
														'option_details'=>__('Your full address', classified_maker_textdomain),					
														'input_type'=>'textarea', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),
														
														
													
													'classified_maker_ads_owner_type'=>array(
														'meta_key'=>'classified_maker_ads_owner_type',
														'css_class'=>'ads_owner_type',
														'placeholder'=>'',
														'required'=>'yes',
														'title'=>__('Owner type', classified_maker_textdomain),
														'option_details'=>__('Owner type of this ads', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('personal'=>__('Personal', classified_maker_textdomain),'business'=>__('Business',classified_maker_textdomain)), // could be array	
														),

								
													

													'classified_maker_listing_for'=>array(
														'meta_key'=>'classified_maker_listing_for',
														'css_class'=>'listing_for',
														'placeholder'=>'',
														'required'=>'yes',
														'title'=>__('Listing for', classified_maker_textdomain),
														'option_details'=>__('Ads Listing for', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('sell'=>__('Sell', classified_maker_textdomain),'rent'=>__('Rent',classified_maker_textdomain),'job_post'=>__('Job Post', classified_maker_textdomain),'wanted'=>__('Wanted', classified_maker_textdomain)), // could be array														
														
														), 
													
													'classified_maker_ads_price'=>array(
														'meta_key'=>'classified_maker_ads_price',
														'css_class'=>'ads_price',
														'placeholder'=>'20',
														'required'=>'yes',
														'title'=>__('Price', classified_maker_textdomain),
														'option_details'=>__('Item Price', classified_maker_textdomain),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														),		
													
													'classified_maker_ads_featured'=>array(
														'meta_key'=>'classified_maker_ads_featured',
														'css_class'=>'ads_featured',
														'placeholder'=>'20',
														'required'=>'yes',
														'title'=>__('Featured', classified_maker_textdomain),
														'option_details'=>__('Featured listing ?', classified_maker_textdomain),					
														'input_type'=>'select', // text, radio, checkbox, select,
														'input_values'=> array(''), // could be array
														'input_args'=> array('no'=>__('No',classified_maker_textdomain),'yes'=>__('Yes', classified_maker_textdomain)), // could be array	
														),				
														
		
													
/*

													'classified_maker_ads_recaptcha'=>array(
														'meta_key'=>'classified_maker_ads_recaptcha',
														'css_class'=>'ads_recaptcha',
														'placeholder'=>'',
														'title'=>__('reCAPTCHA', classified_maker_textdomain),
														'option_details'=>__('reCAPTCHA', classified_maker_textdomain),					
														'input_type'=>'recaptcha', // text, radio, checkbox, select,
														'input_values'=> '6Lf9rwsTAAAAAJKdFsmFJOAgXS1jLpbji6Z3hDa8', // could be array	
														),	

*/
														
		
		
		
		
		
		
		

													)
								);
	
		
		
		
		
		
		
		
		
		
			$input_fields = apply_filters( 'classified_maker_filter_post_ads_inputs', $input_fields );

			return $input_fields;
		
		
	}
	
		

	
	public function country_list($country_list = array()){

			$country_list = array(
								'AF' => 'Afghanistan',
								'AX' => 'Aland Islands',
								'AL' => 'Albania',
								'DZ' => 'Algeria',
								'AS' => 'American Samoa',
								'AD' => 'Andorra',
								'AO' => 'Angola',
								'AI' => 'Anguilla',
								'AQ' => 'Antarctica',
								'AG' => 'Antigua And Barbuda',
								'AR' => 'Argentina',
								'AM' => 'Armenia',
								'AW' => 'Aruba',
								'AU' => 'Australia',
								'AT' => 'Austria',
								'AZ' => 'Azerbaijan',
								'BS' => 'Bahamas',
								'BH' => 'Bahrain',
								'BD' => 'Bangladesh',
								'BB' => 'Barbados',
								'BY' => 'Belarus',
								'BE' => 'Belgium',
								'BZ' => 'Belize',
								'BJ' => 'Benin',
								'BM' => 'Bermuda',
								'BT' => 'Bhutan',
								'BO' => 'Bolivia',
								'BA' => 'Bosnia And Herzegovina',
								'BW' => 'Botswana',
								'BV' => 'Bouvet Island',
								'BR' => 'Brazil',
								'IO' => 'British Indian Ocean Territory',
								'BN' => 'Brunei Darussalam',
								'BG' => 'Bulgaria',
								'BF' => 'Burkina Faso',
								'BI' => 'Burundi',
								'KH' => 'Cambodia',
								'CM' => 'Cameroon',
								'CA' => 'Canada',
								'CV' => 'Cape Verde',
								'KY' => 'Cayman Islands',
								'CF' => 'Central African Republic',
								'TD' => 'Chad',
								'CL' => 'Chile',
								'CN' => 'China',
								'CX' => 'Christmas Island',
								'CC' => 'Cocos (Keeling) Islands',
								'CO' => 'Colombia',
								'KM' => 'Comoros',
								'CG' => 'Congo',
								'CD' => 'Congo, Democratic Republic',
								'CK' => 'Cook Islands',
								'CR' => 'Costa Rica',
								'CI' => 'Cote D\'Ivoire',
								'HR' => 'Croatia',
								'CU' => 'Cuba',
								'CY' => 'Cyprus',
								'CZ' => 'Czech Republic',
								'DK' => 'Denmark',
								'DJ' => 'Djibouti',
								'DM' => 'Dominica',
								'DO' => 'Dominican Republic',
								'EC' => 'Ecuador',
								'EG' => 'Egypt',
								'SV' => 'El Salvador',
								'GQ' => 'Equatorial Guinea',
								'ER' => 'Eritrea',
								'EE' => 'Estonia',
								'ET' => 'Ethiopia',
								'FK' => 'Falkland Islands (Malvinas)',
								'FO' => 'Faroe Islands',
								'FJ' => 'Fiji',
								'FI' => 'Finland',
								'FR' => 'France',
								'GF' => 'French Guiana',
								'PF' => 'French Polynesia',
								'TF' => 'French Southern Territories',
								'GA' => 'Gabon',
								'GM' => 'Gambia',
								'GE' => 'Georgia',
								'DE' => 'Germany',
								'GH' => 'Ghana',
								'GI' => 'Gibraltar',
								'GR' => 'Greece',
								'GL' => 'Greenland',
								'GD' => 'Grenada',
								'GP' => 'Guadeloupe',
								'GU' => 'Guam',
								'GT' => 'Guatemala',
								'GG' => 'Guernsey',
								'GN' => 'Guinea',
								'GW' => 'Guinea-Bissau',
								'GY' => 'Guyana',
								'HT' => 'Haiti',
								'HM' => 'Heard Island & Mcdonald Islands',
								'VA' => 'Holy See (Vatican City State)',
								'HN' => 'Honduras',
								'HK' => 'Hong Kong',
								'HU' => 'Hungary',
								'IS' => 'Iceland',
								'IN' => 'India',
								'ID' => 'Indonesia',
								'IR' => 'Iran, Islamic Republic Of',
								'IQ' => 'Iraq',
								'IE' => 'Ireland',
								'IM' => 'Isle Of Man',
								'IL' => 'Israel',
								'IT' => 'Italy',
								'JM' => 'Jamaica',
								'JP' => 'Japan',
								'JE' => 'Jersey',
								'JO' => 'Jordan',
								'KZ' => 'Kazakhstan',
								'KE' => 'Kenya',
								'KI' => 'Kiribati',
								'KR' => 'Korea',
								'KW' => 'Kuwait',
								'KG' => 'Kyrgyzstan',
								'LA' => 'Lao People\'s Democratic Republic',
								'LV' => 'Latvia',
								'LB' => 'Lebanon',
								'LS' => 'Lesotho',
								'LR' => 'Liberia',
								'LY' => 'Libyan Arab Jamahiriya',
								'LI' => 'Liechtenstein',
								'LT' => 'Lithuania',
								'LU' => 'Luxembourg',
								'MO' => 'Macao',
								'MK' => 'Macedonia',
								'MG' => 'Madagascar',
								'MW' => 'Malawi',
								'MY' => 'Malaysia',
								'MV' => 'Maldives',
								'ML' => 'Mali',
								'MT' => 'Malta',
								'MH' => 'Marshall Islands',
								'MQ' => 'Martinique',
								'MR' => 'Mauritania',
								'MU' => 'Mauritius',
								'YT' => 'Mayotte',
								'MX' => 'Mexico',
								'FM' => 'Micronesia, Federated States Of',
								'MD' => 'Moldova',
								'MC' => 'Monaco',
								'MN' => 'Mongolia',
								'ME' => 'Montenegro',
								'MS' => 'Montserrat',
								'MA' => 'Morocco',
								'MZ' => 'Mozambique',
								'MM' => 'Myanmar',
								'NA' => 'Namibia',
								'NR' => 'Nauru',
								'NP' => 'Nepal',
								'NL' => 'Netherlands',
								'AN' => 'Netherlands Antilles',
								'NC' => 'New Caledonia',
								'NZ' => 'New Zealand',
								'NI' => 'Nicaragua',
								'NE' => 'Niger',
								'NG' => 'Nigeria',
								'NU' => 'Niue',
								'NF' => 'Norfolk Island',
								'MP' => 'Northern Mariana Islands',
								'NO' => 'Norway',
								'OM' => 'Oman',
								'PK' => 'Pakistan',
								'PW' => 'Palau',
								'PS' => 'Palestinian Territory, Occupied',
								'PA' => 'Panama',
								'PG' => 'Papua New Guinea',
								'PY' => 'Paraguay',
								'PE' => 'Peru',
								'PH' => 'Philippines',
								'PN' => 'Pitcairn',
								'PL' => 'Poland',
								'PT' => 'Portugal',
								'PR' => 'Puerto Rico',
								'QA' => 'Qatar',
								'RE' => 'Reunion',
								'RO' => 'Romania',
								'RU' => 'Russian Federation',
								'RW' => 'Rwanda',
								'BL' => 'Saint Barthelemy',
								'SH' => 'Saint Helena',
								'KN' => 'Saint Kitts And Nevis',
								'LC' => 'Saint Lucia',
								'MF' => 'Saint Martin',
								'PM' => 'Saint Pierre And Miquelon',
								'VC' => 'Saint Vincent And Grenadines',
								'WS' => 'Samoa',
								'SM' => 'San Marino',
								'ST' => 'Sao Tome And Principe',
								'SA' => 'Saudi Arabia',
								'SN' => 'Senegal',
								'RS' => 'Serbia',
								'SC' => 'Seychelles',
								'SL' => 'Sierra Leone',
								'SG' => 'Singapore',
								'SK' => 'Slovakia',
								'SI' => 'Slovenia',
								'SB' => 'Solomon Islands',
								'SO' => 'Somalia',
								'ZA' => 'South Africa',
								'GS' => 'South Georgia And Sandwich Isl.',
								'ES' => 'Spain',
								'LK' => 'Sri Lanka',
								'SD' => 'Sudan',
								'SR' => 'Suriname',
								'SJ' => 'Svalbard And Jan Mayen',
								'SZ' => 'Swaziland',
								'SE' => 'Sweden',
								'CH' => 'Switzerland',
								'SY' => 'Syrian Arab Republic',
								'TW' => 'Taiwan',
								'TJ' => 'Tajikistan',
								'TZ' => 'Tanzania',
								'TH' => 'Thailand',
								'TL' => 'Timor-Leste',
								'TG' => 'Togo',
								'TK' => 'Tokelau',
								'TO' => 'Tonga',
								'TT' => 'Trinidad And Tobago',
								'TN' => 'Tunisia',
								'TR' => 'Turkey',
								'TM' => 'Turkmenistan',
								'TC' => 'Turks And Caicos Islands',
								'TV' => 'Tuvalu',
								'UG' => 'Uganda',
								'UA' => 'Ukraine',
								'AE' => 'United Arab Emirates',
								'GB' => 'United Kingdom',
								'US' => 'United States',
								'UM' => 'United States Outlying Islands',
								'UY' => 'Uruguay',
								'UZ' => 'Uzbekistan',
								'VU' => 'Vanuatu',
								'VE' => 'Venezuela',
								'VN' => 'Viet Nam',
								'VG' => 'Virgin Islands, British',
								'VI' => 'Virgin Islands, U.S.',
								'WF' => 'Wallis And Futuna',
								'EH' => 'Western Sahara',
								'YE' => 'Yemen',
								'ZM' => 'Zambia',
								'ZW' => 'Zimbabwe',
							);
			
			foreach(apply_filters( 'classified_maker_filter_country_list', $country_list ) as $country_key=> $country_name){
					$country_list[$country_key] = $country_name;
				}

			
			return $country_list;

		}	
		
		
		
	
	}
	
	//new class_classified_maker_functions();