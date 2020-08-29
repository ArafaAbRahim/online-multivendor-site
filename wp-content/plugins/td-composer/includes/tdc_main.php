<?php
/**
 * Created by ra.
 * Date: 4/14/2016
 */


// Ready to load the shortcodes
require_once('tdc_util.php');
require_once('tdc_state.php');
require_once('tdc_ajax.php');


// shortcodes
require_once('tdc_composer_block.php' );
require_once('shortcodes/vc_row.php' );
require_once('shortcodes/vc_row_inner.php' );
require_once('shortcodes/vc_column.php' );
require_once('shortcodes/vc_column_inner.php' );
require_once('shortcodes/vc_column_text.php' );
require_once('shortcodes/vc_raw_html.php' );
require_once('shortcodes/vc_empty_space.php' );
require_once('shortcodes/vc_widget_sidebar.php' );
require_once('shortcodes/vc_single_image.php' );
require_once('shortcodes/vc_separator.php' );
require_once('shortcodes/vc_wp_recentcomments.php' );



// mapper and internal map
require_once('tdc_mapper.php');
require_once('tdc_map.php');


/**
 * WP-admin - add js in header on all the admin pages (wp-admin and the iframe Wrapper. Does not run in the iframe)
 * It's on general, and not only for 'td-action=tdc' because it's also used on widgets' page.
 */
add_action( 'admin_head', 'tdc_on_admin_head' );
function tdc_on_admin_head() {

	//map_not_registered_shortcodes();

	$mappedShortcodes = tdc_mapper::get_mapped_shortcodes();
	$mappedBlockTemplates = tdc_mapper::get_mapped_block_templates();

	global $wp_registered_sidebars;

	foreach ( $mappedShortcodes as &$mappedShortcode ) {

		if ( 'vc_widget_sidebar' === $mappedShortcode[ 'base' ] ) {
			foreach ( $mappedShortcode[ 'params' ] as &$param ) {
				if ( 'sidebar_id' === $param[ 'param_name' ] ) {

					$param[ 'value' ][ __( '- Please select a sidebar -', 'td_composer' ) ] = '';

					foreach ( $wp_registered_sidebars as $key => $val ) {
						$param[ 'value' ][ $val[ 'name' ] ] = $key;
					}
					break;
				}
			}
			continue;
		}

		// Replace the 'dropdown' params values with values of the 'tdc_value' index (because VC does not render well default values of dropdown params)
		if ( 'td_block_instagram' === $mappedShortcode[ 'base' ] ||
			 'td_block_exchange' === $mappedShortcode[ 'base' ] ) {
			foreach ( $mappedShortcode[ 'params' ] as &$param ) {
				if ( 'dropdown' === $param[ 'type' ] && isset($param['tdc_value'] ) ) {

					$param['value'] = $param['tdc_value'];
				}
			}
			continue;
		}
	}

	// the settings that we load in wp-admin and wrapper. We need json to be sure we don't get surprises with the encoding/escaping
	$tdc_admin_settings = array(
		'adminUrl' => admin_url(),
		'editPostUrl' => get_edit_post_link( get_the_ID(), '' ),
		'wpRestNonce' => wp_create_nonce('wp_rest'),
		'wpRestUrl' => rest_url(),
		'permalinkStructure' => get_option('permalink_structure'),
		'pluginUrl' => TDC_URL,
		'mappedShortcodes' => $mappedShortcodes, // get ALL the mapped shortcodes / we should turn off pretty print
		'mappedBlockTemplates' => $mappedBlockTemplates, // get ALL the mapped block templates / we should turn off pretty print
		'customized' => array(
			'menus' => new stdClass()
		),
		'registeredSidebars' => $GLOBALS['wp_registered_sidebars'],
		'hasUserRights' => is_user_logged_in() && current_user_can('switch_themes'),
	);

	ob_start();
	?>
	<script>
		window.tdcAdminSettings = <?php echo json_encode( $tdc_admin_settings );?>;
		//console.log(window.tdcAdminSettings);
	</script>
	<?php
	$buffer = ob_get_clean();
	echo $buffer;
}


add_action( 'after_setup_theme', 'tdc_on_register_external_shortcodes' );
function tdc_on_register_external_shortcodes() {

	if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
		register_external_shortcodes();
	} else {
		wrap_external_shortcodes();
	}
}


