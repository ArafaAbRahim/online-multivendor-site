<?php
/**
 * Created by ra.
 * Date: 3/31/2016
 * Internal map file
 */

$block_general_params_array = td_config::get_map_block_general_array();

// Remove the 'Color presets' option on Newsmag
if ( 'Newsmag' === TD_THEME_NAME ) {
	foreach ($block_general_params_array as $key => $block_general_param) {
		if ( 'color_preset' === $block_general_param['param_name']) {
			array_splice($block_general_params_array, $key, 1);
			break;
		}
	}
}

$external_shortcodes = array(
	'td_block_social_counter' => array(
		"name" => 'Social Counter',
        "base" => 'td_block_social_counter',
        "class" => 'td_block_social_counter',
        "controls" => "full",
        "category" => __('Blocks', TD_THEME_NAME),
        'icon' => 'icon-pagebuilder-td_social_counter',
        "params" => array_merge(
			$block_general_params_array,
            array(
                array(
                    "param_name" => "style",
                    "type" => "dropdown",
                    "value" => array('Default' => '', 'Style 1 - Default black' => 'style1', 'Style 2 - Default with border' => 'style2 td-social-font-icons', 'Style 3 - Default colored circle' => 'style3 td-social-colored', 'Style 4 - Default colored square' => 'style4 td-social-colored', 'Style 5 - Boxes with space' => 'style5 td-social-boxed', 'Style 6 - Full boxes' => 'style6 td-social-boxed', 'Style 7 - Black boxes' => 'style7 td-social-boxed', 'Style 8 - Boxes with border' => 'style8 td-social-boxed td-social-font-icons', 'Style 9 - Colored circles' => 'style9 td-social-boxed td-social-colored', 'Style 10 - Colored squares' => 'style10 td-social-boxed td-social-colored'),
                    "heading" => 'Style',
                    "description" => "Style of the Social Counter widget",
                    "holder" => "div",
                    "class" => "tdc-dropdown-extrabig"
                ),
                array(
                    "param_name" => "separator",
                    "type" => "horizontal_separator",
                    "value" => "",
                    "class" => ""
                ),
                array(
                    "param_name" => "facebook",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Facebook id", TD_THEME_NAME) . '&nbsp<a href="http://forum.tagdiv.com/tagdiv-social-counter-tutorial/" target="_blank">How to get the App Id and the Security Key</a>',
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
	            array(
		            "param_name" => "facebook_app_id",
		            "type" => "textfield",
		            "value" => "",
		            "heading" => __("Facebook App Id", TD_THEME_NAME),
		            "description" => "",
		            "holder" => "div",
		            "class" => "tdc-textfield-big"
	            ),
	            array(
		            "param_name" => "facebook_security_key",
		            "type" => "textfield",
		            "value" => "",
		            "heading" => __("Facebook Security Key", TD_THEME_NAME),
		            "description" => "",
		            "holder" => "div",
		            "class" => "tdc-textfield-big"
	            ),
	            array(
		            "param_name" => "facebook_access_token",
		            "type" => "textfield",
		            "value" => "",
		            "heading" => __("Facebook Access Token", TD_THEME_NAME) . '&nbsp;<a class="td_access_token facebook" href="#">Get Access Token</a><i class="td_access_token_info" style="display: none; color: #F00; margin-left: 10px">Please wait...</i>',
		            "description" => "",
		            "holder" => "div",
		            "class" => "tdc-textfield-big"
	            ),
                array(
                    "param_name" => "twitter",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Twitter id", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
                array(
                    "param_name" => "youtube",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Youtube id", TD_THEME_NAME),
                    "description" => "User: www.youtube.com/user/<b style='color: #000'>ENVATO</b><br/>Channel: www.youtube.com/ <b style='color: #000'>channel/UCJr72fY4cTaNZv7WPbvjaSw</b>",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
//                array(
//                    "param_name" => "vimeo",
//                    "type" => "textfield",
//                    "value" => "",
//                    "heading" => __("Vimeo id", TD_THEME_NAME),
//                    "description" => "",
//                    "holder" => "div",
//                    "class" => "tdc-textfield-big"
//                ),
                array(
                    "param_name" => "googleplus",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Google Plus User", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
                array(
                    "param_name" => "instagram",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Instagram User", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
                array(
                    "param_name" => "soundcloud",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Soundcloud User", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
                array(
                    "param_name" => "rss",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Feed subscriber count", TD_THEME_NAME),
                    "description" => "Write the number of followers",
                    "holder" => "div",
                    "class" => "tdc-textfield-big"
                ),
                array(
                    "param_name" => "open_in_new_window",
                    "type" => "dropdown",
                    "value" => array('- Same window -' => '', 'New window' => 'y'),
                    "heading" => __("Open in", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-extrabig"
                ),
                array(
                    "param_name" => "separator",
                    "type" => "horizontal_separator",
                    "value" => "",
                    "class" => ""
                ),
                array(
                    'param_name' => 'el_class',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Extra class',
                    'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
                    'class' => 'tdc-textfield-extrabig',
                    'group' => ''
                ),
                array(
                    'param_name' => 'css',
                    'value' => '',
                    'type' => 'css_editor',
                    'heading' => 'Css',
                    'group' => 'Design options',
                ),
	            array(
	                'param_name' => 'tdc_css',
	                'value' => '',
	                'type' => 'tdc_css_editor',
	                'heading' => '',
	                'group' => 'Design options',
	            ),
            )
        )
	),

	'rev_slider' => array(
		'external_shortcode' => true,
		'base' => 'rev_slider',
		'name' => __( 'Revolution Slider', 'td_composer' ),
		'icon' => 'icon-wpb-revslider',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Place Revolution slider', 'td_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Slider', 'td_composer' ),
				'param_name' => 'alias',
				'admin_label' => true,
				'value' => '',
				'save_always' => true,
				'description' => "<em>Place here the alias for embedding your slider <br><b>example: slider1</b></em>",
				'class' => '',
			),
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Extra class', 'td_composer' ),
//				'param_name' => 'el_class',
//				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'td_composer' ),
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
		),
	),

// Example: Register an external shortcode BUT IMPLEMENTED in theme

//	'button' => array(
//		'external_shortcode' => true,
//		'base' => 'button',
//		'name' => 'button',
//		'params' => array(
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Label', 'td_composer' ),
//				'param_name' => 'label',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Color', 'td_composer' ),
//				'param_name' => 'color',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Size', 'td_composer' ),
//				'param_name' => 'size',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Type', 'td_composer' ),
//				'param_name' => 'type',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Target', 'td_composer' ),
//				'param_name' => 'target',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Link', 'td_composer' ),
//				'param_name' => 'link',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//		),
//	),

// Example: Register an external shortcode WITHOUT implementation

//	'fake_button' => array(
//		'external_shortcode' => true,
//		'base' => 'fake_button',
//		'name' => 'fake_button',
//		'params' => array(
//			array(
//				'type' => 'textfield',
//				'heading' => __( 'Label', 'td_composer' ),
//				'param_name' => 'label',
//				'description' => '',
//				'value' => '',
//				'class' => 'tdc-textfield-extrabig',
//			),
//		),
//	)
);
tdc_mapper::set_external_shortcodes( $external_shortcodes );


// map the blocks from our themes
add_action('td_wp_booster_loaded', 'tdc_map_theme_blocks', 10002);
function tdc_map_theme_blocks() {
	foreach (td_api_block::get_all() as $block) {
		if (isset($block['map_in_td_composer']) && $block['map_in_td_composer'] === true ) { // map only shortcodes that have to appear in the composer
			tdc_mapper::map_shortcode($block);
		}
	}

	tdc_mapper::map_block_templates(td_api_block_template::get_all());
}


/**
 * overwrites the shortcode from the theme or just loads the shortcodes that come with the plugin
 * !!! USES THEME CODE
 * @see td_global_blocks is from wp booster
 */
add_action('td_wp_booster_loaded', 'tdc_load_internal_shortcodes',  10002);
function tdc_load_internal_shortcodes() {
	td_global_blocks::add_lazy_shortcode('vc_row');
	td_global_blocks::add_lazy_shortcode('vc_column');
	td_global_blocks::add_lazy_shortcode('vc_row_inner');
	td_global_blocks::add_lazy_shortcode('vc_column_inner');

	td_global_blocks::add_lazy_shortcode('vc_column_text');
	td_global_blocks::add_lazy_shortcode('vc_raw_html');
	td_global_blocks::add_lazy_shortcode('vc_empty_space');
	td_global_blocks::add_lazy_shortcode('vc_widget_sidebar');
	td_global_blocks::add_lazy_shortcode('vc_single_image');
	td_global_blocks::add_lazy_shortcode('vc_separator');
	td_global_blocks::add_lazy_shortcode('vc_wp_recentcomments');
}


$rowParams = array(
	// internal modifier - does not update atts
	array (
		'param_name' => 'tdc_row_columns_modifier',
		'heading' => 'Layout',
		'type' => 'dropdown',
		'value' => array (
			'1/1' => '11',
			'2/3 + 1/3' => '23_13',
			'1/3 + 2/3' => '13_23',
			'1/3 + 1/3 + 1/3' => '13_13_13'
		),
		'tdc_dropdown_images' => true, // show image selector instead of classic dropdown
		'class' => 'tdc-row-col-dropdown tdc-visual-selector',
	),

	array(
		"param_name" => "separator",
		"type" => "horizontal_separator",
		"value" => "",
		"class" => ""
	),

	array (
		'param_name' => 'full_width',
		'heading' => 'Row stretch',
		'type' => 'dropdown',
		'value' => array (
			'Default' => '',
			'Stretch row' => 'stretch_row',
			'Stretch row and content' => 'stretch_row_content td-stretch-content',
			'Stretch row and content (with paddings)' => 'stretch_row_content_no_space td-stretch-content',
		),
		'class' => 'tdc-row-stretch-dropdown tdc-dropdown-extrabig',
	),

	array(
		'type' => 'textfield', // should have been vc_el_id but we use textfield
		'heading' => 'Row ID',
		'param_name' => 'el_id',
		'description' => 'Make sure that this is unique on the page',
		'class' => 'tdc-textfield-extrabig',
	),

	array(
		'type' => 'textfield',
		'heading' => 'Extra class',
		'param_name' => 'el_class',
		'description' => 'Add a class to this row',
		'class' => 'tdc-textfield-extrabig',
	),

	array (
		'param_name' => 'css',
		'value' => '',
		'type' => 'css_editor',
		'heading' => 'Css',
		'group' => 'Design options',
	),

	array (
        'param_name' => 'tdc_css',
        'value' => '',
        'type' => 'tdc_css_editor',
        'heading' => '',
        'group' => 'Design options',
    ),
);
// Remove the 'Row stretch' option on Newsmag
if ( 'Newsmag' === TD_THEME_NAME ) {
	foreach ($rowParams as $key => $rowParam) {
		if ( 'full_width' === $rowParam['param_name']) {
			array_splice($rowParams, $key, 1);
			break;
		}
	}
}

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_row',
		'name' => __('Row' , 'td_composer'),
		'is_container' => true,
		'icon' => 'tdc-icon-row',
		'category' => __('Content', 'td_composer'),
		'description' => __('Row description', 'td_composer'),
		'params' => $rowParams
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_column',
		'name' => __('Column', 'td_composer' ),
		'icon' => 'tdc-icon-column',
		'is_container' => true,
		'content_element' => false, // hide from the list of elements on the ui
		'description' => __( 'Place content elements inside the column', 'td_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => 'Extra class',
				'param_name' => 'el_class',
				'description' => 'Add a class to this column',
				'class' => 'tdc-textfield-extrabig'
			),
			array (
				'param_name' => 'css',
				'value' => '',
				'type' => 'css_editor',
				'heading' => 'Css',
				'group' => 'Design options',
			),
			array (
	            'param_name' => 'tdc_css',
	            'value' => '',
	            'type' => 'tdc_css_editor',
	            'heading' => '',
	            'group' => 'Design options',
	        ),
		)
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_row_inner',
		'name' => __('Inner Row', 'td_composer'),
		'content_element' => false, // hide from the list of elements on the ui
		'is_container' => true,
		'icon' => 'icon-wpb-row',
		'description' => __('Place content elements inside the inner row', 'td_composer'),
		'params' => array(

			// internal modifier - does not update atts
			array (
				'param_name' => 'tdc_inner_row_columns_modifier',
				'heading' => 'Layout',
				'type' => 'dropdown',
				'value' => array (
					'1/1' => '11',
					'1/2 + 1/2' => '12_12',
					'2/3 + 1/3' => '23_13',
					'1/3 + 2/3' => '13_23',
					'1/3 + 1/3 + 1/3' => '13_13_13'
				),
				'tdc_dropdown_images' => true, // show image selector instead of classic dropdown
				'class' => 'tdc-innerRow-col-dropdown tdc-visual-selector'
			),

			array(
				"param_name" => "separator",
				"type" => "horizontal_separator",
				"value" => "",
				"class" => ""
			),

			array(
				'type' => 'textfield', // should have been vc_el_id but we use textfield
				'heading' => 'Row ID',
				'param_name' => 'el_id',
				'description' => 'Make sure that this is unique on the page',
				'class' => 'tdc-textfield-extrabig',
			),
			array(
				'type' => 'textfield',
				'heading' => 'Extra class',
				'param_name' => 'el_class',
				'description' => 'Add a class to this row',
				'class' => 'tdc-textfield-extrabig',
			),


			array (
				'param_name' => 'css',
				'value' => '',
				'type' => 'css_editor',
				'heading' => 'Css',
				'group' => 'Design options',
			),
			array (
	            'param_name' => 'tdc_css',
	            'value' => '',
	            'type' => 'tdc_css_editor',
	            'heading' => '',
	            'group' => 'Design options',
	        ),
		)
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_column_inner',
		'name' => __( 'Inner Column', 'td_composer' ),
		'icon' => 'icon-wpb-row',
		'allowed_container_element' => false, // if it can contain other container elements (other blocks that have is_container = true)
		'content_element' => false, // hide from the list of elements on the ui
		'is_container' => true,
		'description' => __( 'Place content elements inside the inner column', 'td_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => 'Extra class',
				'param_name' => 'el_class',
				'description' => 'Add a class to this inner column',
				'class' => 'tdc-textfield-extrabig',
			),
			array (
				'param_name' => 'css',
				'value' => '',
				'type' => 'css_editor',
				'heading' => 'Css',
				'group' => 'Design options',
			),
			array (
	            'param_name' => 'tdc_css',
	            'value' => '',
	            'type' => 'tdc_css_editor',
	            'heading' => '',
	            'group' => 'Design options',
	        ),
		)
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_column_text',
		'name' => __( 'Column text', 'td_composer' ),
		'icon' => 'icon-wpb-column-text',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Column text description', 'td_composer' ),
		'params' => array_merge(
			$block_general_params_array,
			array(
				array(
					"param_name" => "content",
					"type" => "textarea_html",
					"holder" => "div",
					'class' => '',
					"heading" => 'Text',
					"value" => __('Html code here! Replace this with any non empty html code and that\'s it', 'td_composer' ),
					"description" => 'Enter your content'
				),
				array(
					"param_name" => "separator",
					"type" => "horizontal_separator",
					"value" => "",
					"class" => ""
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class', 'td_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'td_composer' ),
					'value' => '',
					'class' => 'tdc-textfield-extrabig',
				),

				array (
					'param_name' => 'css',
					'value' => '',
					'type' => 'css_editor',
					'heading' => 'Css',
					'group' => 'Design options',
				),
				array (
		            'param_name' => 'tdc_css',
		            'value' => '',
		            'type' => 'tdc_css_editor',
		            'heading' => '',
		            'group' => 'Design options',
		        ),
			)
		)
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_raw_html',
		'name' => __( 'Raw html', 'td_composer' ),
		'icon' => 'icon-wpb-raw-html',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Raw html description', 'td_composer' ),
		'params' => array(
			array(
				"param_name" => "content",
				"type" => "textarea_raw_html",
				"holder" => "div",
				'class' => '',
				"heading" => 'Text',
				"value" => base64_encode(__('Html code here! Replace this with any non empty raw html code and that\'s it', 'td_composer' ) ),
				"description" => 'Enter your content.'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class', 'td_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'td_composer' ),
				'value' => '',
				'class' => 'tdc-textfield-extrabig',
			),

			array (
				'param_name' => 'css',
				'value' => '',
				'type' => 'css_editor',
				'heading' => 'Css',
				'group' => 'Design options',
			),
			array (
	            'param_name' => 'tdc_css',
	            'value' => '',
	            'type' => 'tdc_css_editor',
	            'heading' => '',
	            'group' => 'Design options',
	        ),
		),
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_empty_space',
		'name' => __( 'Empty space', 'td_composer' ),
		'icon' => 'icon-wpb-empty-space',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Empty space description', 'td_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Height', 'td_composer' ),
				'param_name' => 'height',
				'description' => __( 'Custom height of the empty space', 'td_composer' ),
				'value' => '32px',
				'class' => 'tdc-textfield-extrabig',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class', 'td_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'td_composer' ),
				'value' => '',
				'class' => 'tdc-textfield-extrabig',
			),
			array(
				'param_name' => 'css',
				'value' => '',
				'type' => 'css_editor',
				'heading' => 'Css',
				'group' => 'Design options',
			),
			array(
	            'param_name' => 'tdc_css',
	            'value' => '',
	            'type' => 'tdc_css_editor',
	            'heading' => '',
	            'group' => 'Design options',
	        )
		)
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_widget_sidebar',
		'name' => __( 'Widget sidebar', 'td_composer' ),
		'icon' => 'icon-wpb-layout_sidebar',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Widget sidebar description', 'td_composer' ),
		'params' => array(
			array(
					'param_name' => 'sidebar_id',
					'heading' => 'Sidebar',
					'type' => 'dropdown',

					// The parameter is set at 'admin_head' action, there the global $wp_registered_sidebars being set (otherwise it could be set at 'init')
					// Important! Here is too early to use the global $wp_registered_sidebars, because it isn't set
					'value' => array(),
					'class' => 'tdc-widget-sidebar-dropdown tdc-dropdown-extrabig',
				),
			array(
					'type' => 'textfield',
					'heading' => __( 'Extra class', 'td_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'td_composer' ),
					'value' => '',
					'class' => 'tdc-textfield-extrabig',
				)
		)
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_single_image',
		'name' => __( 'Single image', 'td_composer' ),
		'icon' => 'icon-wpb-empty-space',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Single image description', 'td_composer' ),
		'params' => array(
			array(
                "param_name" => "image",
                "type" => "attach_image",
                "value" => '',
                "heading" => __( "Image", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "",
            ),
			array(
                "param_name" => "image_url",
                "type" => "textfield",
                "value" => '',
                "heading" => __( "Image link", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-textfield-extrabig"
            ),
			array(
                "param_name" => "open_in_new_window",
                "type" => "checkbox",
                "value" => '',
                "heading" => __( "Open in new window",  'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "",
            ),
			array(
                "param_name" => "height",
                "type" => "textfield",
                "value" => '',
                "heading" => __( 'Image height', 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-textfield-small"
            ),
			array(
				"param_name" => "repeat",
				"type" => "dropdown",
				"value" => array(
					'No Repeat' => '',
					'Tile' => 'repeat',
					'Tile Horizontally' => 'repeat-x',
					'Tile Vertically' => 'repeat-y'
				),
				"heading" => __( 'Image repeat', 'td_composer' ),
				"description" => "",
				"holder" => "div",
				"class" => "tdc-dropdown-big",
			),
			array(
				"param_name" => "size",
				"type" => "dropdown",
				"value" => array(
					'Cover' => '',
					'Full Width' => '100% auto',
					'Full Height' => 'auto 100%',
					'Auto' => 'auto',
					'Contain' => 'contain'
				),
				"heading" => __( 'Image size', 'td_composer' ),
				"description" => "",
				"holder" => "div",
				"class" => "tdc-dropdown-big",
			),
            array(
                "param_name" => "alignment",
                "type" => "dropdown",
                "value" => array(
                    'Top' => 'top',
                    'Center' => '',
                    'Bottom' => 'bottom'
                ),
                "heading" => __( 'Image alignment', 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
            ),
			array(
                "param_name" => "style",
                "type" => "dropdown",
                "value" => array(
                    'Default' => '',
                    'Rounded' => 'style-rounded',
                    'Border' => 'style-border',
                    'Outline' => 'style-outline',
                    'Shadow' => 'style-shadow',
                    'Bordered Shadow' => 'style-bordered-shadow',
                    '3D Shadow' => 'style-3d-shadow',
                    'Round' => 'style-round',
                    'Round Border' => 'style-round-border',
                    'Round Outline' => 'style-round-outline',
                    'Round Shadow' => 'style-round-shadow',
                    'Round Border Shadow' => 'style-round-border-shadow',
                    'Circle' => 'style-circle',
                    'Circle Border' => 'style-circle-border',
                    'Circle Outline' => 'style-circle-outline',
                    'Circle Shadow' => 'style-circle-shadow',
                    'Circle Border Shadow' => 'style-circle-border-shadow',
                ),
                "heading" => __( 'Box style', 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
            ),
			array(
                'param_name' => 'el_class',
                'type' => 'textfield',
                'value' => '',
                'heading' => 'Extra class',
                'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
                'class' => 'tdc-textfield-extrabig'
            ),

			array (
                'param_name' => 'css',
                'value' => '',
                'type' => 'css_editor',
                'heading' => 'Css',
                'group' => 'Design options',
            ),
            array (
                'param_name' => 'tdc_css',
                'value' => '',
                'type' => 'tdc_css_editor',
                'heading' => '',
                'group' => 'Design options',
            ),
		),
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_separator',
		'name' => __( 'Separator', 'td_composer' ),
		'icon' => 'icon-wpb-empty-space',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Separator description', 'td_composer' ),
		'params' => array(
			array(
                "param_name" => "color",
                "type" => "colorpicker",
                "value" => '#EBEBEB',
                "heading" => __( "Color", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "",
            ),
			array(
                "param_name" => "align",
                "type" => "dropdown",
                "value" => array(
                    'Center' => 'align_center',
                    'Left' => 'align_left',
                    'Right' => 'align_right',
                ),
                "heading" => __( "Alignment", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big"
            ),
			array(
                "param_name" => "style",
                "type" => "dropdown",
                "value" => array(
                    'Border' => 'solid',
                    'Dashed' => 'dashed',
                    'Dotted' => 'dotted',
                    'Double' => 'double',
                    'Shadow' => 'shadow',
                ),
                "heading" => __( "Style", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big"
            ),
			array(
                "param_name" => "border_width",
                "type" => "dropdown",
                "value" => array(
                    '1px' => '1',
                    '2px' => '2',
                    '3px' => '3',
                    '4px' => '4',
                    '5px' => '5',
                    '6px' => '6',
                    '7px' => '7',
                    '8px' => '8',
                    '9px' => '9',
                    '10px' => '10',
                ),
                "heading" => __( "Border width", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big"
            ),
			array(
                "param_name" => "el_width",
                "type" => "dropdown",
                "value" => array(
                    '100%' => '',
                    '90%' => '90',
                    '80%' => '80',
                    '70%' => '70',
                    '60%' => '60',
                    '50%' => '50',
                    '40%' => '40',
                    '30%' => '30',
                    '20%' => '20',
                    '10%' => '10',
                ),
                "heading" => __( "Element width", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big"
            ),

			array(
                'param_name' => 'el_class',
                'type' => 'textfield',
                'value' => '',
                'heading' => 'Extra class',
                'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
                'class' => 'tdc-textfield-extrabig'
            ),

			array (
                'param_name' => 'css',
                'value' => '',
                'type' => 'css_editor',
                'heading' => 'Css',
                'group' => 'Design options',
            ),
            array (
                'param_name' => 'tdc_css',
                'value' => '',
                'type' => 'tdc_css_editor',
                'heading' => '',
                'group' => 'Design options',
            ),
		),
	)
);

tdc_mapper::map_shortcode(
	array(
		'base' => 'vc_wp_recentcomments',
		'name' => __( 'Recent comments', 'td_composer' ),
		'icon' => 'icon-wpb-empty-space',
		'category' => __( 'Content', 'td_composer' ),
		'description' => __( 'Description', 'td_composer' ),
		'params' => array_merge(
			$block_general_params_array,
            array(
				array(
	                "param_name" => "number",
					"type" => "textfield",
					"value" => "",
					"heading" => 'Number of comments:',
					"description" => "Optional - a title for this block, if you leave it blank the block will not have a title",
					"holder" => "div",
					'class' => 'tdc-textfield-small'
	            ),
				array(
	                'param_name' => 'el_class',
	                'type' => 'textfield',
	                'value' => '',
	                'heading' => 'Extra class',
	                'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
	                'class' => 'tdc-textfield-extrabig'
	            ),

				array (
	                'param_name' => 'css',
	                'value' => '',
	                'type' => 'css_editor',
	                'heading' => 'Css',
	                'group' => 'Design options',
	            ),
	            array (
	                'param_name' => 'tdc_css',
	                'value' => '',
	                'type' => 'tdc_css_editor',
	                'heading' => '',
	                'group' => 'Design options',
	            ),
            )
		),
	)
);


function register_external_shortcodes() {

	global $shortcode_tags;
	require_once('shortcodes/tdc_external_shortcode.php' );

	// Overwrite the existing shortcode
	// In composer - a custom placeholder is used instead of the callback result
	// In frontend, for registered shortcodes - a wrapper is applied to the existing callback result
	// In frontend, for not registered shortcodes - a 'missing shortcode' placeholder is shown

	$mapped_shortcodes = tdc_mapper::get_mapped_shortcodes();

	foreach ( tdc_mapper::get_external_shortcodes() as $shortcode_tag => $shortcode_params ) {

		if ( isset( $shortcode_tags[ $shortcode_tag ] ) ) {

//			// The social counter plugin, even it is external shorcode, is our shortcode and we trust its js
			if ( 'td_block_social_counter' !== $shortcode_tag ) {
				add_shortcode( $shortcode_tag, 'tdc_proxy_external_shortcode' );
			}

		} else {
			add_shortcode( $shortcode_tag, 'tdc_proxy_missing_external_shortcode' );
		}

		// Important! We need to check the already mapped shortcodes, because social counter plugin comes, even it is external, it's our external plugin, and it does itself mapping
		if ( ! isset( $mapped_shortcodes[ $shortcode_tag ] ) ) {
			tdc_mapper::map_shortcode( $shortcode_params );
		}
	}
}

function tdc_proxy_external_shortcode($atts, $content, $tag) {
	$external_shortcode = new tdc_external_shortcode($tag);
	return $external_shortcode->render($atts, $content, $tag);
}

/**
 * Proxy function - to overwrite the existing shortcode
 */
function wrap_external_shortcodes() {

	foreach ( tdc_mapper::get_external_shortcodes() as $shortcode_tag => $shortcode_params ) {
		global $shortcode_tags;

		if ( ! isset( $shortcode_tags[ $shortcode_tag ] ) ) {

			// In frontend, for not registered shortcodes - a 'missing shortcode' info placeholder is shown
			add_shortcode( $shortcode_tag, 'tdc_proxy_missing_external_shortcode');
		}
	}
}

function tdc_proxy_missing_external_shortcode($atts, $content, $tag) {
	if ( current_user_can( 'administrator' ) ) {

		// The unique class 'td_uid_...' is just added to see that shortcode update in tagDiv composer
		return '<div class="td_block_wrap tdc-missing-external-shortcode ' . tdc_util::generate_unique_id() . '"><span>' . $tag . '</span>Missing shortcode. Activate plugin!</div>';
	}
	return '';
}

