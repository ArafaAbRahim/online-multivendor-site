<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	
	//var_dump($meta_fields);


	if(empty($_POST['classified_maker_hidden']))
		{

			$classified_maker_options = get_option( 'classified_maker_options' );

		}
	else
		{	
			if($_POST['classified_maker_hidden'] == 'Y') {
				//Form data sent
	

				

				//$classified_maker_options = stripslashes_deep($_POST['classified_maker_options']);
				//update_option('classified_maker_options', $classified_maker_options);
	
	
			$class_classified_maker_functions = new class_classified_maker_functions();
			$settings_form_options = $class_classified_maker_functions->setings_options();
	
			
			foreach($settings_form_options as $key=>$option_set){
				
				foreach($option_set['options'] as $key=>$option){
					
					
					if(!empty($_POST[$key])){
						${$key} = stripslashes_deep($_POST[$key]);
						update_option($key, ${$key});
						}
					else{
						${$key} = array();
						update_option($key, ${$key});
						
						}


					//var_dump($option_key);
					
					}
				}
	
	
	
	
	
	
	
	
				//var_dump($_POST);
				?>
				<div class="updated"><p><strong><?php _e('Changes Saved.', classified_maker_textdomain ); ?></strong></p></div>
		
				<?php
				} 
		}
	

	?>





<div class="wrap classified-maker-admin settings">

	<div id="icon-tools" class="icon32"><br></div>
    
	<h2><?php _e(sprintf('%s - Settings',classified_maker_plugin_name), classified_maker_textdomain); ?></h2>
    
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="classified_maker_hidden" value="Y">
            <?php settings_fields( 'classified_maker_plugin_options' );
                    do_settings_sections( 'classified_maker_plugin_options' );
    
                
            ?>

			
			<?php

			$class_classified_maker_form = new class_classified_maker_form();
			
			
			
			
			$class_classified_maker_functions = new class_classified_maker_functions();
			$settings_form_input = $class_classified_maker_functions->setings_options();
			
			echo '<ul class="tab-nav">';
			
			$i= 1;
			foreach($settings_form_input as $key=>$option_set){
				//var_dump($option_set['options']);
				
				if($i==1){
					$active = 'active';
					}
				else{
					$active = '';
					}	
				
				echo '<li class="nav'.$i.' '.$active .'" nav="'.$i.'">'.$option_set['title'].'</li>';
				
				$i++;
				
			}
			
			echo '</ul>';
			
			
			
			echo '<ul class="box">';
			
			$i = 1;
			foreach($settings_form_input as $key=>$option_set){
				//var_dump($option_set['options']);
				
				
				if($i==1){
					$active = 'active';
					}
				else{
					$active = '';
					}
				
				if($i==1){
					$style = 'display: block;';
					}
				else{
					$style = 'display: none;';
					}				
				
				
				echo '<li class="tab-box box'.$i.' '.$active .'" style="'.$style.'">';
				foreach($option_set['options'] as $key=>$option ){
					
					//var_dump($option);
					echo $class_classified_maker_form->settings_form_input($option);
					
					}
				
				
				echo '</li>';
				
				
				//echo $class_classified_maker_form->settings_form_input($meta_fields[$key]);
				$i++;
				}
			
			echo '</ul>';
			
			?>



			<p class="submit">
				<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes',classified_maker_textdomain ); ?>" />
			</p>
		</form>


</div>