//add_filter( 'the_content', 'tdc_on_the_content' );
//function tdc_on_the_content( $content ) {
//
//	$mappedShortcodes = tdc_mapper::get_mapped_shortcodes();
//
//	//var_dump( $mappedShortcodes ); die;
//
//	global $shortcode_tags;
//
//	if (empty($shortcode_tags) || !is_array($shortcode_tags))
//		return $content;
//
//	// Find all registered tag names in $content.
//	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
//	$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
//
//	if ( empty( $tagnames ) ) {
//		return $content;
//	}
//
//	foreach( $tagnames as $tagname ) {
//		if ( ! array_key_exists( $tagname, $mappedShortcodes ) ) {
//			add_shortcode( $tagname, 'tdc_external_shortcode' );
//		}
//	}
//
//	return $content;
//}
//
//function tdc_external_shortcode($atts, $content, $name) {
//	return '<div class="td_block_wrap tdc-external-shortcode">Shortcode: ' . $name .'</div>';
//}


/**
 * WP-admin - Edit page with tagDiv composer
 */
add_action('admin_bar_menu', 'tdc_on_admin_bar_menu', 100);
function tdc_on_admin_bar_menu() {
	global $wp_admin_bar, $post;
	//print_r($wp_admin_bar);
	//die;

//  if (!current_user_can('edit_pages') || !is_admin_bar_showing() || !is_page()) {
//		return;
//	}

	if (is_user_logged_in() && current_user_can('switch_themes') && is_admin_bar_showing() && is_page()) {
		$wp_admin_bar->add_menu( array(
			'id'    => 'tdc_edit',
			'meta'  => array(
				'title' => 'Edit with TD Composer'
			),
			'title' => 'Edit with TD Composer',
			'href'  => admin_url( 'post.php?post_id=' . $post->ID . '&td_action=tdc' )
		) );
	}
}





/**
 * Registers the js script:
 */
add_action( 'admin_enqueue_scripts', 'tdc_on_admin_enqueue_scripts' );
function tdc_on_admin_enqueue_scripts() {

	// load the css
	if ( true === TDC_USE_LESS ) {
		wp_enqueue_style('tdc_wp_admin_main', TDC_URL . '/td_less_style.css.php?part=tdc_wp_admin_main', false, false );
	} else {
		wp_enqueue_style('tdc_wp_admin_main', TDC_URL . '/assets/css/tdc_wp_admin_main.css', false, false);
	}



	// load the js
    if (TDC_DEPLOY_MODE == 'deploy') {
        wp_enqueue_script('js_files_for_wp_admin', TDC_URL . '/assets/js/js_files_for_wp_admin.min.js', array('jquery', 'underscore'), TDC_VERSION, true);
    } else {
        tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_wp_admin, array('jquery', 'underscore'));
    }

	// Disable the confirmation messages at leaving pages
	if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
		wp_dequeue_script( 'autosave' );
	}
}



// Set the tdc_state
$td_action = tdc_util::get_get_val( 'td_action' );
if ( false === $td_action ) {
	tdc_state::set_is_live_editor_iframe( false );
} else {
	tdc_state::set_is_live_editor_iframe( true );
}

$tmpJobId = tdc_util::get_get_val( 'uuid' );
if ( false === $tmpJobId ) {
	tdc_state::set_is_live_editor_ajax( false );
} else {
	tdc_state::set_is_live_editor_ajax( true );
}



//// Add external shortcodes
//if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
//	register_external_shortcodes();
//
//	// Change the callbacks of the shortcodes not registered in TagDiv Composer
//	// Important! Here it's too late to map these shortcodes, the mapping should be where the '$tdc_admin_settings' is set (@see 'admin_head' action)
//	add_filter( 'the_content', 'tdc_on_the_content' );
//	function tdc_on_the_content( $content ) {
//
//		$mappedShortcodes = tdc_mapper::get_mapped_shortcodes();
//
//		//var_dump( $mappedShortcodes ); die;
//
//		global $shortcode_tags;
//
//		if (empty($shortcode_tags) || !is_array($shortcode_tags))
//			return $content;
//
//		// Find all registered tag names in $content.
//		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
//		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
//
//		if ( empty( $tagnames ) ) {
//			return $content;
//		}
//
//		foreach( $tagnames as $tagname ) {
//			if ( ! array_key_exists( $tagname, $mappedShortcodes ) ) {
//				add_shortcode( $tagname, 'tdc_external_shortcode' );
//			}
//		}
//
//		global $vc_shortcodes;
//
//		foreach( $vc_shortcodes as $vc_shortcode ) {
//			add_shortcode( $vc_shortcode, 'tdc_external_shortcode' );
//		}
//
//		return $content;
//	}
//}




