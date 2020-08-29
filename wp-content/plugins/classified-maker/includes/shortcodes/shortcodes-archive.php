<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_shortcodes_archive{
	
    public function __construct(){
		

		add_shortcode( 'classified_maker_archive', array( $this, 'archive' ) );	
			
			

   		}

		
	public function archive($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'company' => '',
											
					), $atts);
					
			$company = $atts['company'];
	
	
			$classified_maker_post_per_page = get_option('classified_maker_post_per_page');
			$classified_maker_excerpt_word_count = get_option('classified_maker_excerpt_word_count');	
			$classified_maker_currency_symbol = get_option('classified_maker_currency_symbol');
			$classified_maker_archive_page_id = get_option('classified_maker_archive_page_id');	
			$archive_page_url = get_permalink($classified_maker_archive_page_id);
	
	
	
			$html = '';		
			
			$html.=	'<div class="classified-maker ads-archive">';
			
			if ( get_query_var('paged') ) {
			
				$paged = get_query_var('paged');
			
			} elseif ( get_query_var('page') ) {
			
				$paged = get_query_var('page');
			
			} else {
			
				$paged = 1;
			
			}
			
			
			$html.=	'<div class="filters">';	
					
			if(!empty($_GET['keywords'])){
		
				$keywords = sanitize_text_field($_GET['keywords']);
				$html.=	'<div class="filter"><span >'.__('Keyword:',classified_maker_textdomain).'</span> <span class="value">'.$keywords.'</span></div>';	
				}
			else{
				$keywords = '';
				}
					
				
			$meta_query = array();	
			
			if(!empty($_GET['location'])){
				
				
				$meta_value = sanitize_text_field($_GET['location']);
				$meta_key = 'classified_maker_ads_location';
				//$meta_keys = explode(',',$meta_keys);
				
				$meta_query[] = array(
				
									'key' => $meta_key,
									'value' => $meta_value,
									'compare' => '=',
									
										);
		
		
				$html.=	'<div class="filter"><span>'.__('Location:',classified_maker_textdomain).'</span> <span class="value">'.$meta_value.'</span></div>';	
				
				}	
					
			
			if( !empty($_GET['company'] ) || !empty( $company ) ) {
				
				
				$company = empty( $company ) ? sanitize_text_field($_GET['company']) : $company;
				
				$meta_query[] = array(
					'key' => 'classified_maker_ads_company_id',
					'value' => $company,
					'compare' => '=',
				);
		
		
				// $html.=	'<div class="filter"><span>'.__('Location:',classified_maker_textdomain).'</span> <span class="value">'.$meta_value.'</span></div>';	
			}	
					
					
			if(!empty($_GET['featured'])){
				
				
				$meta_value = sanitize_text_field($_GET['featured']);
				$meta_key = 'classified_maker_ads_featured';
				//$meta_keys = explode(',',$meta_keys);
				
				$meta_query[] = array(
				
									'key' => $meta_key,
									'value' => $meta_value,
									'compare' => '=',
									
										);
		
				$html.=	'<div class="filter"><span>'.__('Featured:',classified_maker_textdomain).'</span> <span class="value">'.$meta_value.'</span></div>';
		
		
				}			
					
		
			if(!empty($_GET['owner_type'])){
				
				
				$meta_value = sanitize_text_field($_GET['owner_type']);
				$meta_key = 'classified_maker_ads_owner_type';
				//$meta_keys = explode(',',$meta_keys);
				
				$meta_query[] = array(
				
									'key' => $meta_key,
									'value' => $meta_value,
									'compare' => '=',
									
										);
		
		
				$html.=	'<div class="filter"><span>'.__('Owner Type:',classified_maker_textdomain).'</span> <span class="value">'.$meta_value.'</span></div>';
		
				}			
				
				
			if(!empty($_GET['listing_for'])){
				
				
				$meta_value = sanitize_text_field($_GET['listing_for']);
				$meta_key = 'classified_maker_listing_for';
				//$meta_keys = explode(',',$meta_keys);
				
				$meta_query[] = array(
				
									'key' => $meta_key,
									'value' => $meta_value,
									'compare' => '=',
									
										);
				
				$html.=	'<div class="filter"><span>'.__('Listing for:',classified_maker_textdomain).'</span> <span class="value">'.$meta_value.'</span></div>';
				
				}		
				
			if(!empty($_GET['price'])){
				
				
				
				$meta_value = sanitize_text_field($_GET['price']);
				$meta_key = 'classified_maker_ads_price';
				//$meta_keys = explode(',',$meta_keys);
				
				$meta_query[] = array(
				
									'key' => $meta_key,
									'value' => $meta_value,
									'compare' => '=',
									
										);
				
				$html.=	'<div class="filter"><span>'.__('Price:',classified_maker_textdomain).'</span> <span class="value">'.$classified_maker_currency_symbol.$meta_value.'</span></div>';
				
				}				
				
				
			if(!empty($_GET['price_range'])){
				
				$classified_maker_currency_symbol = get_option('classified_maker_currency_symbol');
				
				$meta_value = sanitize_text_field($_GET['price_range']);
				$meta_value = explode('|', $meta_value);
				
				$meta_value_min = $meta_value[0];
				$meta_value_max = $meta_value[1];				
				
				$meta_key = 'classified_maker_ads_price';
				//$meta_keys = explode(',',$meta_keys);
				
				$meta_query[] = array(
								'relation' => 'AND',
								array(
				
									'key' => $meta_key,
									'value' => $meta_value_min,
									'compare' => '>=',
									'type' => 'NUMERIC'
										),
 								array(
				
									'key' => $meta_key,
									'value' => $meta_value_max,
									'compare' => '<=',
									'type' => 'NUMERIC'
										)	
										
										)
										;
										
										
										

				$html.=	'<div class="filter"><span>'.__('Price Range(Min-Max):',classified_maker_textdomain).'</span> <span class="value">'.$classified_maker_currency_symbol.$meta_value_min.'-'.$classified_maker_currency_symbol.$meta_value_max.'</span></div>';
				
				}				
				
			if(!empty($_GET['date'])){
				
				$date = sanitize_text_field($_GET['date']);
				$date = explode('-', $date);
				
				$date_day = $date[0];
				$date_month = $date[1];
				$date_year = $date[2];
				
												
				
				//$meta_keys = explode(',',$meta_keys);
				
				$date_query[] = array(
						array(
							   'year' => $date_year,
							   'month' => $date_month,
							   'day' => $date_day,
						)
					);
				
				$html.=	'<div class="filter"><span>'.__('Date (dd/mm/yyyy):',classified_maker_textdomain).'</span> <span class="value">'.$date_day.'/'.$date_month.'/'.$date_year.'</span></div>';
				
				}					
				
				
				
			if(!empty($_GET['date_range'])){
				
				$date = sanitize_text_field($_GET['date_range']);
				$date = explode('|', $date);
				
				$date_after = $date[0];
				$date_befroe = $date[1];				
				
				$date_after = explode('-', $date_after);				
				
				$date_after_day = $date_after[0];
				$date_after_month = $date_after[1];
				$date_after_year = $date_after[2];
				
				$date_befroe = explode('-', $date_befroe);
				
				$date_befroe_day = $date_befroe[0];
				$date_befroe_month = $date_befroe[1];
				$date_befroe_year = $date_befroe[2];

				
												
				
				//$meta_keys = explode(',',$meta_keys);
				
				$date_query[] = array(
				
						'after'=>array(
							   'year' => $date_after_year,
							   'month' => $date_after_month,
							   'day' => $date_after_day,
						)	,			
				
						'before'=>array(
							   'year' => $date_befroe_year,
							   'month' => $date_befroe_month,
							   'day' => $date_befroe_day,
						),
						
						'inclusive'=>true
						
					);
				
				$html.=	'<div class="filter"><span>'.__('Date Range (dd/mm/yyyy):',classified_maker_textdomain).'</span> <span class="value">'.$date_after_day.'/'.$date_after_month.'/'.$date_after_year.' - '.$date_befroe_day.'/'.$date_befroe_month.'/'.$date_befroe_year.'</span></div>';
				
				}				
			else{
				$date_query = array();
				}
				
				
				
				
				
				
				
				
			// Category query
			if(!empty($_GET['category'])){
				
				
				$trem = sanitize_text_field($_GET['category']);
				//$meta_keys = explode(',',$meta_keys);
				
				$tax_query[] = array(
						array(
							   'taxonomy' => 'ads_cat',
							   'field' => 'slug',
							   'terms' => $trem,
						)
					);
				
				$html.=	'<div class="filter"><span>'.__('Category:',classified_maker_textdomain).'</span> <span class="value">'.$trem.'</span></div>';
				
				}
			else{
				$tax_query = array();
				}		


				
				
				
				
		
		
		$html.=	'</div>';
		
			
			
			$wp_query = new WP_Query(
				array (
					'post_type' => 'ads',
					'post_status' => 'publish',
					's' => $keywords,
					'orderby' => 'Date',
					'date_query' => $date_query,					
					'meta_query' => $meta_query,
					'tax_query' => $tax_query,					
					'order' => 'DESC',
					'posts_per_page' => $classified_maker_post_per_page,
					'paged' => $paged,
					
					) );
			
			
			
			if ( $wp_query->have_posts() ) :
			
		
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				
				// Post Meta's
				$classified_maker_ads_location = get_post_meta(get_the_ID(), 'classified_maker_ads_location', true);
				$classified_maker_ads_price = get_post_meta(get_the_ID(), 'classified_maker_ads_price', true);

				$classified_maker_ads_featured = get_post_meta(get_the_ID(), 'classified_maker_ads_featured', true);
				$classified_maker_ads_owner_type = get_post_meta(get_the_ID(), 'classified_maker_ads_owner_type', true);				
				
				if($classified_maker_ads_featured=='yes'){
					
					$featured_class = 'featured';
					}
				else{
					$featured_class = '';
					}
				
				
				$html.=	'<div class="ads '.$featured_class.'">';
				
							
				if($classified_maker_ads_featured=='yes'){
					
					$html.=	'<div title="'.__('Featured',classified_maker_textdomain).'" class="featured-icon"></div>';
					}
				
				
				$html.=	'<div class="thumb">';
				
				

				
				
				
