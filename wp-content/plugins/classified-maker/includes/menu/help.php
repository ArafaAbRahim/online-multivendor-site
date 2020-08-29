<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".sprintf(__('%s - Help',classified_maker_textdomain),classified_maker_plugin_name)."</h2>";?>
    
    <div class="classified-maker-admin help">
    
   		<div class="option-box">
            <p class="option-title"><?php _e('Ask any question',classified_maker_textdomain); ?></p>
            <p class="option-info">
            <?php _e('Please feel free to contact for any question, ask via our forum <a href="http://www.pickplugins.com/questions/">http://www.pickplugins.com/questions/</a>',classified_maker_textdomain); ?>
            </p>
            
        </div>    
    
    
				<div class="option-box">
                    <p class="option-title"><?php _e('Submit Reviews.',classified_maker_textdomain ); ?></p>
                    <p class="option-info"><?php _e('We are working hard to build some awesome plugins for you and spend thousand hour for plugins. we wish your three(3) minute by submitting five star reviews at wordpress.org. if you have any issue please submit at forum.',classified_maker_textdomain ); ?></p>
                	<img src="<?php echo classified_maker_plugin_url."assets/admin/images/five-star.png";?>" /><br />
                    <a target="_blank" href="<?php echo classified_maker_wp_reviews; ?>">
                		<?php echo classified_maker_wp_reviews; ?>
               		</a>

                </div>
    
    
    
    
   		<div class="option-box">
            <p class="option-title"><?php _e('Watch video tutorial',classified_maker_textdomain); ?></p>
            <p class="option-info"></p>
            
            <div class="tutorials expandable">
            <?php
            $class_classified_maker_functions = new class_classified_maker_functions();
			$tutorials =  $class_classified_maker_functions->tutorials();
			
			foreach($tutorials as $tutorial){
				
				echo '<div class="items">';
				echo '<div class="header"><i class="fa fa-play"></i>&nbsp;&nbsp;'.$tutorial['title'].'</div>';
				echo '<div class="options"><iframe width="640" height="480" src="//www.youtube.com/embed/'.$tutorial['video_id'].'" frameborder="0" allowfullscreen></iframe></div>';				
				
				echo '</div>';				
				
				}
			
			?>

            </div>

        </div>
        
    
    </div>

</div>
