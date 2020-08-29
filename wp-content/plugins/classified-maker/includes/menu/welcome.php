<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	?>


<?php

	$class_classified_maker_functions = new class_classified_maker_functions();
	$create_pages = $class_classified_maker_functions->create_pages();
	$setings_options = $class_classified_maker_functions->setings_options();	
	
	//var_dump($_POST);
	if(!empty($_GET['step'])){
		
		$step = $_GET['step'];
		}
	else{
		
		$step = 0;
		
		}
	
	
	if(!empty($_POST['classified_maker_hidden'])){
		
		

		
		if($step==1){
			
			update_option('classified_maker_post_per_page', $_POST['classified_maker_post_per_page']);
			update_option('classified_maker_excerpt_word_count', $_POST['classified_maker_excerpt_word_count']);			
			
			echo '<div class="updated"><p><strong>'.__('Options Saved', classified_maker_textdomain ).'</strong></p></div>';
			
			
			
			
			}
		elseif($step==2){
			
		foreach($create_pages as $pages){
			
				$userid = get_current_user_id();
				
				$page_title = $_POST[$pages['id']]['title'];
				$page_content = $_POST[$pages['id']]['shortcode'];			
				
				$page_args = array(
				  'post_title'    => $page_title,
				  'post_content'  => $page_content,
				  'post_status'   => 'publish',
				  'post_type'   => 'page',
				  'post_author'   => $userid,
				);

				$option = get_option($pages['id']);
				if(empty($option)){
					$page_id = wp_insert_post($page_args);
					update_option($pages['id'], $page_id);
					
					}
			}
			
			echo '<div class="updated"><p><strong>'.__('Page Created.', classified_maker_textdomain ).'</strong></p></div>';
			}
		
		elseif($step==3){
			
			update_option('classified_maker_account_required_post_ads', $_POST['classified_maker_account_required_post_ads']);
			update_option('classified_maker_registration_enable', $_POST['classified_maker_registration_enable']);
			update_option('classified_maker_login_enable', $_POST['classified_maker_login_enable']);
			
			//update_option('classified_maker_welcome_done', true);			
			echo '<div class="updated"><p><strong>'.__('Permissions Saved.', classified_maker_textdomain ).'</strong></p></div>';
			}		

		elseif($step==4){
			
			update_option('classified_maker_submitted_ads_status', $_POST['classified_maker_submitted_ads_status']);
			update_option('classified_maker_currency_symbol', $_POST['classified_maker_currency_symbol']);
			
			update_option('classified_maker_welcome_done', true);			
			echo '<div class="updated"><p><strong>'.__('Ads Posting Saved.', classified_maker_textdomain ).'</strong></p></div>';
			}		
		//$classified_maker_submit_ads_page_id = $_POST['classified_maker_submit_ads_page_id']['title'];
		
		}
	
?>


