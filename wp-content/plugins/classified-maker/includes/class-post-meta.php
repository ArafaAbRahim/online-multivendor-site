<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_ads_bm_post_meta{
	
	public function __construct(){

		//meta box action for "ads"
		add_action('add_meta_boxes', array($this, 'meta_boxes_ads'));
		add_action('save_post', array($this, 'meta_boxes_ads_save'));

		}
		

	
	public function meta_boxes_ads($post_type) {
			$post_types = array('ads');
	 
			//limit meta box to certain post types
			if (in_array($post_type, $post_types)) {
				add_meta_box('ads_metabox',
				__('Ads data', classified_maker_textdomain),
				array($this, 'ads_meta_box_function'),
				$post_type,
				'normal',
				'high');
			}
		}
	public function ads_meta_box_function($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('ads_nonce_check', 'ads_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
       // $ads_bm_data = get_post_meta($post -> ID, 'ads_bm_data', true);

			
		//var_dump($ads_bm_salary_currency);
        // Display the form, using the current value.
		
		
		$ads_id = get_the_ID();
		
		$ads_terms = wp_get_post_terms($ads_id, 'ads_cat');
		
		//echo '<pre>'.var_export($ads_terms, true).'</pre>';
		
		
		if(!empty($ads_terms)){
			
			$primary_term = $ads_terms[0];
			$term_id = $primary_term->term_id;
			//echo '<pre>'.var_export($primary_term->term_id, true).'</pre>';
			
		?>
        <div class="ads-meta pickform">
			
           <?php
           
		  echo  classified_maker_ads_meta_html($ads_id, $term_id);
		   
		   ?>
            
            
        </div>
		<?php
			
			
			
			
			}
		else{
			
			echo 'Please select category and save the ads first.';
			
			}
			
/*


		else{
				$terms = get_terms( array(
					'taxonomy' => 'ads_cat',
				) );
				
				//echo '<pre>'.var_export($terms, true).'</pre>';
				
				
				
				?>
                
                <div class="choose-ads-cat">
                    Please selet ads category:<br />
                    <select class="ads-cat">
						<?php
                        
                        foreach($terms as $term){
                            $name = $term->name;
                            $term_id = $term->term_id;
                            ?>
                            <option value="<?php echo $term_id; ?>"><?php echo $name; ?></option>
                            <?php
                            
                            }
                        ?>
                    
                    </select>
                    <span class="button select-category">Select</span> 
                </div>

                
                

                <?php
			
			}


*/
		
		?>
        
        

        

        
        <?php
		

		
		




   		}
	
	
	public function meta_boxes_ads_save($post_id){
	 
			/*
			 * We need to verify this came from the our screen and with 
			 * proper authorization,
			 * because save_post can be triggered at other times.
			 */
	 
			// Check if our nonce is set.
			if (!isset($_POST['ads_nonce_check_value']))
				return $post_id;
	 
			$nonce = $_POST['ads_nonce_check_value'];
	 
			// Verify that the nonce is valid.
			if (!wp_verify_nonce($nonce, 'ads_nonce_check'))
				return $post_id;
	 
			// If this is an autosave, our form has not been submitted,
			//     so we don't want to do anything.
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return $post_id;
	 
			// Check the user's permissions.
			if ('page' == $_POST['post_type']) {
	 
				if (!current_user_can('edit_page', $post_id))
					return $post_id;
	 
			} else {
	 
				if (!current_user_can('edit_post', $post_id))
					return $post_id;
			}
	 
			/* OK, its safe for us to save the data now. */
	 
			// Sanitize the user input.
			//$ads_bm_data = stripslashes_deep($_POST['ads_bm_data']);
	
			
			// Update the meta field.
			//update_post_meta($post_id, 'ads_bm_data', $ads_bm_data);

			//$option_key = stripslashes_deep($_POST[$option_key]);
			//update_post_meta($post_id, $option_key, $option_key);		

			$ads_id = get_the_ID();
			
			$ads_terms = wp_get_post_terms($ads_id, 'ads_cat');
			
			//echo '<pre>'.var_export($ads_terms, true).'</pre>';
			
			
			if(!empty($ads_terms)){
				
				$primary_term = $ads_terms[0];
				$cat_id = $primary_term->term_id;
				//echo '<pre>'.var_export($primary_term->term_id, true).'</pre>';
				
				}


			$classified_maker_field_set = get_option( 'classified_maker_field_set' );
			$cat_fields = $classified_maker_field_set[$cat_id];
			
			
			if(!empty($cat_fields))
			foreach($cat_fields as $key=>$field){
					
				if(isset($field['checked']) && $field['checked'] == 'yes' && isset($_POST[$key])){
					
					if( is_array($_POST[$key])){
						
							$meta_value = serialize($_POST[$key]);
							update_post_meta($ads_id, $key , $meta_value);

						}
					else{
							$meta_value = sanitize_text_field($_POST[$key]);
							update_post_meta($ads_id, $key , $meta_value);
						}
					

					
					}

				}
			
			
			
			
					
		}
	
	}


new class_ads_bm_post_meta();