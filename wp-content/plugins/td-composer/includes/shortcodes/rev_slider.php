<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 07.06.2016
 * Time: 10:40
 */

class rev_slider extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'title' => '',
				'alias' => '',
				'el_class' => '',
			), $atts, 'rev_slider' );

		return '<div class="td_block_wrap tdc-rev-slider ' . $this->get_block_classes( array( $atts['el_class'] ) ) . '"></div>';
	}
}