//function tdc_map_not_registered_shortcodes($postId) {
//	$currentPost = get_post($postId);
//
//	$mappedShortcodes = tdc_mapper::get_mapped_shortcodes();
//
//	//var_dump( $mappedShortcodes ); die;
//
//	global $shortcode_tags;
//
//	if (empty($shortcode_tags) || !is_array($shortcode_tags))
//		return;
//
//	// Find all registered tag names in $content.
//	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $currentPost->post_content, $matches );
//	$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
//
//	if ( empty( $tagnames ) ) {
//		return;
//	}
//
//	foreach( $tagnames as $tagname ) {
//		if ( ! array_key_exists( $tagname, $mappedShortcodes ) ) {
//			add_shortcode( $tagname, 'tdc_external_shortcode' );
//		}
//	}
//
//	global $vc_shortcodes;
//
//	foreach( $vc_shortcodes as $vc_shortcode ) {
//		add_shortcode( $vc_shortcode, 'tdc_external_shortcode' );
//	}
//}

if (!empty($td_action)) {

	// $_GET['post_id'] is requiered from now on
	$post_id = tdc_util::get_get_val( 'post_id' );
	if (empty($post_id)) {
		tdc_util::error(__FILE__, __FUNCTION__, 'No post_id received via GET');
		die;
	}


	switch ($td_action) {

		case 'tdc':
			// Wrapper edit page
			$current_post = get_post($post_id);
			do_action_ref_array( 'the_post', array( &$current_post ) );

			tdc_state::set_post($current_post);



			/**
			 *  on wrap body class
			 */
			add_filter( 'admin_body_class', 'on_admin_body_class_wrap');
			function on_admin_body_class_wrap() {
				return 'tdc';
			}


			/**
			 * on wrapper current_screen
			 */
			add_action( 'current_screen', 'on_current_screen_load_wrap');
			function on_current_screen_load_wrap() {

				// @todo The 'tiny_mce' doesn't work as dependency. That's why it was independently loaded
				wp_enqueue_script( 'tiny_mce', includes_url( '/js/tinymce/tinymce.min.js' ) );
				//wp_enqueue_script( 'tiny_mce', '//tinymce.cachefly.net/4.1/tinymce.min.js' );



                if (TDC_DEPLOY_MODE == 'deploy') {
                    wp_enqueue_script('js_files_for_wrapper', TDC_URL . '/assets/js/js_files_for_wrapper.min.js', array(
                        'jquery',
                        'backbone',
                        'underscore'
                    ), TDC_VERSION, true);
                } else {
                    tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_wrapper, array(
                        'jquery',
                        'backbone',
                        'underscore'
                    ));
                }



				if ( true === TDC_USE_LESS ) {
					wp_enqueue_style('td_composer_edit', TDC_URL . '/td_less_style.css.php?part=wrap_main', false, false);
				} else {
					wp_enqueue_style('td_composer_edit', TDC_URL . '/assets/css/wrap_main.css', false, false);
				}


				remove_all_actions('admin_notices');
				remove_all_actions('network_admin_notices');

				// Disables all the updates notifications regarding plugins, themes & WordPress completely.
				tdc_disable_notification();

				require_once('templates/frontend.tpl.php');
				die;
			}
			break;


		case 'tdc_edit':

			// Iframe content post
			add_filter( 'show_admin_bar', '__return_false' );

			add_filter( 'body_class', 'tdc_on_body_class' );
			function tdc_on_body_class( $classes ) {
				$classes[] = 'tdc-theme-' . TD_THEME_NAME;
				return $classes;
			}

			add_filter( 'the_content', 'tdc_on_the_content', 10000, 1 );
			function tdc_on_the_content( $content ) {

				if ( isset( $_POST['tdc_content'] ) ) {

					//echo $_POST['tdc_content'];die;
					//return $_POST['tdc_content'];
					return do_shortcode( stripslashes ( $_POST['tdc_content'] ) );
				}

				return $content;
			}

			add_filter( 'get_post_metadata', 'tdc_on_get_post_metadata', 10, 4 );
			function tdc_on_get_post_metadata( $value, $object_id, $meta_key, $single ) {

				tdc_state::set_customized_settings();

				if ( 'td_mega_menu_cat' === $meta_key || 'td_mega_menu_page_id' === $meta_key ) {
					// Look inside of the customized menu settings

					$customized_menu_settings = tdc_state::get_customized_menu_settings();

					if ( false !== $customized_menu_settings ) {
						foreach ( $customized_menu_settings as $key_menu_settings => $value_menu_settings ) {
							if ( isset($value_menu_settings[ $meta_key .'[' . $object_id . ']' ] ) ) {
								return $value_menu_settings[ $meta_key .'[' . $object_id . ']' ];
							}
						}
					}

				} else if ( 'td_homepage_loop' === $meta_key || 'td_page' === $meta_key ) {
					// Look inside of the customized page settings

					$customized_page_settings = tdc_state::get_customized_page_settings();

					if ( false !== $customized_page_settings ) {
						return array( $customized_page_settings[ $meta_key ] );
					}

				} else if ( '_wp_page_template' === $meta_key ) {
					$customized_page_settings = tdc_state::get_customized_page_settings();

					if ( false !== $customized_page_settings ) {
						return array( $customized_page_settings[ 'page_template' ] );
					}
				}
				return $value;
			}

			add_filter( 'wp_get_nav_menu_items', 'tdc_on_wp_get_nav_menu_items', 10, 3 );
			function tdc_on_wp_get_nav_menu_items( $items, $menu, $args ) {

				//var_dump($menu);

				tdc_state::set_customized_settings();
				$menu_settings = tdc_state::get_customized_menu_settings( $menu->term_id );

				if ( false !== $menu_settings ) {

					//var_dump($menu_settings);
					//return $items;

					$new_items = array();

					foreach ( $menu_settings as $key => $value) {

						if ( 0 === strpos( $key, 'menu-item-db-id' ) ) {

							$item = new stdClass();

							$item->ID = $value;
							$item->post_type = 'nav_menu_item';

							if ( isset($menu_settings[ "menu-item-object-id[$value]" ] ) ) {
								$item->object_id = $menu_settings[ "menu-item-object-id[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-object[$value]" ] ) ) {
								$item->object = $menu_settings[ "menu-item-object[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-parent-id[$value]" ] ) ) {
								$item->menu_item_parent = $menu_settings[ "menu-item-parent-id[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-type[$value]" ] ) ) {
								$item->type = $menu_settings[ "menu-item-type[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-title[$value]" ] ) ) {
								$item->title = $menu_settings[ "menu-item-title[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-url[$value]" ] ) ) {
								$item->url = $menu_settings[ "menu-item-url[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-title[$value]" ] ) ) {
								$item->title = $menu_settings[ "menu-item-title[$value]" ];
								$item->post_title = $item->title;
							}

							if ( isset($menu_settings[ "menu-item-attr-title[$value]" ] ) ) {
								$item->attr_title = $menu_settings[ "menu-item-attr-title[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-description[$value]" ] ) ) {
								$item->description = $menu_settings[ "menu-item-description[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-classes[$value]" ] ) ) {
								$item->classes = $menu_settings[ "menu-item-classes[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-xfn[$value]" ] ) ) {
								$item->xfn = $menu_settings[ "menu-item-xfn[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-position[$value]" ] ) ) {
								$item->menu_order = $menu_settings[ "menu-item-position[$value]" ];
							}

							if ( isset($menu_settings[ "menu-item-db-id[$value]" ] ) ) {
								$item->db_id = $menu_settings[ "menu-item-db-id[$value]" ];
							}

							if ( isset($menu_settings[ "td_mega_menu_cat[$value]" ] ) ) {
								$item->td_mega_menu_cat = $menu_settings[ "td_mega_menu_cat[$value]" ];
							}

							if ( isset($menu_settings[ "td_mega_menu_page_id[$value]" ] ) ) {
								$item->td_mega_menu_page_id = $menu_settings[ "td_mega_menu_page_id[$value]" ];
							}



							// CODE SECTION FROM wp customizer >>>

							$post = new WP_Post( (object) $item );

							if ( empty( $post->post_author ) ) {
								$post->post_author = get_current_user_id();
							}

							if ( ! isset( $post->type_label ) ) {
								if ( 'post_type' === $post->type ) {
									$object = get_post_type_object( $post->object );
									if ( $object ) {
										$post->type_label = $object->labels->singular_name;
									} else {
										$post->type_label = $post->object;
									}
								} elseif ( 'taxonomy' == $post->type ) {
									$object = get_taxonomy( $post->object );
									if ( $object ) {
										$post->type_label = $object->labels->singular_name;
									} else {
										$post->type_label = $post->object;
									}
								} else {
									$post->type_label = __( 'Custom Link' );
								}
							}

							/** This filter is documented in wp-includes/nav-menu.php */
							$post->attr_title = apply_filters( 'nav_menu_attr_title', $post->attr_title );

							/** This filter is documented in wp-includes/nav-menu.php */
							$post->description = apply_filters( 'nav_menu_description', wp_trim_words( $post->description, 200 ) );

							/** This filter is documented in wp-includes/nav-menu.php */
							$post = apply_filters( 'wp_setup_nav_menu_item', $post );

							// <<< CODE SECTION FROM wp customizer

							$new_items[] = $post;
						}
					}

					// CODE SECTION FROM wp customizer >>>
					foreach ( $new_items as $item ) {
						foreach ( get_object_vars( $item ) as $key => $value ) {
							$item->$key = $value;
						}
					}
					// <<< CODE SECTION FROM wp customizer

					//print_r($new_items);

					return $new_items;
				}
				return $items;
			}

			/**
			 * iframe enqueue scripts
			 */
			add_action( 'wp_enqueue_scripts', 'on_wp_enqueue_scripts_iframe', 1010); // load them last
			function on_wp_enqueue_scripts_iframe() {

                if (TDC_DEPLOY_MODE == 'deploy') {
                    wp_enqueue_script('js_files_for_iframe', TDC_URL . '/assets/js/js_files_for_iframe.min.js', array(
                        'jquery',
                        'underscore'
                    ), TDC_VERSION, true);
                } else {
                    tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_iframe, array(
                        'jquery',
                        'underscore'
                    ));
                }




				if ( true === TDC_USE_LESS ) {
					wp_enqueue_style('td_composer_iframe_main', TDC_URL . '/td_less_style.css.php?part=iframe_main', false, false);
				} else {
					wp_enqueue_style('td_composer_iframe_main', TDC_URL . '/assets/css/iframe_main.css', false, false);
				}
			}





			// This stops 'td_animation_stack' library to be applied
			// @todo - trebuie sa fie din thema?
			td_options::update_temp('tds_animation_stack', 'lorem ipsum ..');
			break;



		default:
			// Unknown td_action - kill execution
			tdc_util::error(__FILE__, __FUNCTION__, 'Unknown td_action received: ' . $td_action);
			die;
	}


}



