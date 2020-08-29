<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_shortcodes_dashboard{
	
    public function __construct(){
		
		add_shortcode( 'classified_maker_dashboard', array( $this, 'classified_maker_dashboard' ) );	
		
		
		add_filter('classified_maker_dashboard_account', array( $this, 'my_account_html' ));		
		add_filter('classified_maker_dashboard_my_wishlist', array( $this, 'my_wishlist_html' ));
		add_filter('classified_maker_dashboard_account_edit', array( $this, 'edit_account_html' ));		
		add_filter('classified_maker_dashboard_my_ads', array( $this, 'my_ads_html' ));				

   		}
		
		
		
	
	function my_wishlist_html(){
		
		return do_shortcode('[classified_maker_my_wishlist]');
		
		}	
		
		
	function my_account_html(){
		
		return do_shortcode('[classified_maker_my_account]');
		
		}		
		
	function edit_account_html(){
		
		return do_shortcode('[classified_maker_edit_account]');
		
		}		
		
	function my_ads_html(){
		
		return do_shortcode('[classified_maker_my_ads]');
		
		}			
		
		
		
		
		
		

	function dashboard_tabs(){
		
		$tabs['account'] =array(
									'title'=>__('Account', classified_maker_textdomain),
									'html'=>apply_filters('classified_maker_dashboard_account',''),

								);
								
								
		$tabs['account_edit'] =array(
									'title'=>__('Account Edit', classified_maker_textdomain),
									'html'=>apply_filters('classified_maker_dashboard_account_edit',''),

								);	
								
		$tabs['my_ads'] =array(
									'title'=>__('My Ads', classified_maker_textdomain),
									'html'=>apply_filters('classified_maker_dashboard_my_ads',''),

								);	
								
		$tabs['my_wishlist'] =array(
									'title'=>__('My Wishlist', classified_maker_textdomain),
									'html'=>apply_filters('classified_maker_dashboard_my_wishlist',''),

								);									
										
															
		return apply_filters('classified_maker_dashboard_tabs',$tabs);					

		
		}









	public function classified_maker_dashboard($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
		
					'id' => 'flat',
					), $atts);
		
		ob_start();
		
				
		$classified_maker_account_page_id = get_option('classified_maker_account_page_id');
		
		$classified_maker_account_page_url = get_permalink($classified_maker_account_page_id);		
		
		
        ?>
        <div class="classified-maker dashboard">
        <?php
		
		
		if (is_user_logged_in() ):
		
		$dashboard_tabs = $this->dashboard_tabs();
		

        ?>
        <ul class="navs">
        <?php
     
		
		foreach($dashboard_tabs as $tabs_key=>$tabs){
			
			$title = $tabs['title'];
			$html = $tabs['html'];			
			
			
			?>
            <li>
                <a href="<?php echo $classified_maker_account_page_url; ?>?tabs=<?php echo $tabs_key; ?>">
                <?php echo $title; ?>
                </a>
            
            </li>
            <?php
			
			
			
			}
		?>
        </ul>
        <?php
		
		
		
		
		
        ?>
        <div class="navs-content">
        <?php
     
	 	if(!empty($_GET['tabs'])){
			$current_tabs = sanitize_text_field($_GET['tabs']);
			
			//echo '<pre>'.var_export($current_tabs, true).'</pre>';
			
			}
		else{
			$current_tabs = 'account';
			
			}
	 	
		
		foreach($dashboard_tabs as $tabs_key=>$tabs){
			
			$title = $tabs['title'];
			$html = $tabs['html'];			
			
			if($current_tabs==$tabs_key):
			
			?>
            <div class="<?php echo $tabs_key; ?>">
            <?php echo $html; ?>
            </div>
            <?php
			
			endif;
			
			
			}
		?>
        </div>
        <?php		
		
		
		
		
		
		
		
		
		
		
		
		
		else:
		
		
		
		
		
		endif;	
		
		?>
        </div>
        <?php	
		
		return ob_get_clean();			
	}




		


		
			
			
			
			
			
	}
	
	new class_classified_maker_shortcodes_dashboard();