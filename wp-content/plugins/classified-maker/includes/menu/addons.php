<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_classified_maker_addons_page{
	
	
    public function __construct(){


    }
	
	
	public function addons_data($addons_data = array()){
		
		$addons_data_new = array(
							

			'company-profile'=>array(	'title'=>'Company Profile',
										'version'=>'1.0.1',
										'price'=>'0',
										'content'=>'Create awesome company page for Classified Maker to display information of companies, agency.',										
										'item_link'=>'https://wordpress.org/plugins/classified-maker-company-profile/',
										'thumb'=>classified_maker_plugin_url.'includes/menu/images/company-profile.png',							
			),	

			'location'=>array(	'title'=>'Location',
										'version'=>'1.0.0',
										'price'=>'0',
										'content'=>'Add location for Classified Maker ads.',										
										'item_link'=>'https://wordpress.org/plugins/classified-maker-location/',
										'thumb'=>classified_maker_plugin_url.'includes/menu/images/location.png',							
			),
	
			'widgets'=>array(	'title'=>'Widgets',
										'version'=>'1.0.0',
										'price'=>'0',
										'content'=>'Some useful widgets for Classified Maker.',										
										'item_link'=>'http://www.pickplugins.com/item/classified-maker-widgets/',
										'thumb'=>classified_maker_plugin_url.'includes/menu/images/widgets.png',							
			),	
	
	
			'search'=>array(	'title'=>'Search',
										'version'=>'1.0.0',
										'price'=>'19',
										'content'=>'Display search & filter form for ads. search by keyword, location, ads categories, owner type, listing for, max-min price and more.',										
										'item_link'=>'http://www.pickplugins.com/item/classified-maker-search/',
										'thumb'=>classified_maker_plugin_url.'includes/menu/images/search.png',							
			),						
						
						
						
						
						
						

		);
		
		$addons_data = array_merge($addons_data_new,$addons_data);
		
		$addons_data = apply_filters('classified_maker_filters_addons_data', $addons_data);
		
		return $addons_data;
		
		
		}
	
	public function classified_maker_addons_list_html(){
		
		$html = '';
		
		$addons_data = $this->addons_data();
		
		foreach($addons_data as $key=>$values){
			
			$html.= '<div class="single '.$key.'">';
			$html.= '<div class="thumb"><a href="'.$values['item_link'].'"><img src="'.$values['thumb'].'" /></a></div>';			
			$html.= '<div class="title"><a href="'.$values['item_link'].'">'.$values['title'].'</a></div>';
			$html.= '<div class="content">'.$values['content'].'</div>';						
			$html.= '<div class="meta version"><b>'.__('Version:',classified_maker_textdomain).'</b> '.$values['version'].'</div>';
			
			if($values['price']==0){
				
				$price = 'Free';
				}
			else{
				$price = '$'.$values['price'];
				
				}		
			$html.= '<div class="meta price"><b>'.__('Price:',classified_maker_textdomain).'</b> '.$price.'</div>';							
			$html.= '<div class="meta download"><a href="'.$values['item_link'].'">'.__('Download',classified_maker_textdomain).'</a></div>';				
			
			
			
			$html.= '</div>';
			
		
			
			}
		
		$html.= '';		
		
		return $html;
		}

	
	
	
}

//new class_classified_maker_addons_page();


	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(classified_maker_plugin_name.' - Addons', classified_maker_textdomain)."</h2>";?>
	<div class="classified-maker-addons">
    
    <?php
    
	$class_classified_maker_addons_page = new class_classified_maker_addons_page();
	
	echo $class_classified_maker_addons_page->classified_maker_addons_list_html();
	
	
	?>
    </div>


</div>