//global $vc_shortcodes;
//
//$vc_shortcodes = array(
//	'vc_btn',
//	'vc_icon',
//	'vc_tta_tabs',
//	'vc_tta_section'
//);
//
//
//
//function map_not_registered_shortcodes() {
//
//	global $post;
//
//	if (!isset($post)) {
//		return;
//	}
//
//	$mappedShortcodes = tdc_mapper::get_mapped_shortcodes();
//
//	//var_dump( $mappedShortcodes ); die;
//
//	global $shortcode_tags;
//
//	//var_dump($shortcode_tags); die;
//
//	if (empty($shortcode_tags) || !is_array($shortcode_tags))
//		return;
//
//	// Find all registered tag names in $content.
//	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $post->post_content, $matches );
//	$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
//
//	if ( empty( $tagnames ) ) {
//		return;
//	}
//
//	foreach( $tagnames as $tagname ) {
//		if ( ! array_key_exists( $tagname, $mappedShortcodes ) ) {
//
//			tdc_mapper::map_shortcode(
//				array(
//					'map_in_visual_composer' => true,
//					'base' => $tagname,
//					'name' => $tagname,
//					'params' => array(
//						array(
//							'type' => 'textfield',
//							'heading' => 'Extra class name',
//							'param_name' => 'el_class',
//							'description' => '',
//						)
//					)
//				)
//			);
//		}
//	}
//
//	global $vc_shortcodes;
//
//	foreach ($vc_shortcodes as $vc_shortcode) {
//		tdc_mapper::map_shortcode(
//			array(
//				'map_in_visual_composer' => true,
//				'base' => $vc_shortcode,
//				'name' => $vc_shortcode,
//				'params' => array(
//					array(
//						'type' => 'textfield',
//						'heading' => 'Extra class name',
//						'param_name' => 'el_class',
//						'description' => '',
//					)
//				)
//			)
//		);
//	}
//}


