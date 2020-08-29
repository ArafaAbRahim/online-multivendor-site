<?php
/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

class WidgetAdsFromCity extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'classified_maker_widgets_ads_from_city', 
			__('Classified Maker - Ads From Your City', classified_maker_textdomain),
			array( 'description' => __( 'Ads from your City', classified_maker_textdomain ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$count 		= apply_filters( 'widget_title', $instance['count'] );
		$default_loc= apply_filters( 'widget_title', $instance['default_loc'] );
		$show_image = apply_filters( 'widget_title', $instance['show_image'] );
		$show_price = apply_filters( 'widget_title', $instance['show_price'] );
		$show_loc 	= apply_filters( 'widget_title', $instance['show_loc'] );
		$show_date 	= apply_filters( 'widget_title', $instance['show_date'] );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];
		
		$classified_maker_currency_symbol = get_option('classified_maker_currency_symbol');				
		if(empty($classified_maker_currency_symbol)){$classified_maker_currency_symbol = '$';}
		
		if( !empty($post_in) ) $post_in = explode( ',', $post_in);
		else $post_in = array();
		
		echo '<ul class="classified-maker-widgets ads-city">';
		
		$ip = $_SERVER['REMOTE_ADDR']; 
		$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

		if( $query && $query['status'] == 'success' ) {
			$region_name = explode(" ",$query['regionName']);
			$city = $region_name[0];
			
			echo '<p>Current Location: '.$city.'</p>';
		}
		else {
			$city = $default_loc;
			if( !empty($default_loc) ) echo '<p>Default Location: '.$city.'</p>';
		}
		
		$found = true;
		$wp_query = new WP_Query(
			array (
				'post_type' => 'ads',
				'orderby' => 'Date',
				'order' => 'DESC',
				'posts_per_page' => $count,
				'meta_query' => array(
					array(
						'key'     => 'classified_maker_ads_location',
						'value'   => $city,
						'compare' => 'LIKE',
					),
				),
			) );
		
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
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];else $title = __( 'Ads from your City', classified_maker_textdomain );
		if ( isset( $instance[ 'count' ] ) ) $count = $instance[ 'count' ];else $count = __( '5', classified_maker_textdomain );
		if ( isset( $instance[ 'default_loc' ] ) ) $default_loc = $instance[ 'default_loc' ];else $default_loc = '';
		if ( isset( $instance[ 'show_image' ] ) && $instance[ 'show_image' ] == 'on' ) $show_image = 'checked';else $show_image = '';
		if ( isset( $instance[ 'show_price' ] ) && $instance[ 'show_price' ] == 'on' ) $show_price = 'checked';else $show_price = '';
		if ( isset( $instance[ 'show_loc' ] ) && $instance[ 'show_loc' ] == 'on' ) $show_loc = 'checked';else $show_loc = '';
		if ( isset( $instance[ 'show_date' ] ) && $instance[ 'show_date' ] == 'on' ) $show_date = 'checked';else $show_date = '';
		
		?>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title' ); ?></label></li>
				<li class="widgets_item_li_input"><input class="" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Ads Count' ); ?></label> </li>
				<li class="widgets_item_li_input"><input class="" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>" /></li>
			</ul>
		</li>
		<li class="widgets_item_li">
			<ul>
				<li class="widgets_item_li_title"><label for="<?php echo $this->get_field_id( 'default_loc' ); ?>"><?php _e( 'Default Location' ); ?></label> </li>
				<li class="widgets_item_li_input"><input class="" id="<?php echo $this->get_field_id( 'default_loc' ); ?>" name="<?php echo $this->get_field_name( 'default_loc' ); ?>" type="text" value="<?php echo esc_attr( $default_loc ); ?>" /></li>
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
			li.widgets_item_li_input input[type=text],
			li.widgets_item_li_input input[type=number] {display: inline-block;width: 100%;}
		</style>
		<?php 
		
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] 		= ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		$instance['default_loc']= ( ! empty( $new_instance['default_loc'] ) ) ? strip_tags( $new_instance['default_loc'] ) : '';
		$instance['show_image'] = ( ! empty( $new_instance['show_image'] ) ) ? strip_tags( $new_instance['show_image'] ) : '';
		$instance['show_price'] = ( ! empty( $new_instance['show_price'] ) ) ? strip_tags( $new_instance['show_price'] ) : '';
		$instance['show_loc'] 	= ( ! empty( $new_instance['show_loc'] ) ) ? strip_tags( $new_instance['show_loc'] ) : '';
		$instance['show_date'] 	= ( ! empty( $new_instance['show_date'] ) ) ? strip_tags( $new_instance['show_date'] ) : '';
		return $instance;
	}
}