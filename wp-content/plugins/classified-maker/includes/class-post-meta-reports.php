<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_reports_bm_post_meta{
	
	public function __construct(){
		add_action('add_meta_boxes', array($this, 'meta_boxes_reports'));
		add_action('save_post', array($this, 'meta_boxes_reports_save'));
	}
	
	public function meta_boxes_reports($post_type) {
		$post_types = array('reports');
		
		remove_meta_box( 'submitdiv', 'reports', 'side' );
		
		if (in_array($post_type, $post_types)) {
			add_meta_box('reports_metabox',
			__('Report Data','reports_bm'),
			array($this, 'reports_meta_box_function'),
			$post_type,
			'normal',
			'high');
		}
	}
	
	public function reports_meta_box_function($post) {
 
        wp_nonce_field('reports_nonce_check', 'reports_nonce_check_value');
		
		$input_reason 	= get_post_meta( $post->ID, 'input_reason', true );
		$input_message 	= get_post_meta( $post->ID, 'input_message', true );
		$ads_id 		= get_post_meta( $post->ID, 'ads_id', true );
		$timeago 		= human_time_diff( get_the_time( 'U', $post ), current_time( 'timestamp' ) );
		$author_id 		= ! empty( $post->post_author ) ? $post->post_author : 0;
		$author_name 	= get_the_author_meta( 'display_name', $author_id);
		
		
		// echo '<pre>'; print_r( $ads_id ); echo '</pre>';
		
		?>
		<style>#post-body.columns-2 #postbox-container-1{ display:none; }</style>
		
		<div class="classified-maker-reports">
			
			<div class="option-box">
				<div class="option-title"><i><a href="post.php?post=<?php echo $ads_id; ?>&action=edit"><?php echo get_the_title(); ?></a></i></div>		
			</div> <hr>
		
			<div class="option-box">
				<div class="option-title">Reason</div>		
				<div class="option-info"><i><?php echo $input_reason; ?></i></div>		
			</div>
		
			<div class="option-box">
				<div class="option-title">Message</div>		
				<div class="option-info"><i><?php echo $input_message; ?></i></div>		
			</div>
		
			<div class="option-box">
				<div class="option-title">Reporter</div>		
				<div class="option-info"><i>
					Reported by <b><?php echo $author_name; ?></b>
				</i></div>		
			</div>
		
			<div class="option-box">
				<div class="option-title">Date & Time</div>		
				<div class="option-info"><i>
					Reported on <b><?php echo $timeago; ?></b> ago <br><br>
					<?php echo get_the_date( '', $post ); ?> <br><br>
					<?php echo get_the_time( '', $post ); ?> 
				</i></div>		
			</div>
		
			
		
		
		</div>
		
		
		
		
		
		
		<?php
 	}	
	
	public function meta_boxes_reports_save($post_id){
	 
		if( !isset($_POST['reports_nonce_check_value']) ) return $post_id;
	 
		$nonce = $_POST['reports_nonce_check_value'];
		if( !wp_verify_nonce($nonce, 'reports_nonce_check') ) return $post_id;
		
		if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		
		if( 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
	 		if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		
	}
	
}new class_reports_bm_post_meta();