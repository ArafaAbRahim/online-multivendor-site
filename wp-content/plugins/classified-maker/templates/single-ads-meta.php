<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


$classified_maker_listing_for = get_post_meta(get_the_ID(), 'classified_maker_listing_for', true);
$classified_maker_ads_city = get_post_meta(get_the_ID(), 'classified_maker_ads_city', true);
$classified_maker_ads_country = get_post_meta(get_the_ID(), 'classified_maker_ads_country', true);
$classified_maker_ads_company = get_post_meta(get_the_ID(), 'classified_maker_ads_company', true);
$classified_maker_ads_owner_type = get_post_meta(get_the_ID(), 'classified_maker_ads_owner_type', true);

$author = get_the_author();
$post_date = get_the_date();


?>
<div class="meta-list"  itemprop="review" itemscope itemtype="http://schema.org/Review">


	<div class="meta author">
    	<?php echo _e('Posted by',classified_maker_textdomain); ?> <a itemprop="author" href="#"><?php echo $author; ?></a>
    </div>
    
	<div class="meta listing_for">
    	<?php echo _e('For',classified_maker_textdomain); ?> <a href="#"><?php echo $classified_maker_listing_for; ?></a>
    </div>

	<div class="meta post_date">
    	<?php echo _e('Date:',classified_maker_textdomain); ?> <a itemprop="datePublished" content="<?php echo $post_date; ?>" href="#"><?php echo $post_date; ?></a>
    </div>    

	<div class="meta post_category">
    	<?php
		
		$category = get_the_terms(get_the_ID(), 'ads_cat');
		if(!empty($category[0]->name)){
			echo _e('Category:',classified_maker_textdomain);
			echo ' <a href="'.get_term_link($category[0]->term_id).'">'.$category[0]->name.'</a>';
			}
		  ?> 
    </div> 

    
    
</div>
