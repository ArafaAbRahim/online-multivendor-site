<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_classified_maker_settings  {
	
	
    public function __construct(){

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
    }
	

	
	
	public function admin_menu() {
		
		add_submenu_page( 'edit.php?post_type=ads', __( 'Settings', classified_maker_textdomain ), __( 'Settings', classified_maker_textdomain ), 'manage_options', 'settings', array( $this, 'settings' ) );		
		add_submenu_page( 'edit.php?post_type=ads', __( 'Field Set', classified_maker_textdomain ), __( 'Field Set', classified_maker_textdomain ), 'manage_options', 'field_set', array( $this, 'field_set' ) );

		add_submenu_page( 'edit.php?post_type=ads', __( 'Email Templates', classified_maker_textdomain ), __( 'Email Templates', classified_maker_textdomain ), 'manage_options', 'emails_templates', array( $this, 'emails_templates' ) );

		add_submenu_page( 'edit.php?post_type=ads', __( 'Welcome', classified_maker_textdomain ), __( 'Welcome', classified_maker_textdomain ), 'manage_options', 'welcome', array( $this, 'welcome' ) );
		
		add_submenu_page( 'edit.php?post_type=ads', __( 'Help', classified_maker_textdomain ), __( 'Help', classified_maker_textdomain ), 'manage_options', 'help', array( $this, 'help' ) );		
		add_submenu_page( 'edit.php?post_type=ads', __( 'Addons', classified_maker_textdomain ), __( 'Addons', classified_maker_textdomain ), 'manage_options', 'addons', array( $this, 'addons' ) );		
		
		

		do_action( 'classified_maker_action_admin_menus' );
		
	}
	
	public function settings(){
		
		include( 'menu/settings.php' );
		}	
	
	
	public function field_set(){
		
		include( 'menu/field-set.php' );
		}
		
	public function emails_templates(){
		
		include( 'menu/emails-templates.php' );
		}		
		
	
	public function welcome(){
		
		include( 'menu/welcome.php' );
		}	
	
	public function help(){
		
		include( 'menu/help.php' );
		}		
	
	public function addons(){
		
		include( 'menu/addons.php' );
		}		
	
	
	

	}


new class_classified_maker_settings();