/**
 * edit with td composer
 */
if ( is_user_logged_in() && current_user_can('switch_themes')) {
	add_filter( 'page_row_actions', 'tdc_on_page_row_actions', 10, 2 );
	function tdc_on_page_row_actions( $actions, $post ) {
		$actions['edit_tdc_composer'] = '<a href="' . admin_url( 'post.php?post_id=' . $post->ID . '&td_action=tdc' ) . '">Edit with TD Composer</a>';
		return $actions;
	}
}





add_action('admin_head', 'on_admin_head_add_tdc_loader');
function on_admin_head_add_tdc_loader() {
	if (!tdc_state::is_live_editor_iframe()) {
		return;
	}
	?>
	<style>
		body > * {
			opacity:0;
		}

		.tdc-fullscreen-loader-wrap {
			opacity: 1 !important;
		}
	</style>


	<div class="tdc-fullscreen-loader-wrap" style=""></div>

	<?php
}




// Set the tdc_state
$tdcMenuSettings = tdc_util::get_get_val( 'tdc-menu-settings' );
if ( 'nav-menus' === basename($_SERVER["SCRIPT_FILENAME"], '.php') && false !== $tdcMenuSettings ) {
	add_action('admin_head', 'on_admin_head_add_menu_settings');
	function on_admin_head_add_menu_settings() {
		?>
		<style>
			#wpcontent {
			    margin-left: 0;
				margin-top: -30px;
			}

			#nav-menus-frame {
				margin-top: 0;
			}

			#wpadminbar,
			#screen-meta,
			#screen-meta-links,
			#adminmenumain,
			#wpfooter,
			.wrap > h1,
			.wrap > h2,
			.wrap > .manage-menus,
			.menu-save,
			.delete-action,
			.error,
			.update-nag,
			.major-publishing-actions,
			.menu-settings {
				display: none !important;
			}

			#wpbody-content {
				padding-bottom: 0;
			}

		</style>

		<script>
			(function(){

				jQuery(window).load(function() {
					var $wpbodyContent = jQuery( '#wpbody-content' );
						$wrap = $wpbodyContent.children( '.wrap' );


					$wrap.siblings().hide();

					$wrap.children().each(function(index, el) {
						var $el = jQuery(el),
							elId = $el.attr( 'id' );
						if ( 'nav-menus-frame' !== elId ) {
							$el.hide();
						}
					});

				});

			})();
		</script>
		<?php

		// Disables all the updates notifications regarding plugins, themes & WordPress completely.
		tdc_disable_notification();
	}
}


