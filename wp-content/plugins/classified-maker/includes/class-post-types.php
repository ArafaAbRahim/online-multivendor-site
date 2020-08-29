<?php

/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_post_types{
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'classified_maker_posttype_ads' ), 0 );
		add_action( 'init', array( $this, 'classified_maker_posttype_reports' ), 0 );
		add_action( 'init', array( $this, 'register_ads_category' ), 0 );		
		
		}
		
	public function classified_maker_posttype_reports(){
		if ( post_type_exists( "reports" ) )
		return;

		$singular  = __( 'Report', classified_maker_textdomain );
		$plural    = __( 'Reports', classified_maker_textdomain );
	 
	 
		register_post_type( "reports",
			apply_filters( "register_post_type_reports", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, classified_maker_textdomain ),
					'all_items'             => sprintf( __( 'All %s', classified_maker_textdomain ), $plural ),
					'add_new' 				=> __( 'New '.$singular, classified_maker_textdomain ),
					'add_new_item' 			=> sprintf( __( 'Add %s', classified_maker_textdomain ), $singular ),
					'edit' 					=> __( 'Edit', classified_maker_textdomain ),
					'edit_item' 			=> sprintf( __( 'Edit %s', classified_maker_textdomain ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', classified_maker_textdomain ), $singular ),
					'view' 					=> sprintf( __( 'View %s', classified_maker_textdomain ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', classified_maker_textdomain ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', classified_maker_textdomain ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', classified_maker_textdomain ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', classified_maker_textdomain ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', classified_maker_textdomain ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', classified_maker_textdomain ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array(''),
				'show_in_menu' 			=> 'edit.php?post_type=ads',
				'show_in_nav_menus' 	=> false,
				'capabilities' 			=> array(
					'create_posts' => false
				),
				'menu_icon' => 'dashicons-megaphone',
			) )
		); 
	 
	}
	
	public function classified_maker_posttype_ads(){
		if ( post_type_exists( "ads" ) )
		return;

		$singular  = __( 'Ads', classified_maker_textdomain );
		$plural    = __( 'Ads', classified_maker_textdomain );
	 
	 
		register_post_type( "ads",
			apply_filters( "register_post_type_ads", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, classified_maker_textdomain ),
					'all_items'             => sprintf( __( 'All %s', classified_maker_textdomain ), $plural ),
					'add_new' 				=> __( 'New '.$singular, classified_maker_textdomain ),
					'add_new_item' 			=> sprintf( __( 'Add %s', classified_maker_textdomain ), $singular ),
					'edit' 					=> __( 'Edit', classified_maker_textdomain ),
					'edit_item' 			=> sprintf( __( 'Edit %s', classified_maker_textdomain ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', classified_maker_textdomain ), $singular ),
					'view' 					=> sprintf( __( 'View %s', classified_maker_textdomain ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', classified_maker_textdomain ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', classified_maker_textdomain ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', classified_maker_textdomain ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', classified_maker_textdomain ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', classified_maker_textdomain ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', classified_maker_textdomain ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array('title','editor','custom-fields','author','thumbnail'),
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-megaphone',
			) )
		); 
	 
	}
	
	
	
	public function register_ads_category(){

			$singular  = __( 'Ads Category', 'team' );
			$plural    = __( 'Ads Categories', 'team' );
	 
			register_taxonomy( "ads_cat",
				apply_filters( 'register_taxonomy_ads_cat_object_type', array( 'ads' ) ),
	       	 	apply_filters( 'register_taxonomy_ads_cat_args', array(
		            'hierarchical' 			=> true,
		            'show_admin_column' 	=> true,					
		            'update_count_callback' => '_update_post_term_count',
		            'label' 				=> $plural,
		            'labels' => array(
						'name'              => $plural,
						'singular_name'     => $singular,
						'menu_name'         => ucwords( $plural ),
						'search_items'      => sprintf( __( 'Search %s', 'team' ), $plural ),
						'all_items'         => sprintf( __( 'All %s', 'team' ), $plural ),
						'parent_item'       => sprintf( __( 'Parent %s', 'team' ), $singular ),
						'parent_item_colon' => sprintf( __( 'Parent %s:', 'team' ), $singular ),
						'edit_item'         => sprintf( __( 'Edit %s', 'team' ), $singular ),
						'update_item'       => sprintf( __( 'Update %s', 'team' ), $singular ),
						'add_new_item'      => sprintf( __( 'Add New %s', 'team' ), $singular ),
						'new_item_name'     => sprintf( __( 'New %s Name', 'team' ),  $singular )
	            	),
		            'show_ui' 				=> true,
		            'public' 	     		=> true,
				    'rewrite' => array(
						'slug' => 'ads_cat', // This controls the base slug that will display before each term
						'with_front' => false, // Don't display the category base before "/locations/"
						'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
				),
		        ) )
		    );

		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}
	
	new class_classified_maker_post_types();