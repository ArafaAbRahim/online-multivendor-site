<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_shortcodes_account{
	
    public function __construct(){
		
		add_shortcode( 'classified_maker_my_account', array( $this, 'classified_maker_my_account_display' ) );	
		add_shortcode( 'classified_maker_edit_account', array( $this, 'classified_maker_edit_account_display' ) );
		add_shortcode( 'classified_maker_my_ads', array( $this, 'classified_maker_my_ads_display' ) );		
		add_shortcode( 'classified_maker_my_wishlist', array( $this, 'classified_maker_my_wishlist_display' ) );		
		
			

   		}
		


	public function classified_maker_my_ads_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
		
					'themes' => 'flat',
					), $atts);
					
		$html = '';	
		
		if ( is_user_logged_in() ){
	
			$userid = get_current_user_id();
		
						
					
		$classified_maker_post_per_page = get_option('classified_maker_post_per_page');
		if(empty($classified_maker_post_per_page)){$classified_maker_post_per_page = 10; }
					
		$classified_maker_edit_ads_page_id = get_option('classified_maker_edit_ads_page_id');
		$edit_page_url = get_permalink($classified_maker_edit_ads_page_id);			
					
		$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
		$account_page_url = get_permalink($classified_maker_account_page_id);			
		
		$classified_maker_submit_ads_page_id = get_option('classified_maker_submit_ads_page_id');
		$submit_ads_page_url = get_permalink($classified_maker_submit_ads_page_id);			
		
		
		$html .= '<div class="my-ads">';
		
		if(!empty($_GET['delete_ads'])){
			
			$html .= '<div class="delete-ads">';
		

			
			$html.=	'</div>'; // .delete-ads		
			
			}
		
		
		

		
			if ( get_query_var('paged') ) {
			
				$paged = get_query_var('paged');
			
			} elseif ( get_query_var('page') ) {
			
				$paged = get_query_var('page');
			
			} else {
			
				$paged = 1;
			}
			
			
		$wp_query = new WP_Query(
			array (
				'post_type' => 'ads',
				'post_status' => 'any',
				'orderby' => 'Date',
				'order' => 'DESC',
				'author' => $userid,
				'posts_per_page' => $classified_maker_post_per_page,
				'paged' => $paged,
				
				) );
				
				
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();		

			$post_date = get_the_date();
			$post_status = get_post_status ( get_the_ID() );
			//$post_date = date_i18n( get_option( 'date_format' ), strtotime( '11/15/1976' ) );

			$status_object = get_post_status_object($post_status);
			$post_status_label = $status_object->label;

		$html.=	'<div class="single">';		
		$html.=	'<div class="title">';
		$html.=	'#'.get_the_ID().' <a href="'.get_permalink().'">'.get_the_title().'</a>';	
		$html.=	'</div>'; // .title
		
		$html.=	'<div class="meta">';
		$html.=	'<span class="edit-link"><a target="_blank" href="'.$edit_page_url.'?ads_id='.get_the_ID().'"  title="">'.__('Edit',classified_maker_textdomain).'</a></span>';
		$html.=	'<span class="delete-ads" ads-id="'.get_the_ID().'">'.__('Delete',classified_maker_textdomain).'</span>';		




		//var_dump($post_status_label);

		$html.=	'<span>'.__('Status:',classified_maker_textdomain).' '.$post_status_label.'</span>';
		$html.=	'<span>'.__('Published:',classified_maker_textdomain).' '.$post_date.'</span>';
				
		$category = get_the_terms(get_the_ID(), 'ads_cat');
		if(!empty($category[0]->name)){
			
			$html.=	'<span>'.__('Category:',classified_maker_textdomain).' <a href="'.get_term_link($category[0]->term_id).'">'.$category[0]->name.'</a></span>';	
			}
			
		
		$html.=	'</div>'; // .meta		
		$html.=	'</div>'; // .single				
				
		endwhile;
				
		$html .= '<div class="paginate">';
		$big = 999999999; // need an unlikely integer
		$html .= paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $wp_query->max_num_pages
			) );

		$html .= '</div >';	

		wp_reset_query();
		
		else:
		
		$html .= sprintf(__('No ads found posted by you. <a href="%s">create first Ads</a>',classified_maker_textdomain),$submit_ads_page_url);
		
		endif;	
						
		$html .= '</div>';	
		
		}	
		
		
		return $html;			
	}

	public function classified_maker_my_account_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
		
					'themes' => 'flat',
					), $atts);
		
		
			
			$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
			$account_page_url = get_permalink($classified_maker_account_page_id);
			
			
			$class_classified_maker_functions = new class_classified_maker_functions();
			$my_account_options = $class_classified_maker_functions->my_account_options();

			$account_options = $my_account_options[0]['options'];
			
			$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
			$account_page_url = get_permalink($classified_maker_account_page_id);
			
			
			$classified_maker_login_enable = get_option('classified_maker_login_enable');	
			$classified_maker_registration_enable = get_option('classified_maker_registration_enable');
			$html = '';
			$html .= '<div class="classified-maker my-account">';
			
			if(is_user_logged_in()){
				
				$current_user_id = get_current_user_id();
				
				
				global $current_user;
				
				$html .= '<div class="welcome">'.__('Welcome',classified_maker_textdomain).' <b>'.$current_user->display_name.'</b>! <a href="'.wp_logout_url($account_page_url).'">'.__('Logout', classified_maker_textdomain).'</a></div>';

				
				
				if(isset($_GET['action']) && $_GET['action']=='edit'){
					$html .= do_shortcode('[classified_maker_edit_account]');
					}
				else{
					
					$html .= '<h3>'.__('Account info',classified_maker_textdomain).'</h3>';
					
					foreach($account_options as $key=>$option){
							
							
							$author_meta = get_the_author_meta( $key, $current_user_id );
							
							$html .= '<div class="meta '.$option['css_class'].'">';
							$html .= '<div class="title">'.$option['title'].'</div>';
							
							if($option['input_type']=='text-multi'){
								if(is_array($author_meta)){
									foreach($author_meta as $meta){
										
										$html .= '<div class="value">'.$meta.'</div>';
										}
									}
								else{
									$html .= '<div class="value">'.$author_meta.'</div>';
									}								
								}
							else{
								$html .= '<div class="value">'.$author_meta.'</div>';
								}
							
													
							
							//var_dump($key);
							$html .= '</div>';
						
						}
	
					//$html .= '<a href="'.$account_page_url.'?action=edit">'.__('Edit Account',classified_maker_textdomain).'</a>';
					
					
					
					//$html .= '<h3>'.__('My Ads',classified_maker_textdomain).'</h3>';
				//	$html .= do_shortcode('[classified_maker_my_ads]');
					
					//$html .= '<h3>'.__('My Wishlist Ads',classified_maker_textdomain).'</h3>';
					//$html .= do_shortcode('[classified_maker_my_wishlist]');
					
					
					
					
					
					}
				
				
					
				
							
				
				}
			else{
				$html .= '<div class="register">';
				$html .= '<h3>'.__('Register',classified_maker_textdomain).'</h3>';
				if($classified_maker_registration_enable=='yes'){
					$html .= do_shortcode('[classified_maker_registration_form]');
					}
					
				$html .= '</div>';
				
				$html .= '<div class="login">';
				$html .= '<h3>'.__('Login',classified_maker_textdomain).'</h3>';
				
				if($classified_maker_login_enable=='yes'){
					ob_start();
					wp_login_form();
					$html .= ob_get_clean();
					
					}

				$html .= '</div>';
				
				}
			
			$html .= '</div>';			
						
			

			return $html;
	
	
		}	
		






	public function classified_maker_edit_account_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'themes' => 'flat',
											
					), $atts);
	
			$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
			$account_page_url = get_permalink($classified_maker_account_page_id);
	

	
			$html = '';
			$html.= '<div class="classified-maker edit-account">';
			//$classified_maker_themes = $atts['themes'];
			

			
			
			
			
			$class_classified_maker_form = new class_classified_maker_form();
			
			$class_classified_maker_functions = new class_classified_maker_functions();
			$my_account_options = $class_classified_maker_functions->my_account_options();

			$account_options = $my_account_options[0]['options'];
			
			
			if ( is_user_logged_in() ) 
				{
					$current_user_id = get_current_user_id();
				}
				
			
			
			
			//sanitize_text_field( $_POST[$value] );
			
			//$first_name = get_the_author_meta( 'first_name', $current_user_id );
			//update_user_meta( $current_user_id, 'first_name' , 'Hello' );
			
			//var_dump($first_name);
				
			//var_dump($_POST);

			
			
			
			if(isset($_POST['class_classified_hidden'])){

				//var_dump($_POST);
				foreach($account_options as $key=>$option){
		
						//var_dump($key);
						update_user_meta( $current_user_id, $key , stripslashes_deep($_POST[$key]) );
					
					}

				}
			
			
			

			
			//var_dump($meta_fields_saved_values);
			
			
			$html.= '<form id="" enctype="multipart/form-data"   method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">';

			$html.= '<input type="hidden" name="class_classified_hidden" value="Y">';	
			
			
			$html .= '<h3>'.__('Edit Account',classified_maker_textdomain).'</h3>';
			//var_dump($_POST);
		
			$html.= '<div class="meta-data">';
			
			
			
			foreach($account_options as $key=>$option){
				
				$author_meta_value = get_the_author_meta( $key, $current_user_id );
				
				$option = array_replace($option, array('input_values'=>$author_meta_value));
				
				$html.= $class_classified_maker_form->author_settigns_form_input($option);
				
				}
		
			
			
				

			$html.= '</div>';			
		
			$html.= '<input class="post-ads-submit" type="submit" value="'.__('Save Account',classified_maker_textdomain).'" />';

			if(isset($_POST['class_classified_hidden'])){
				
				$html.= '<p class="message"><i class="fa fa-check"></i> '.__('Account saved',classified_maker_textdomain).'</p>';

				}
				
				//$html.= '<p class="message"><a href="'.$account_page_url.'">Back to Account</a></p>';				
				

			$html.= '</form>';
			
			$html.= '</div>';			
			

			return $html;
	
	
		}


		public function classified_maker_my_wishlist_display($atts, $content = null ) {
			
			$atts = shortcode_atts(	array( 'themes' => 'flat' ), $atts);
			$html = '';
			
			global $wpdb;
			$wishlist_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.classified_maker_wishlist_table_name ." WHERE user_id=".get_current_user_id() );
			
			// echo '<pre>'; print_r( $wishlist_items ); echo '</pre>';
			
			$html .= '<div class="my-wishlist">';
			
			$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
			$user_id = get_current_user_id();
			$limit = 5;
			$offset = ( $pagenum - 1 ) * $limit;
			$wishlist_items = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}classified_maker_wishlist WHERE user_id=$user_id ORDER BY id DESC LIMIT $offset, $limit" );

			foreach( $wishlist_items as $item ){
				
				$ads_title 		= get_the_title( $item->ads_id );
				$ads_permalink 	= get_the_permalink( $item->ads_id );
				$date_time 		= $item->date_time;
				
				$timeago = human_time_diff( mysql2date('U',$date_time), current_time('U') ) . ' ago';
				$date = mysql2date('Y/m/d',$date_time);
				
				$html .= '<div class="item" ads_id="'.$item->ads_id.'">';
				$html .= "<div class='cm_meta title'><a href='$ads_permalink'>$ads_title</a></div>";
				$html .= "<div class='cm_meta date_time'>$date - <b><i>$timeago</i></b></div>";
				$html .= "<div class='cm_meta remove'>Remove</div>";
				$html .= '</div>';
			}
			
			
			$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM {$wpdb->prefix}classified_maker_wishlist" );
			$num_of_pages = ceil( $total / $limit );
			$page_links = paginate_links( array(
				'base' => add_query_arg( 'pagenum', '%#%' ),
				'format' => '',
				'prev_text' => __( '&laquo; Previous', classified_maker_textdomain ),
				'next_text' => __( 'Next &raquo;', classified_maker_textdomain ),
				'total' => $num_of_pages,
				'current' => $pagenum
			) );
			 
			if ( $page_links ) {
				$html .= "<div class='paginate'>$page_links</div>";
			}


			$html .= '</div>';
			return $html;
		}


		


		
			
			
			
			
			
	}
	
	new class_classified_maker_shortcodes_account();