// Set the tdc_state
$tdcPageSettings = tdc_util::get_get_val( 'tdc-page-settings' );
if ( 'post' === basename($_SERVER["SCRIPT_FILENAME"], '.php') && false !== $tdcPageSettings ) {
	add_action('admin_head', 'on_admin_head_add_page_settings');
	function on_admin_head_add_page_settings() {
		?>
		<style>
			#wpcontent {
			    margin-left: 0;
				margin-top: -30px;
			}

			#nav-menus-frame {
				margin-top: 0;
			}

			#wpadminbar,
			#screen-meta,
			#screen-meta-links,
			#adminmenumain,
			#wpfooter,
			.wrap > h1,
			.wrap > h2,
			.wrap > .manage-menus,
			.menu-save,
			.delete-action,
			.error,
			.update-nag,
			.major-publishing-actions,

			.page-title-action,
			.notice,
			#submitdiv,
			#postimagediv,
			#post-body-content {
				display: none !important;
			}

			#wpbody-content {
				padding-bottom: 0;
			}


		</style>

		<script>
			(function(){

				jQuery(window).load(function() {
					var $wpbodyContent = jQuery( '#wpbody-content' ),
						$wrap = $wpbodyContent.children( '.wrap' ),
						$normalSortables = $wpbodyContent.find( '#normal-sortables' );


					$wrap.siblings().hide();
					$wrap.children( 'form' ).siblings().hide();

					$normalSortables.children().each(function(index, el) {
						var $el = jQuery(el),
							elId = $el.attr( 'id' );

						if ( 'td_homepage_loop_metabox' !== elId && 'td_page_metabox' !== elId ) {
							$el.hide();
						}
					});

				});

			})();
		</script>
		<?php

//		// Disables all the updates notifications regarding plugins, themes & WordPress completely.
//		tdc_disable_notification();


	}
}


/**
 * Disables all the updates notifications regarding plugins, themes & WordPress completely.
 */
function tdc_disable_notification() {
	add_filter( 'pre_site_transient_update_core','tdc_on_remove_core_updates' );
	add_filter( 'pre_site_transient_update_plugins','tdc_on_remove_core_updates' );
	add_filter( 'pre_site_transient_update_themes','tdc_on_remove_core_updates' );

	function tdc_on_remove_core_updates(){
		global $wp_version;
		return (object) array('last_checked'=> time(),'version_checked'=> $wp_version);
	}
}


