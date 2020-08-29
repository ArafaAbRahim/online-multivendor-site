<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


$classified_maker_ads_thumbs = get_post_meta(get_the_ID(), 'classified_maker_ads_thumbs', true);
//var_dump(($classified_maker_ads_thumbs));

	$classified_maker_ads_thumbs = unserialize($classified_maker_ads_thumbs);	
	
	//var_dump(($classified_maker_ads_thumbs));

?>

<div class="images">

<?php



if(!empty($classified_maker_ads_thumbs)){
	
	//$classified_maker_ads_thumbs = explode(',',$classified_maker_ads_thumbs);
	

	
	foreach($classified_maker_ads_thumbs as $thumb_id){
		
		if(!empty($thumb_id)){
			
			$thums_url = wp_get_attachment_url($thumb_id);
			
			
			echo '<div class="image">';
			echo '<img src="'.$thums_url.'" />';
			echo '</div>';
		
			}
	
		
		}
	
	}
else{

		echo '<div class="image">';
		echo '<img src="'.classified_maker_plugin_url.'assets/front/images/thumb-large.png'.'" />';
		echo '</div>';
	
	}


?>



</div>


<?php

	echo '<script>
	jQuery(document).ready(function($)
	{
		$(".images").owlCarousel({
			
			items : 1, //10 items above 1000px browser width
			itemsDesktop : [1000,1], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			itemsMobile : [479,1], 
			navigationText : ["",""],
			';
	echo 'autoHeight: true,';			
	echo 'autoPlay: true,';
	echo 'stopOnHover: true,';
	echo 'navigation: true,';
	echo 'pagination: true,';
	echo 'paginationNumbers: false,';	
	echo 'slideSpeed: 1000,';		
	echo 'paginationSpeed: 100,';		
	echo 'touchDrag : true,';
	echo 'mouseDrag  : true,';		

			
	echo '});
	
	});

	</script>';

?>