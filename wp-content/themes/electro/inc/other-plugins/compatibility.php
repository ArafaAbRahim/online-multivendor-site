<?php
/**
 * Compatibility Code for smaller plugins
 */

/**
 * Menu Image Compatibility
 */

if ( class_exists( 'Menu_Image_Plugin' ) ) {
	add_filter( 'walker_nav_menu_start_el', 'ec_child_enable_static_block_with_menu_image', 20, 4 );

	function ec_child_enable_static_block_with_menu_image( $item_output, $item, $depth, $args ) {
		
		if( 'static_block' == $item->object ){			
			$megamenu_item = get_post( $item->object_id );
			$item_output = '<div class="yamm-content">' . apply_filters( 'the_content', $megamenu_item->post_content ) . '</div>';
		}

		return $item_output;
	}

	add_filter( 'menu_image_link_attributes', 'ec_add_menu_image_link', 20, 4 );

	function ec_add_menu_image_link( $atts, $item, $depth, $args ) {
		if ( $args->has_children ) {
			if ( $args->theme_location == 'departments-menu' && $depth === 0 ) {
				$atts['class'] .= ' dropdown-submenu';
			} elseif ( $depth === 0 ) {
				$atts['class'] .= ' dropdown';
			} else {
				$atts['class'] .= ' dropdown-submenu';
			}
		}

		if ( $args->has_children && $depth === 0 ) {
			if ( $args->theme_location == 'all-departments-menu' || $args->theme_location == 'departments-menu' ) {
				$atts['data-toggle']  = 'dropdown-hover';
			} else {
				$atts['data-toggle'] = 'dropdown';
			}
			$atts['class']			= 'dropdown-toggle';
			$atts['aria-haspopup']	= 'true';
		}
		return $atts;
	}
}

if ( function_exists( 'vc_set_default_editor_post_types' ) ){
	add_action( 'init', 'ec_set_vc_default_editor_post_types', 20 );
	function ec_set_vc_default_editor_post_types() {
		vc_set_default_editor_post_types( array( 'page', 'static_block' ) );
	}
}