<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	$classified_maker_account_required_post_ads = get_option( 'classified_maker_account_required_post_ads' );
	
	$class_classified_maker_pickform = new class_classified_maker_pickform();








?>

<div class="post-ads pickform">

    <div class="validation">
    
    <?php
	
	var_dump($_POST);	
	//var_dump(classified_maker_get_terms('ads_cat'));
	

	
	if(isset($_POST['post_ads_hidden'])){
		
		
		
		
		
		$errors = $class_classified_maker_pickform->validations($_POST);
	

		if(!empty($_POST) && !empty($errors)){
			
			foreach($errors as $error){
				
				?>
				<div class="failed"><i class="fa fa-times"></i> <?php echo $error; ?></div>
				<?php

				}
			}
		else{
			
			do_action('classified_maker_action_post_ads_save');
			
			}
		}

	?>
    
    </div>



	<?php
    do_action('classified_maker_action_post_ads_before');
    
    if($classified_maker_account_required_post_ads=='yes' && !is_user_logged_in()){
        echo  __(sprintf('Please <a href="%s">login</a> to post ads.',$account_page_url),classified_maker_textdomain);;
        }
    else{
        
    //var_dump($_POST);
    ?>
    <form enctype="multipart/form-data"   method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="post_ads_hidden" value="Y">
    <?php
    
    
    do_action('classified_maker_action_post_ads_main');

	
    
    wp_nonce_field( 'classified_maker' );
    ?>
    <input class="post-ads-submit" type="submit" value="<?php _e('Submit',classified_maker_textdomain); ?>" />
    </form>
    <?php
    
    
    do_action('classified_maker_action_post_ads_after');
        
	}
        
    
    ?>

</div>