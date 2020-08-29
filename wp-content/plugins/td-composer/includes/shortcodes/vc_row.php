<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 13:11
 */


class vc_row extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		td_global::set_in_row(true);

		$buffy = '';

		$block_classes = array('wpb_row', 'td-pb-row');

		$addElementStyle = false;
		$css_elements = $this->get_block_css($clearfixColumns, $addElementStyle);

		if ( $addElementStyle ) {
			$block_classes[] = 'tdc-element-style';
		}

		$buffy .= '<div ' . $this->get_block_dom_id() . 'class="' . $this->get_block_classes($block_classes) . '" >';
			//get the block css

		// Flag used to know outside if the '.clearfix' element is added as last child in vc_row and vc_row_inner
		// '.clearfix' was necessary to apply '::after' css settings from TagDiv Composer (the '::after' element comes with absolute position and at the same time a 'clear' is necessary)
		$clearfixColumns = false;

			$buffy .= $css_elements;
			$buffy .= $this->do_shortcode($content);

			// Add '.clearfix' element as last child in vc_row and vc_row_inner
			if ($clearfixColumns) {
				$buffy .= PHP_EOL . '<span class="clearfix"></span>';
			}

		$buffy .= '</div>';

		$full_width = $this->get_att( 'full_width' );

		$row_class = 'tdc-row';
		if ( !empty( $full_width ) ) {
			$row_class .= ' ' . $full_width;
		}


		// The following commented code is for the new theme
		//if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$buffy = '<div id="' . $this->block_uid . '" class="' . $row_class . '">' . $buffy . '</div>';
		//}


		td_global::set_in_row(false);

		// td-composer PLUGIN uses to add blockUid output param when this shortcode is retrieved with ajax (@see tdc_ajax)
		do_action( 'td_block_set_unique_id', array( &$this ) );

		return $buffy;
	}
}