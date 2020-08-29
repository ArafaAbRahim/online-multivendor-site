<?php
/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

class WidgetCategorisedAds extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'classified_maker_widgets_categorised_ads', 
			__('Classified Maker - Categorised Ads', classified_maker_textdomain),
			array( 'description' => __( 'Show Categorised Ads.', classified_maker_textdomain ), ) 
		);
	}

	public function widget( $args, $instance ) {

		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$count 		= apply_filters( 'widget_title', $instance['count'] );
		$category 	= $instance['category'];
		$show_image = apply_filters( 'widget_title', $instance['show_image'] );
		$show_price = apply_filters( 'widget_title', $instance['show_price'] );
		$show_loc 	= apply_filters( 'widget_title', $instance['show_loc'] );
		$show_date 	= apply_filters( 'widget_title', $instance['show_date'] );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];
		
		
		$classified_maker_currency_symbol = get_option('classified_maker_currency_symbol');				
		if(empty($classified_maker_currency_symbol)){$classified_maker_currency_symbol = '$';}
		
		$wp_query = new WP_Query(
			array (
				'post_type' 	=> 'ads',
				'orderby' 		=> 'Date',
				'order' 		=> 'DESC',
				'posts_per_page'=> $count,
				'tax_query' => array(
					array(
						'taxonomy' => 'ads_cat',
						'field' => 'id',
						'terms' => $category,
					),
				),
			) );
		
		echo '<ul class="classified-maker-widgets categorised-ads">';
		
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();	
			
				echo '<li class="single">';
				
				if ( $show_image == 'on' ) {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
					if(!empty($thumb['0'])) $thumb_url = $thumb['0'];
					else $thumb_url = classified_maker_plugin_url.'assets/front/images/thumb.png';
					
					echo '<img class="ads-image" src="'.$thumb_url.'" />';	
				}
				
				echo '<div class="ads-details">';
				
				echo '<a class="ads-title" href="'.get_the_permalink().'">'.get_the_title().'</a>';
				
				if ( $show_price == 'on' ) {
					$classified_maker_ads_price = get_post_meta( get_the_ID(), 'classified_maker_ads_price', true );
					echo '<span class="ads-price">Price: '.$classified_maker_currency_symbol.''.$classified_maker_ads_price.'</span>';
				}
				if ( $show_loc == 'on' ) {
					$classified_maker_ads_location = get_post_meta( get_the_ID(), 'classified_maker_ads_location', true );
					echo '<span class="ads-location"><i class="fa fa-map-marker" aria-hidden="true"></i> '.$classified_maker_ads_location.'</span>';
				}
				if ( $show_date == 'on' ) {
					echo '<span class="ads-date"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> '.get_the_date().'</span>';
				}
				

				echo '</div></li>';
				
			endwhile;
		endif;
		wp_reset_query();
		
		echo '</ul>';
		


		echo $args['after_widget'];
	}
	
	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];else $title = __( 'Categorised Ads', classified_maker_textdomain );
		if ( isset( $instance[ 'count' ] ) ) $count = $instance[ 'count' ];else $count = __( '5', classified_maker_textdomain );
		if ( isset( $instance[ 'category' ] ) ) $category = $instance[ 'category' ]; else $category = array();
		if ( isset( $instance[ 'show_image' ] ) && $instance[ 'show_image' ] == 'on' ) $show_image = 'checked';else $show_image = '';
		if ( isset( $instance[ 'show_price' ] ) && $instance[ 'show_price' ] == 'on' ) $show_price = 'checked';else $show_price = '';
		if ( isset( $instance[ 'show_loc' ] ) && $instance[ 'show_loc' ] == 'on' ) $show_loc = 'checked';else $show_loc = '';
		if ( isset( $instance[ 'show_date' ] ) && $instance[ 'show_date' ] == 'on' ) $show_date = 'checked';else $show_date = '';

		?>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title' ); ?></label></li>
				<li class="widgets_item_li_input"><input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Ads Count' ); ?></label> </li>
				<li class="widgets_item_li_input"><input  id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>" /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select Category' ); ?></label> </li>
				<li class="widgets_item_li_input">

					<select multiple id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>[]">
					<?php 
					
						foreach( $this->get_ads_category() as $cat_id => $title ) {
							if ( in_array( $cat_id, $category ) ) $selected = 'selected';
							else $selected = '';
							
							echo '<option value="'.$cat_id.'" '.$selected.'>'.$title.'</option>';
						}
					?>
					</select>
				</li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e( 'Show Images' ); ?></label> </li>
				<li class="widgets_item_li_input"><input id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" type="checkbox" <?php echo  $show_image; ?> /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'show_price' ); ?>"><?php _e( 'Show Price' ); ?></label> </li>
				<li class="widgets_item_li_input"><input id="<?php echo $this->get_field_id( 'show_price' ); ?>" name="<?php echo $this->get_field_name( 'show_price' ); ?>" type="checkbox" <?php echo  $show_price; ?> /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'show_loc' ); ?>"><?php _e( 'Show Location' ); ?></label> </li>
				<li class="widgets_item_li_input"><input id="<?php echo $this->get_field_id( 'show_loc' ); ?>" name="<?php echo $this->get_field_name( 'show_loc' ); ?>" type="checkbox" <?php echo  $show_loc; ?> /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show published Date' ); ?></label> </li>
				<li class="widgets_item_li_input"><input id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" <?php echo  $show_date; ?> /></li>
			</ul>
		</li>
		<style>
			li.widgets_item_li {list-style: none;}
			li.widgets_item_li_title {display: inline-block;width: 30%;}
			li.widgets_item_li_input {display: inline-block;width:60%;}
			li.widgets_item_li_input input[type=text],li.widgets_item_li_input select,
			li.widgets_item_li_input input[type=number] {display: inline-block;width: 100%;}
		</style>
		<?php 
		
		
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] 		= ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		$instance['show_image'] = ( ! empty( $new_instance['show_image'] ) ) ? strip_tags( $new_instance['show_image'] ) : '';
		$instance['show_price'] = ( ! empty( $new_instance['show_price'] ) ) ? strip_tags( $new_instance['show_price'] ) : '';
		$instance['show_loc'] 	= ( ! empty( $new_instance['show_loc'] ) ) ? strip_tags( $new_instance['show_loc'] ) : '';
		$instance['show_date'] 	= ( ! empty( $new_instance['show_date'] ) ) ? strip_tags( $new_instance['show_date'] ) : '';
		
		$instance['category'] = array();
        if ( isset ( $new_instance['category'] ) ) {
            foreach ( $new_instance['category'] as $value ) {
				$instance['category'][] = $value;
            }
        }
		
		return $instance;
	}
	
	public function get_ads_category(){
		
		$ads_category[''] = 'All Category';

		foreach( get_terms( array('taxonomy' => 'ads_cat','hide_empty' => false,) )  as $term_details )
			$ads_category[$term_details->term_id] = $term_details->name;

		return $ads_category;
	}
}