/*

				$classified_maker_ads_thumbs = get_post_meta(get_the_ID(),'classified_maker_ads_thumbs',true);
				
				if(!empty($classified_maker_ads_thumbs)){
					
				$thumbs_ids = explode(',',$classified_maker_ads_thumbs);

					if(!empty($thumbs_ids)){
	
						$classified_maker_ads_thumbs = $thumbs_ids[0];
						
						if(empty($classified_maker_ads_thumbs)){
							
							$classified_maker_ads_thumbs = $thumbs_ids[1];
							
							}
						$thumb_url = wp_get_attachment_url($classified_maker_ads_thumbs);
						
						}
					
					}

*/
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
				
				if(!empty($thumb['0'])){
					$thumb_url = $thumb['0'];
					}

				else{
					$thumb_url = classified_maker_plugin_url.'assets/front/images/thumb.png';
					
					}
				
					
				$html.=	'<img src="'.$thumb_url.'" />';					
				
				$html.=	'</div>'; // .thumb
				
				$html.=	'<div class="details">';				
				
				$html.=	'<div class="title">';
				$html.=	'<a href="'.get_permalink().'">'.get_the_title().'</a>'; 		
				$html.=	'</div>'; // .title
				
				$html.=	'<div class="excerpt">';
				$html.=	wp_trim_words(get_the_excerpt(), $classified_maker_excerpt_word_count,'');		
				$html.=	'</div>'; // .content		
						
				$html.=	'<div class="meta">';
				
				if(!empty($classified_maker_ads_price)){
					
						$html.=	'<span class="price"><i class="fa fa-money" aria-hidden="true"></i> '.__('Price:',classified_maker_textdomain).' <a href="'.$archive_page_url.'?price='.$classified_maker_ads_price.'">'.$classified_maker_currency_symbol.$classified_maker_ads_price.'</a></span>';
					}
	
				
				
				$html.=	'<span><i class="fa fa-clock-o"></i> <a href="'.$archive_page_url.'?date='.get_the_date('d-m-Y').'">'.classified_maker_post_duration(get_the_ID()).'</a></span>';
				
		
				
				
				
				
				$location_html= '';
				
				if(!empty($classified_maker_ads_location)){
					$location_html.= '<a href="'.$archive_page_url.'?location='.$classified_maker_ads_location.'">'.$classified_maker_ads_location.'</a>';
					}


				$html.=	'<span><i class="fa fa-map-marker" ></i> '.$location_html.'</span>';									

				$category = get_the_terms(get_the_ID(), 'ads_cat');
					
				//var_dump($category);
				
				if(!empty($category)){
					$html.=	'<span><i class="fa fa-folder-open"></i> <a href="'.$archive_page_url.'?category='.$category[0]->slug.'">'.$category[0]->name.'</a></span>';
					}				
				
				
				if(!empty($classified_maker_ads_owner_type)){
					$html.=	'<span><i class="fa fa-dot-circle-o"></i> <a href="'.$archive_page_url.'?owner_type='.$classified_maker_ads_owner_type.'">'.ucfirst($classified_maker_ads_owner_type).'</a></span>';
					}				


				$html.=	'</div>'; // .meta	
				
				
				$html.=	'</div>'; // .content


			
				

				$html.=	'</div>'; // .ads				
				
				//Display nth items custom html
				$cm_aal_list_ads_positions = apply_filters('cm_aal_list_ads_positions', array());
				
				// echo '<pre>'; print_r($wp_query->current_post); echo '</pre>';
				
				if(!empty($cm_aal_list_ads_positions))
				foreach($cm_aal_list_ads_positions as $position){
					
					if( $wp_query->current_post == $position ){

					
					
						$html .= apply_filters('ads_list_nth_item_html',$position); 
						
						}
					}
				
				
				
			endwhile;
			
					
			
			$html .= '<div class="paginate">';
			$big = 999999999; // need an unlikely integer
			$html .= paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, $paged ),
				'total' => $wp_query->max_num_pages
				) );
		
			$html .= '</div >';	
			
			
			wp_reset_query();
			else:
			
			$html .= __('No ads found','classified_maker');	
			
			endif;		
			
			$html.=	'</div>'; // .ads-archive
			
			return $html;
	}
		
	
			
			
}
	
new class_classified_maker_shortcodes_archive();