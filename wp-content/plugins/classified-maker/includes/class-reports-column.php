<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_reports_column{
	
	public function __construct(){

		add_action( 'manage_reports_posts_columns', array( $this, 'add_core_reports_columns' ), 16, 1 );
		add_action( 'manage_reports_posts_custom_column', array( $this, 'custom_columns_content' ), 10, 2 );
		add_filter( 'post_row_actions', array( $this, 'remove_post_row_actions' ), 10, 2 );
		
		add_filter( 'manage_edit-reports_sortable_columns', array( $this, 'disable_sortable_reports_list' ) );
	}
	
	public function add_core_reports_columns( $columns ) {

		$new = array();
		
		$count = 0;
		foreach ( $columns as $col_id => $col_label ) { $count++;

			if ( $count == 3 ) {
				
				$new['cm-ads'] = esc_html__( 'Ads Name', classified_maker_textdomain );
				$new['cm-reporter'] = esc_html__( 'Reporter', classified_maker_textdomain );
				$new['cm-reason'] = esc_html__( 'Reason', classified_maker_textdomain );
				$new['cm-date'] = esc_html__( 'Date', classified_maker_textdomain );
			}
			
			if( 'title' === $col_id ) {
				$new[$col_id] = '<i class="fa fa-reports-circle fs_18"></i> ' . esc_html__( 'Report title', classified_maker_textdomain );
			} else {
				$new[ $col_id ] = $col_label;
			}
		}

		unset( $new['date'] );
		
		return $new;
	}
	
	public function disable_sortable_reports_list( $columns ) {
		unset( $columns['title'] );
		return $columns;
	}
	
	
	public function custom_columns_content( $column, $post_id ) {
		
		$report_post	= get_post( $post_id );
		switch ( $column ) {
		
		case 'cm-ads':
			
			$ads_id = get_post_meta( $post_id, 'ads_id', true );
			
			echo '<a href=""><strong>'. get_the_title( $ads_id ) .'</strong></a>';
			break;
			
			
		case 'cm-reporter':
			
			$author_id 		= ! empty( $report_post->post_author ) ? $report_post->post_author : 0;
			$author_name 	= get_the_author_meta( 'display_name', $author_id);
		
			echo 'Reported by <a href="user-edit.php?user_id='.$author_id.'"><strong><i>'.$author_name.'</strong></i></a>';
			break;
			
			
		case 'cm-reason':
			
			$input_reason 	= get_post_meta( $post_id, 'input_reason', true );
			
			echo $input_reason;
			break;
			
			
		case 'cm-date':
			
			$timeago = human_time_diff( get_the_time( 'U', $report_post ), current_time( 'timestamp' ) );
			
			echo 'Reported on <i><b>'. $timeago. '</i></b> ago<br>';
			echo get_the_time( '', $report_post ) .' - '. get_the_date( '', $report_post ) .'<br>';
			
			break;	
		}
	}
	
	public function remove_post_row_actions( $actions ) {
		global $post;

		if ( $post->post_type === 'reports' ) {
			unset( $actions['inline hide-if-no-js'] ); // Remove Quick Edit
			unset( $actions['view'] ); // Remove View
		}

		return $actions;
	}
	
	
} new class_classified_maker_reports_column();