// Add the necessary scripts for css tab on widgets
add_action( 'load-widgets.php', 'tdc_load_widget' );
function tdc_load_widget() {

	if (td_util::tdc_is_installed()) {

	    if (TDC_DEPLOY_MODE === 'deploy') {
            wp_enqueue_script('js_files_for_widget', TDC_URL . '/assets/js/js_files_for_widget.min.js', array(
                'jquery',
                'underscore',
                'backbone'
            ), TDC_VERSION, true);
        } else {
            // Load tdc js scripts needed for the css tab in the widget panel of the theme
            tdc_util::enqueue_js_files_array(tdc_config::$js_files_for_widget, array('jquery', 'underscore', 'backbone'));

//            wp_enqueue_script( 'tdcAdminIFrameUI', TDC_URL . '/assets/js/tdcAdminIFrameUI.js', array( 'underscore', 'backbone' ) );
//            wp_enqueue_script( 'tdcCssEditor', TDC_URL . '/assets/js/tdcCssEditor.js', array( 'underscore' ) );
//            wp_enqueue_script( 'tdcSidebarPanel', TDC_URL . '/assets/js/tdcSidebarPanel.js' );
//            wp_enqueue_script( 'tdcUtil', TDC_URL . '/assets/js/tdcUtil.js' );
//            wp_enqueue_script( 'tdcJobManager', TDC_URL . '/assets/js/tdcJobManager.js' );
        }


        // Add viewport intervals
        td_js_buffer::add_variable('td_viewport_interval_list', td_global::$td_viewport_intervals);

        // Load media
        add_action( 'admin_enqueue_scripts', 'on_load_widget_admin_enqueue_scripts' );
        function on_load_widget_admin_enqueue_scripts() {
            wp_enqueue_media();
        }

	}
}



// Remove the auto added paragraphs - as VC does
add_filter( 'the_content', 'tdc_on_remove_wpautop', 9 );
function tdc_on_remove_wpautop($content) {
	global $post;
	if ( 'page' === get_post_type() && td_util::is_pagebuilder_content( $post ) ) {
		remove_filter( 'the_content', 'wpautop' );
	}
	return $content;
}