<div class="wrap classified-maker-admin welcome">

	<div id="icon-tools" class="icon32"><br></div>
    
	<h1><?php _e(sprintf('%s - Welcome',classified_maker_plugin_name), classified_maker_textdomain); ?></h1>
    
	<?php
    
	if($step==0){
		
		$url_parameter = '&step=1';
		$action_url = $_SERVER['REQUEST_URI'].'&step=1';
		$skip_button_url = $_SERVER['REQUEST_URI'].'&step=1';
		
		}
	elseif($step==1){
		
		$action_url = str_replace('step=1','step=2',$_SERVER['REQUEST_URI']);		
		$skip_button_url = str_replace('step=1','step=2',$_SERVER['REQUEST_URI']);
		
		}
	elseif($step==2){
		
		$action_url = str_replace('step=2','step=3',$_SERVER['REQUEST_URI']);		
		$skip_button_url = str_replace('step=2','step=3',$_SERVER['REQUEST_URI']);	
		
		}
	elseif($step==3){
		
		$action_url = str_replace('step=3','step=4',$_SERVER['REQUEST_URI']);		
		$skip_button_url = str_replace('step=3','step=4',$_SERVER['REQUEST_URI']);
		
		}		
			
	else{
		
		$action_url = '';		
		$skip_button_url = '';
		
		}		
	//var_dump($action_url);	
	//var_dump(str_replace('hello','','hello Worlds'));
	
	
	?>
    <div class="section save-options">
    
    
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $action_url); ?>">
            <input type="hidden" name="classified_maker_hidden" value="Y">
            <?php settings_fields( 'classified_maker_plugin_options' );
                    do_settings_sections( 'classified_maker_plugin_options' );
    
						
			
            
			
			if($step==0){
				
				$submit_button_text = __('Step 1: Save Options',classified_maker_textdomain);
							
				
				echo '<h3>'.__('#General Options', classified_maker_textdomain).'</h3>';
				
				
				echo '<div class="single">';
				echo '<div class="title">Post Per Page ?</div>';				
				echo '<input type="text" name="classified_maker_post_per_page" value="20" />';
				echo '</div>';				
				
				echo '<div class="single">';
				echo '<div class="title">Excerpt word count ?</div>';				
				echo '<input type="text" name="classified_maker_excerpt_word_count" value="20" />';
				echo '</div>';					
				
				}
			
			elseif($step==1){

				echo '<h3>'.__('#Create Pages', classified_maker_textdomain).'</h3>';

				$submit_button_text = __('Step 2: Create Pages',classified_maker_textdomain);

				foreach($create_pages as $pages){
	
					echo '<div class="single">';
					echo '<div class="title">'.$pages['title'].'</div>';
					echo '<input type="text" name="'.$pages['id'].'[title]" value="'.$pages['title'].'" />';
					echo '<input type="hidden" name="'.$pages['id'].'[shortcode]" value="'.$pages['shortcode'].'" />';
					//echo '<input type="hidden" name="'.$pages['id']['title'].'" value="'.$pages['id'].'" />';								
					
					echo '</div>';
					
					
					
					
					}
				
				}
			
			
			
			elseif($step==2){

				echo '<h3>'.__('#Save Permissions', classified_maker_textdomain).'</h3>';

				$submit_button_text = __('Step 3: Save Permissions',classified_maker_textdomain);
				
				echo '<div class="single">';
				echo '<div class="title">Account required to post ads ?</div>';	
							
				echo '<select name="classified_maker_account_required_post_ads">';
				echo '<option value="yes">Yes</option>';
				echo '<option value="no">No</option>';				
				echo '</select>';
								
				echo '</div>';	
				
				echo '<div class="single">';
				echo '<div class="title">Registration Enable on My Accoutn page ?</div>';	
							
				echo '<select name="classified_maker_registration_enable">';
				echo '<option value="yes">Yes</option>';
				echo '<option value="no">No</option>';				
				echo '</select>';
								
				echo '</div>';					
				
				echo '<div class="single">';
				echo '<div class="title">Registration Enable on My Accoutn page ?</div>';	
							
				echo '<select name="classified_maker_login_enable">';
				echo '<option value="yes">Yes</option>';
				echo '<option value="no">No</option>';				
				echo '</select>';
								
				echo '</div>';					

				}			
			
			
			elseif($step==3){

				echo '<h3>'.__('#Ads Posting', classified_maker_textdomain).'</h3>';

				$submit_button_text = __('Step 4: Ads Posting',classified_maker_textdomain);
				
				echo '<div class="single">';
				echo '<div class="title">New Submitted Ads Status ?</div>';	
							
				echo '<select name="classified_maker_submitted_ads_status">';
				echo '<option value="pending">Pending</option>';
				echo '<option value="publish">Publish</option>';
				echo '<option value="private">Private</option>';
				echo '<option value="draft">Draft</option>';												
				echo '</select>';
								
				echo '</div>';	
				
				echo '<div class="single">';
				echo '<div class="title">Currency Symbol ?</div>';	
							
				echo '<input type="text" name="classified_maker_currency_symbol" value="$" />';
								
				echo '</div>';					

				}			
						
			
			
			else{
				$submit_button_text = __('Nothing to Save',classified_maker_textdomain);
				echo '<div class="single">';
				echo '<div class="title">You are Awesome!</div>';	

								
				echo '</div>';	
				echo '<style type="text/css">';
				
				echo '.button.button-primary{display:none;}';
				echo '</style>';
				}
			
			

			
			?>
            
			<p class="submit">
				<input class="button button-primary" type="submit" name="Submit" value="<?php echo $submit_button_text; ?>" />
                <a  class="button button-primary"  href="<?php echo $skip_button_url; ?>">Skip</a>
			</p>
		</form>
        
        </div>

</div>
