<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	


	
function classified_maker_notice_missing_field_set()
	{
		$classified_maker_field_set = get_option('classified_maker_field_set');
		$admin_url = get_admin_url();
		
		?>
        
        
        <?php
        
		if(empty($classified_maker_field_set)){
			echo '<div class="update-nag">';
			echo 'Please set category field set first. <a href="'.$admin_url.'edit.php?post_type=ads&page=field_set">Field set</a>';
			echo '</div>';
			}
		
		?>
        
        
        <?php
		
		
	}

add_action('admin_notices', 'classified_maker_notice_missing_field_set');