//* --------------------------------------------
//* This will be used by preview '.tdc-view-page'
//* --------------------------------------------
//
//add_filter('the_preview', 'on_set_preview', 11, 1);
function on_set_preview( $post ) {

	global $post_preview;

	$post_preview = $post;

	if ( isset($_GET['tdc_preview']) ) {

		remove_filter( 'the_preview', '_set_preview', 10, 1 );
//	if ( ! is_object( $post ) ) {
//		return $post;
//	}
//
//	$preview = wp_get_post_autosave( $post->ID );
//	if ( ! is_object( $preview ) ) {
//		return $post;
//	}
//
//	$preview = sanitize_post( $preview );

		td_panel_data_source::post_preview_patch_options( $post_preview->ID );

		$post->post_content = get_post_meta( $post_preview->ID, 'tdc_preview_content', true );


//	$post->post_title = $preview->post_title;
//	$post->post_excerpt = $preview->post_excerpt;

		add_filter( 'get_the_terms', '_wp_preview_terms_filter', 10, 3 );
		add_filter( 'get_post_metadata', '_wp_preview_post_thumbnail_filter', 10, 3 );

		add_filter( 'get_post_metadata', 'tdc_on_get_post_metadata', 10, 4 );
		function tdc_on_get_post_metadata( $value, $object_id, $meta_key, $single ) {

			global $customized_menu_settings;

			if ( '_wp_page_template' === $meta_key ) {
				return get_post_meta( $object_id, 'tdc_preview_template', true );
			}

			if ( 'td_mega_menu_cat' === $meta_key || 'td_mega_menu_page_id' === $meta_key ) {
				// Look inside of the customized menu settings

				if ( isset( $customized_menu_settings ) ) {
					foreach ( $customized_menu_settings as $key_menu_settings => $value_menu_settings ) {
						if ( isset($value_menu_settings[ $meta_key .'[' . $object_id . ']' ] ) ) {
							return $value_menu_settings[ $meta_key .'[' . $object_id . ']' ];
						}
					}
				}
			}
			return $value;
		}


		add_filter( 'wp_get_nav_menu_items', 'tdc_on_wp_get_nav_menu_items', 10, 3 );
		function tdc_on_wp_get_nav_menu_items( $items, $menu, $args ) {

			//var_dump($menu);

			global $post_preview;
			global $customized_menu_settings;
			global $customized_settings;

			$tdc_preview_menu = get_post_meta( $post_preview->ID, 'tdc_preview_menu', true );

			if ( isset( $tdc_preview_menu ) ) {
				$customized_settings = json_decode( $tdc_preview_menu, true );

				if ( isset( $customized_settings['menus'] ) ) {

					$menus = $customized_settings['menus'];
					foreach ( $menus as $menu_key => $menu_value ) {
						$current_menu_settings = json_decode( $menu_value, true );

						foreach ( $current_menu_settings as $setting ) {
							$customized_menu_settings[ $menu_key ][ $setting['name'] ] = $setting['value'];
						}
					}
				}


				$menu_settings = array();

				if ( isset( $customized_menu_settings )  ) {
					if ( isset( $menu->term_id ) ) {
						if ( isset( $customized_menu_settings[ 'existing_menu_' . $menu->term_id ] ) ) {
							$menu_settings = $customized_menu_settings[ 'existing_menu_' . $menu->term_id ];
						}
					} else {
						$menu_settings = $customized_menu_settings;
					}
				}


				if ( empty($menu_settings)) {
					return $items;
				}

				$new_items = array();

				foreach ( $menu_settings as $key => $value) {

					if ( 0 === strpos( $key, 'menu-item-db-id' ) ) {

						$item = new stdClass();

						$item->ID = $value;
						$item->post_type = 'nav_menu_item';

						if ( isset($menu_settings[ "menu-item-object-id[$value]" ] ) ) {
							$item->object_id = $menu_settings[ "menu-item-object-id[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-object[$value]" ] ) ) {
							$item->object = $menu_settings[ "menu-item-object[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-parent-id[$value]" ] ) ) {
							$item->menu_item_parent = $menu_settings[ "menu-item-parent-id[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-type[$value]" ] ) ) {
							$item->type = $menu_settings[ "menu-item-type[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-title[$value]" ] ) ) {
							$item->title = $menu_settings[ "menu-item-title[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-url[$value]" ] ) ) {
							$item->url = $menu_settings[ "menu-item-url[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-title[$value]" ] ) ) {
							$item->title = $menu_settings[ "menu-item-title[$value]" ];
							$item->post_title = $item->title;
						}

						if ( isset($menu_settings[ "menu-item-attr-title[$value]" ] ) ) {
							$item->attr_title = $menu_settings[ "menu-item-attr-title[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-description[$value]" ] ) ) {
							$item->description = $menu_settings[ "menu-item-description[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-classes[$value]" ] ) ) {
							$item->classes = $menu_settings[ "menu-item-classes[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-xfn[$value]" ] ) ) {
							$item->xfn = $menu_settings[ "menu-item-xfn[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-position[$value]" ] ) ) {
							$item->menu_order = $menu_settings[ "menu-item-position[$value]" ];
						}

						if ( isset($menu_settings[ "menu-item-db-id[$value]" ] ) ) {
							$item->db_id = $menu_settings[ "menu-item-db-id[$value]" ];
						}

						if ( isset($menu_settings[ "td_mega_menu_cat[$value]" ] ) ) {
							$item->td_mega_menu_cat = $menu_settings[ "td_mega_menu_cat[$value]" ];
						}

						if ( isset($menu_settings[ "td_mega_menu_page_id[$value]" ] ) ) {
							$item->td_mega_menu_page_id = $menu_settings[ "td_mega_menu_page_id[$value]" ];
						}



						// CODE SECTION FROM wp customizer >>>

						$post = new WP_Post( (object) $item );

						if ( empty( $post->post_author ) ) {
							$post->post_author = get_current_user_id();
						}

						if ( ! isset( $post->type_label ) ) {
							if ( 'post_type' === $post->type ) {
								$object = get_post_type_object( $post->object );
								if ( $object ) {
									$post->type_label = $object->labels->singular_name;
								} else {
									$post->type_label = $post->object;
								}
							} elseif ( 'taxonomy' == $post->type ) {
								$object = get_taxonomy( $post->object );
								if ( $object ) {
									$post->type_label = $object->labels->singular_name;
								} else {
									$post->type_label = $post->object;
								}
							} else {
								$post->type_label = __( 'Custom Link' );
							}
						}

						/** This filter is documented in wp-includes/nav-menu.php */
						$post->attr_title = apply_filters( 'nav_menu_attr_title', $post->attr_title );

						/** This filter is documented in wp-includes/nav-menu.php */
						$post->description = apply_filters( 'nav_menu_description', wp_trim_words( $post->description, 200 ) );

						/** This filter is documented in wp-includes/nav-menu.php */
						$post = apply_filters( 'wp_setup_nav_menu_item', $post );

						// <<< CODE SECTION FROM wp customizer

						$new_items[] = $post;
					}
				}

				// CODE SECTION FROM wp customizer >>>
				foreach ( $new_items as $item ) {
					foreach ( get_object_vars( $item ) as $key => $value ) {
						$item->$key = $value;
					}
				}
				// <<< CODE SECTION FROM wp customizer

				//print_r($new_items);

				return $new_items;
			}
			return $items;
		}

	}

	return $post;
}
