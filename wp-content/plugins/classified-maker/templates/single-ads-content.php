<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

?>

<?php
	do_action('classified_maker_action_single_ads_content_before');
?>

<div itemprop="description" class="content"><?php the_content(); ?></div>

<?php
	do_action('classified_maker_action_single_ads_content_after');
?>