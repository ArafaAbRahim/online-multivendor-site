<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 13:55
 */

class vc_row_inner extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		td_global::set_in_inner_row(true);

		$buffy = '<div ' . $this->get_block_dom_id() . 'class="' . $this->get_block_classes(array('vc_row', 'vc_inner', 'wpb_row', 'td-pb-row')) . '" >';
			//get the block css
			$buffy .= $this->get_block_css();
			$buffy .= $this->do_shortcode($content);
		$buffy .= '</div>';


		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$buffy = '<div id="' . $this->block_uid . '" class="tdc-inner-row">' . $buffy . '</div>';
		}

		td_global::set_in_inner_row(false);

		// td-composer PLUGIN uses to add blockUid output param when this shortcode is retrieved with ajax (@see tdc_ajax)
		do_action( 'td_block_set_unique_id', array( &$this ) );

		return $buffy;
	}
}