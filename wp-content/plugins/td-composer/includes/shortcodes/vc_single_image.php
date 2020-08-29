<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 03.02.2017
 * Time: 16:06
 */

class vc_single_image extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'image' => '',
				'image_url' => '#',
				'open_in_new_window' => '',
				'height' => '',
				'repeat' => '',
				'size' => '',
				'alignment' => '',
				'style' => '',
				'el_class' => '',
			), $atts, 'vc_single_image' );

		//$inline_css = ( (float) $atts['height'] >= 0.0 ) ? ' style="height: ' . esc_attr( $atts['height'] ) . '"' : '';

		$target = '';
		if ( '' !== $atts['open_in_new_window'] ) {
			$target = ' target="_blank" ';
		}

		$image_size = ' background-size: cover;';
		if ( '' !== $atts['size'] ) {
			$image_size = ' background-size: ' . $atts['size'] . ';';
		}

		$image_repeat = ' background-repeat: no-repeat;';
		if ( '' !== $atts['repeat'] ) {
			$image_repeat = ' background-repeat: ' . $atts['repeat'] . ';';
		}

		$image_alignment = ' background-position: center center;';
		if ( '' !== $atts['alignment'] ) {
			$image_alignment = ' background-position: center ' . $atts['alignment'] . ';';
		}


		$editing_class = '';
		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$editing_class = 'tdc-editing-vc_single_image';
		}

		if ( !empty($atts['image']) ) {

			$meta = wp_get_attachment_metadata( $atts['image'] );

			$image_height = 'height:' . $meta[ 'height' ] . 'px;';

			if( !empty($atts['height'])) {
				$image_height = ' height: ' . $atts['height'] . 'px;';
			}

			$buffer = '<div class="wpb_wrapper td_block_single_image td_block_wrap ' . $this->get_block_classes( array(
					$atts['el_class'],
					$editing_class,
					'td-single-image-' . $atts['style']
				) ) . '">';
			$buffer .= '<a style="background-image: url(\'' . wp_get_attachment_url( $atts['image'] ) . '\');' . $image_height . $image_size . $image_repeat . $image_alignment . '" href="' . esc_url( $atts['image_url'] ) . '" ' . $target . ' rel="bookmark"></a>';
			$buffer .= $this->get_block_css() . '</div>';

		} else {
			$buffer = '<div class="wpb_wrapper td_block_wrap td_block_single_image"></div>';
		}

		return  $buffer;
	}
}