<?php
/*
Plugin Name: Classified Maker
Plugin URI: http://pickplugins.com
Description: Awesome Classified Maker.
Version: 1.0.18
Author: pickplugins
Author URI: http://pickplugins.com
Text Domain: classified-maker
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class ClassifiedMaker{
	
	public function __construct(){
	
	define('classified_maker_plugin_url', plugins_url('/', __FILE__)  );
	define('classified_maker_plugin_dir', plugin_dir_path( __FILE__ ) );
	define('classified_maker_wp_url', 'https://wordpress.org/plugins/classified-maker/' );
	define('classified_maker_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/classified-maker' );
	define('classified_maker_pro_url','http://www.pickplugins.com/item/classified-maker/' );
	define('classified_maker_demo_url', 'http://www.pickplugins.com/demo/classified-maker/' );
	define('classified_maker_conatct_url', 'http://www.pickplugins.com/contact/' );
	define('classified_maker_qa_url', 'http://www.pickplugins.com/questions/' );
	define('classified_maker_plugin_name', 'Classified Maker' );
	define('classified_maker_plugin_version', '1.0.18' );
	define('classified_maker_customer_type', 'free' );	 
	define('classified_maker_share_url', '' );
	define('classified_maker_tutorial_video_url', '' );
	define('classified_maker_textdomain', 'classified-maker' );
	//define('pickform_textdomain', 'pickform' );	
	
	if( !defined('pickform_textdomain') ){ define('pickform_textdomain', 'pickform' ); }
	if( !defined('classified_maker_wishlist_table_name') ){ define('classified_maker_wishlist_table_name', 'classified_maker_wishlist' ); }


	// Class
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-types.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta-reports.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta.php');
	
	// Column Class
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-reports-column.php');
	
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-archive.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-edit-ads.php');	
	//require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-post-ads.php');		
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-account.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-post-ads.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-edit-ads.php');		
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-dashboard.php');		

	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-functions.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-settings.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-form.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-emails.php');		
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-validations.php');		
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/pickform/class-pickform.php');	
	
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');
	
	
	//require_once( plugin_dir_path( __FILE__ ) . 'includes/ajax-upload.php');
	
	
	require_once( plugin_dir_path( __FILE__ ) . 'templates/single-ads-template-functions.php');		
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions-admin.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/notice/notice.php');	
	
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/my-account-registration.php');

	require_once( plugin_dir_path( __FILE__ ) . 'upgrade/upgrade.php');	
	
	
	
	
	
	add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	add_action( 'wp_enqueue_scripts', array( $this, 'classified_maker_front_scripts' ) );
	add_action( 'admin_enqueue_scripts', array( $this, 'classified_maker_admin_scripts' ) );
	
	add_action( 'plugins_loaded', array( $this, 'classified_maker_load_textdomain' ));
	//load_plugin_textdomain( 'classified-maker' );
	
	//Redirect to welcome page
	add_action( 'activated_plugin', array( $this, 'classified_maker_redirect_welcome' ));	
	add_action( 'admin_head', array( $this, 'classified_maker_remove_welcome_menu' ));	

	
	register_activation_hook( __FILE__, array( $this, 'classified_maker_activation' ) );
	register_deactivation_hook( __FILE__, array( $this, 'classified_maker_deactivation' ) );
	//register_uninstall_hook( __FILE__, array( $this, 'classified_maker_uninstall' ) );
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/widgets/class-widget-featured-ads.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/widgets/class-widget-ads-from-city.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/widgets/class-widget-latest-ads.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/widgets/class-widget-categorised-ads.php');	
		
	add_action( 'widgets_init', array( $this, 'classified_maker_widgets_load_widget' ) );
	}
	
	public function classified_maker_widgets_load_widget() {
		
		register_widget( 'WidgetFeaturedAds' );
		register_widget( 'WidgetAdsFromCity' );
		register_widget( 'WidgetLatestAds' );
		register_widget( 'WidgetCategorisedAds' );
	}
	
	public function classified_maker_load_textdomain() {
		
		
		$locale = apply_filters( 'plugin_locale', get_locale(), 'classified-maker' );
		load_textdomain('classified-maker',WP_LANG_DIR .'/classified-maker/classified-maker-'. $locale .'.mo');
		load_plugin_textdomain( 'classified-maker', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}
	
	public function classified_maker_activation(){
		
		//$classified_maker_versions['current'] = '1.0.3';
		$classified_maker_versions_saved = get_option('classified_maker_versions');
		
		$plugin_data = get_plugin_data( __FILE__ );
		$classified_maker_versions['current'] = $plugin_data['Version'];
		$classified_maker_versions = array_merge($classified_maker_versions_saved, $classified_maker_versions);
		
		update_option('classified_maker_versions', $classified_maker_versions);
		
		
		
		// Reset permalink
		$class_classified_maker_post_types= new class_classified_maker_post_types();
		$class_classified_maker_post_types->classified_maker_posttype_ads();
		flush_rewrite_rules();
		
		
		// create demo ads category
		$class_classified_maker_post_types->register_ads_category();		
		
		$ads_category_terms = get_terms( array(
			'taxonomy' => 'ads_cat',
			'hide_empty' => false,
		) );
		
		if(empty($ads_category_terms)){
			
				wp_insert_term(
				  'General', // the term 
				  'ads_cat', // the taxonomy
				  array(
					'description'=> 'General ads.',
					'slug' => 'general',
					//'parent'=> $parent_term_id
				  )
				);
		
			}
		
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix . classified_maker_wishlist_table_name ." (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			ads_id int(1) NOT NULL,
			user_id int(1) NOT NULL,
			date_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			UNIQUE KEY id (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
		do_action( 'classified_maker_action_install' );
	}		
		
	public function classified_maker_uninstall(){
		

		
		do_action( 'classified_maker_action_uninstall' );
		}		
		
	public function classified_maker_deactivation(){
		
		
		$classified_maker_versions_saved = get_option('classified_maker_versions');
		if(empty($classified_maker_versions_saved)){
			$classified_maker_versions_saved = array();
			}
		
		$plugin_data = get_plugin_data( classified_maker_plugin_dir.'classified-maker.php' );
		$classified_maker_versions[$plugin_data['Version']] = $plugin_data['Version'];
		
		$classified_maker_versions = array_merge($classified_maker_versions_saved, $classified_maker_versions);
		
		
		update_option('classified_maker_versions', $classified_maker_versions);
		
		
		do_action( 'classified_maker_action_deactivation' );
		}
		
	public function classified_maker_redirect_welcome($plugin){
		
		$classified_maker_welcome_done = get_option('classified_maker_welcome_done');
		
		if($classified_maker_welcome_done != true){
			
				if($plugin=='classified-maker/classified-maker.php') {
					 wp_redirect(admin_url('edit.php?post_type=ads&page=welcome'));
					 die();
				}
			
			}
		

		}		
		
	public function classified_maker_remove_welcome_menu(){
		remove_submenu_page( 'edit.php?post_type=ads', 'welcome' );
	}
		
		
		
	public function classified_maker_front_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-sortable');
		
		wp_enqueue_script('classified_maker_front_js', plugins_url( '/assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('classified_maker_front_scripts-form', plugins_url( '/assets/front/js/scripts-form.js' , __FILE__ ) , array( 'jquery' ));		
		
		wp_localize_script( 'classified_maker_front_js', 'L10n_classified_maker', array( 'confirm_text' => __( 'Confirm', classified_maker_textdomain ) ));
		

		wp_enqueue_style('classified_maker_style', classified_maker_plugin_url.'assets/front/css/style.css');
		
		wp_enqueue_style('classified_maker_post-ads_style', classified_maker_plugin_url.'assets/front/css/post-ads.css');	
		wp_enqueue_style('classified_maker_post-single-ads', classified_maker_plugin_url.'assets/front/css/single-ads.css');
		wp_enqueue_style('classified_maker_post-ads-archive', classified_maker_plugin_url.'assets/front/css/ads-archive.css');
		wp_enqueue_style('classified_maker_my-account', classified_maker_plugin_url.'assets/front/css/my-account.css');					
			
		wp_enqueue_style('classified_maker-dashboard', classified_maker_plugin_url.'assets/front/css/style-dashboard.css');				
		wp_enqueue_style('classified_maker-my-ads', classified_maker_plugin_url.'assets/front/css/style-my-ads.css');
		wp_enqueue_style('classified_maker-my-wishlist', classified_maker_plugin_url.'assets/front/css/style-my-wishlist.css');		
		
		wp_enqueue_script('owl.carousel', plugins_url( '/assets/front/js/owl.carousel.js' , __FILE__ ) , array( 'jquery' ));			
		wp_enqueue_style('owl.carousel', classified_maker_plugin_url.'assets/front/css/owl.carousel.css');			
		wp_enqueue_style('owl.theme', classified_maker_plugin_url.'assets/front/css/owl.theme.css');				
			
		wp_enqueue_script('jquery.steps', plugins_url( '/assets/front/js/jquery.steps.js' , __FILE__ ) , array( 'jquery' ));				
			
		wp_enqueue_style('font-awesome', classified_maker_plugin_url.'assets/global/css/font-awesome.css');
		
		// pickform
		wp_enqueue_style('pickform-css', classified_maker_plugin_url.'assets/global/pickform/style.css');
		wp_enqueue_script('pickform', plugins_url( '/assets/global/pickform/scripts.js' , __FILE__ ) , array( 'jquery' ));
		
		// select2
		wp_enqueue_style('select2-css', classified_maker_plugin_url.'assets/global/css/select2.css');
		wp_enqueue_script('select2.js', plugins_url( '/assets/global/js/select2.js' , __FILE__ ) , array( 'jquery' ));
		
		
		wp_enqueue_script('plupload-all');	
		wp_enqueue_script('plupload_js', plugins_url( '/assets/global/js/scripts-plupload.js' , __FILE__ ) , array( 'jquery' ));
		
	
		wp_localize_script( 'classified_maker_front_js', 'classified_maker_ajax', array( 'classified_maker_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		
	}

	public function classified_maker_admin_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		
		wp_enqueue_script('classified_maker_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'classified_maker_admin_js', 'classified_maker_ajax', array( 'classified_maker_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_style('classified_maker_admin_style', classified_maker_plugin_url.'assets/admin/css/style.css');
		wp_enqueue_style('classified_maker_addons_style', classified_maker_plugin_url.'assets/admin/css/addons.css');		
		
		wp_enqueue_script('classified_maker_PickAdmin', plugins_url( '/assets/admin/PickAdmin/scripts.js' , __FILE__ ) , array( 'jquery' ));		
		wp_enqueue_style('classified_maker_PickAdmin', classified_maker_plugin_url.'assets/admin/PickAdmin/style.css');
		wp_enqueue_style('font-awesome', classified_maker_plugin_url.'assets/global/css/font-awesome.css');
		
		// pickform
		wp_enqueue_style('pickform-css', classified_maker_plugin_url.'assets/global/pickform/style.css');
		wp_enqueue_script('pickform', plugins_url( '/assets/global/pickform/scripts.js' , __FILE__ ) , array( 'jquery' ));
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'classified_maker_color_picker', plugins_url('/assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
	}

} new ClassifiedMaker();