<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


$classified_maker_display_category_meta = get_option('classified_maker_display_category_meta');

if($classified_maker_display_category_meta=='yes'){
	
		
	
	$class_classified_maker_functions = new class_classified_maker_functions();
	$post_type_input_fields = $class_classified_maker_functions->post_type_input_fields();
	
	$meta_fields_data = $post_type_input_fields['meta_fields'];
	
	$classified_maker_field_set = get_option( 'classified_maker_field_set' );
	//$category_id = get_post_meta(get_the_ID(), 'classified_maker_ads_category', true);
	
	
	
	$category_id = wp_get_post_terms(get_the_ID(), 'ads_cat', array("fields" => "ids"));
	
	//var_dump($category_id);
	
	if(empty($category_id)){
		
		return;
		}
	
	$category_id = $category_id[0];
	?>
	<div class="meta-cat">
	
	
	<?php
	if(!empty($category_id)){
		
		if(!empty($classified_maker_field_set[$category_id])){
			
			$meta_fields_cats = $classified_maker_field_set[$category_id];
			
	
			foreach($meta_fields_cats as $meta_key=>$meta_field){
				
				if(isset($classified_maker_field_set[$category_id][$meta_key]['display_ads_page'])){
					
						$meta_value = get_post_meta(get_the_ID(), $meta_key, true);
					
						if(isset($meta_fields_data[$meta_key])){
							
							echo '<div class="meta">';
							echo '<span class="title">'.$meta_fields_data[$meta_key]['title'].'</span>:';
							
							if(is_serialized($meta_value)){
								
								$meta_value = unserialize($meta_value);
								
								foreach($meta_value as $value){
									
									echo '<span class="value"> '.$value.'</span>, ';
									}
								
								}
							else{
								echo '<span class="value"> '.$meta_value.'</span>';
								}
							
							
							echo '</div>';
							
							}
	
					}
				
				
				}
	
			}
	
		
		}
	
	
	
	
	
	
	?>
	
	   
	
	
	</div>

<?php

}

?>
