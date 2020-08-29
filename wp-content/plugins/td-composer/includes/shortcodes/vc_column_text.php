<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 14:31
 */

class vc_column_text extends td_block {

	function render($atts, $content = null) {

		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'content' => __('Html code here! Replace this with any non empty text and that\'s it.', 'td_composer' ),
				'el_class' => '',
			), $atts, 'vc_column_text' );

		if ( is_null( $content ) || empty( $content ) ) {
			$content = $atts[ 'content' ];
		}

		// As vc does
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );

		if ( ! ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) ) {
			$content = do_shortcode( shortcode_unautop( $content ) );
		}

		$buffy = '<div class="wpb_wrapper wpb_text_column td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'] ) ) . '" ' . $this->get_block_html_atts() . '">';

			//get the block css
		    $buffy .= $this->get_block_css();

			// block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title(); //get the block title
				$buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

		$buffy .= $content . '</div>';

		return $buffy;
	}
}