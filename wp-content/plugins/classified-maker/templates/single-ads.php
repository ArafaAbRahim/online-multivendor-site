<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

		get_header();

		do_action('classified_maker_action_before_single_ads');

		while ( have_posts() ) : the_post(); 
		?>
        <div itemscope itemtype="http://schema.org/Product" id="ads-<?php the_ID(); ?>" <?php post_class('single-ads single-ads-main entry-content'); ?>>
        
        
        <?php
			do_action('classified_maker_action_single_ads_main');
		?>
        <div class="clear"></div>
        </div>
		<?php
		endwhile;
		
        do_action('classified_maker_action_after_single_ads');

		get_footer();
		
