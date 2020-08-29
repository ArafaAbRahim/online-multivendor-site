<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



?>


<?php

	$class_classified_maker_functions = new class_classified_maker_functions();
	$sidebar_widgets = $class_classified_maker_functions->sidebar_widgets();
?>

<div class="ads-sidebar">

	<?php
    
	foreach($sidebar_widgets as $widget){
		
		if(!empty($widget['title'])){
			$title = $widget['title'];
			}
		else{
			$title = '';
			}		
		
		if(!empty($widget['description'])){
			$description = $widget['description'];
			}
		else{
			$description = '';
			}		
		
		if(!empty($widget['html'])){
			$html = $widget['html'];
			}
		else{
			$html = '';
			}		
		
		
		
		if(!empty($widget['css_class'])){
			$css_class = $widget['css_class'];
			}
		else{
			$css_class = '';
			}
		
		
		echo '<div class="widget">';
		
		
		
		if(!empty($title))
		echo '<div class="title">'.$title.'</div>';
		
		if(!empty($description))
		echo '<div class="description">'.$description.'</div>';	
		

		if(!empty($html))
		echo '<div class="html '.$css_class.'">'.$html.'</div>';		
		
		echo '</div>';
		
		
		}
	
	
	?>


</div>