<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_classified_maker_form{
	
	public function __construct(){

		
		

		}

	public function author_settigns_form_input($field_data){
		
				$option_id = $field_data['key'];	
				$css_class = $field_data['css_class'];
				$placeholder = $field_data['placeholder'];
				$title = $field_data['title'];				
				$option_details = $field_data['option_details'];
				$input_type = $field_data['input_type'];				
				
				
				if(isset($field_data['input_args'])){
					$input_args = $field_data['input_args'];
					}
				
				if ( is_user_logged_in() ) 
					{
						$current_user_id = get_current_user_id();
					}
				
				//$input_values =  get_option( $option_id );	
				$input_values = get_the_author_meta( $option_id, $current_user_id );
				//var_dump($input_values);
	
				if(empty($input_values)){
					$input_values = $field_data['input_values'];
					}
	
	
	
				$html = '';
				
				$html.= '<div class="option-box">';
				
				if($input_type == 'hidden'){
					
					
					}
				else{
					$html.= '<div class="option-title">'.$title.'</div>';
					$html.= '<div class="option-details">'.$option_details.'</div>';
					}
								
				
				if($input_type == 'text'){
					$html.= '<input id="'.$option_id.'" type="text" placeholder="" name="'.$option_id.'" value="'.$input_values.'" /> ';					

					}
					
					
				elseif($input_type == 'text-multi'){
					
					//var_dump($input_values);
					
					$html.= '<div class="repatble">';
					if(!empty($input_values)){
						if(is_array($input_values)){
							
							foreach($input_values as $key=>$value){
								
								$html.= '<div class="single">';
								$html.= '<input type="text" name="'.$option_id.'['.$key.']" value="'.$input_values[$key].'" />';
								$html.= '<input class="remove-field" type="button" value="'.__('Remove',classified_maker_textdomain).'" />';	
								
								$html.= '</div>';
								}
	
							
							}
						else{
							$html.= '<input type="text" name="'.$option_id.'[]" value="'.$input_values.'" /> ';
							$html.= '<input class="remove-field" type="button" value="'.__('Remove',classified_maker_textdomain).'" />';
							}
						}
					else{
						$html.= '<input type="text" name="'.$option_id.'[]" value="'.$input_values.'" /> ';
						$html.= '<input class="remove-field" type="button" value="'.__('Remove',classified_maker_textdomain).'" />';
						}

					//$html.= '<input type="text" placeholder="" name="'.$option_id.'[]" value="'.$input_values.'" /> ';
					
					$html.= '</div>';
					
					//$html.= '<br /><br />';						
					$html.= '<input class="add-field" option-id="'.$option_id.'" type="button" value="'.__('Add more',classified_maker_textdomain).'" /> ';					
					
					
					
					}					
					
					
					
					
				elseif($input_type == 'hidden'){
					$html.= '<input id="'.$option_id.'" type="hidden" placeholder="" name="'.$option_id.'" value="'.$input_values.'" /> ';
					
					}					
					
					
				elseif($input_type == 'textarea'){
					$html.= '<textarea placeholder="" id="'.$option_id.'" name="'.$option_id.'" >'.$input_values.'</textarea> ';
					
					}
					
				elseif($input_type == 'wp_editor'){

					ob_start();
					wp_editor( stripslashes($input_values), $option_id, $settings = array('textarea_name'=>$option_id, 'media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'200px', ) );				
					$editor_contents = ob_get_clean();
					
					$html.= $editor_contents;

					}
					
				elseif($input_type == 'select'){

					$html.= '<select name="'.$option_id.'" >';
					
					foreach($input_args as $input_args_key => $input_args_values){
						
						if($input_args_key == $input_values){
							$selected = 'selected';
							}
						else{
							$selected = '';
							}
						
						$html.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';

						}
					$html.= '</select>';
					
					}
					
				elseif($input_type  == 'radio'){
					
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $input_values){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
							
						$html.= '<label><input class="'.$option_id.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$option_id.'"   >'.$input_args_values.'</label><br/>';
						
						}
					
					
					}
					
				elseif($input_type == 'checkbox'){

					//var_dump($input_values);

					foreach($input_args as $input_args_key => $input_args_values){

						//var_dump($input_values);
						if(in_array($input_args_key, $input_values)){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
						$html.= '<label><input class="'.$option_id.'" '.$checked.' value="'.$input_args_key.'" name="'.$option_id.'[]"  type="checkbox" >'.$input_args_values.'</label><br/>';
						
						
						}
					
					}	
					
					
					
					
					
					
					
					
					
					
					
					
				elseif($input_type == 'upload'){
					
					
					//$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"></div>';
					
					//$html .= '<div class="file-upload">';
					//$html.= '<input  type="text" id="file_'.$meta_key.'" name="'.$meta_key.'" value="'.$input_values.'" />';

					//$html .= '<span class="loading">'.__('loading',classified_maker_textdomain).'</span>';	
					//$html .= '<a title="'.__('filetype: (jpg, png, jpeg), max size: 2Mb',classified_maker_textdomain).'" id="file-uploader" href="#">'.__('Upload',classified_maker_textdomain).'</a>';			
					//$html.= '</div>';
					$html.= '<input id="'.$option_id.'" type="hidden" placeholder="" name="'.$option_id.'" value="'.$input_values.'" /> ';
					$html .= '<div id="file-upload-container">';
					//$html.= '<input  type="text" id="file_'.$option_key.'" name="'.$option_key.'" value="'.$input_values.'" />';
					//$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"></div>';




					$html.= '<div id="uploaded-image-container">';

					$cookie_name = 'classified_maker_ads_thumbs';
					
					if(!empty($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						
						$attach_ids = explode(',',$attach_ids);
						
						foreach($attach_ids as $attach_id){
							
							$attach_url = wp_get_attachment_url($attach_id);
							$attach_title = get_the_title($attach_id);	
							if(!empty($attach_id)){
								
							$html.= '<div  class="file"><div class="preview"><img src="'.$attach_url.'" title="'.$attach_title.'" /></div><div class="name">'.$attach_title.'</div><span attach_id="'.$attach_id.'" class="remove"><i class="fa fa-times"></i></span></div>';
								
								}

								
							}	
						
						
						
						}
									
										
										
					$html.= '</div>';	
					
					$html .= '<a title="'.__('filetype: (jpg, png, jpeg), max size: 200Mb',classified_maker_textdomain).'" id="file-uploader" href="#">'.__('Upload',classified_maker_textdomain).'</a>';
					
					$html .= '<div class="reset">'.__('Reset',classified_maker_textdomain).'</div>';					
					
														
					$html.= '</div>';
					
					
					
					
					
					
					
					
					}
					
					
					
		
				$html.= '</div>';
		
		
			return $html;			
					
					

	}



	public function settings_form_input($field_data){
		
				$option_id = $field_data['key'];	
				$css_class = $field_data['css_class'];
				$placeholder = $field_data['placeholder'];
				$title = $field_data['title'];				
				$option_details = $field_data['option_details'];
				$input_type = $field_data['input_type'];				
				
				
				if(isset($field_data['input_args'])){
					$input_args = $field_data['input_args'];
					}
				
				$input_values =  get_option( $option_id );	
	
				//var_dump($input_values);
	
				if(empty($input_values)){
					$input_values = $field_data['input_values'];
					}
	
	
	
				$html = '';
				
				$html.= '<div class="option-box">';
				
				if($input_type == 'hidden'){
					
					
					}
				else{
					$html.= '<div class="option-title">'.$title.'</div>';
					$html.= '<div class="option-details">'.$option_details.'</div>';
					}
								
				
				if($input_type == 'text'){
					$html.= '<input id="'.$option_id.'" type="text" placeholder="" name="'.$option_id.'" value="'.$input_values.'" /> ';					

					}
					
					
				elseif($input_type == 'multi-text'){
					
					var_dump($input_values);
					
					
					if(!empty($input_values)){
						
					foreach($input_values as $key=>$value){
						
						$html.= '<input type="text" placeholder="" name="'.$option_id.'['.$key.']" value="'.$input_values[$key].'" /> ';
						}
						
						}
					else{
						$html.= '<input type="text" placeholder="" name="'.$option_id.'[]" value="'.$input_values[0].'" /> ';
						}

					//$html.= '<input type="text" placeholder="" name="'.$option_id.'[]" value="'.$input_values.'" /> ';
					
					
					//$html.= '<br /><br />';						
					$html.= '<input class="add-field" option-id="'.$option_id.'" type="button" value="'.__('Add more',classified_maker_textdomain).'" /> ';					
					
					
					}					
					
					
					
					
				elseif($input_type == 'hidden'){
					$html.= '<input id="'.$option_id.'" type="hidden" placeholder="" name="'.$option_id.'" value="'.$input_values.'" /> ';
					
					}					
					
					
				elseif($input_type == 'textarea'){
					$html.= '<textarea placeholder="" id="'.$option_id.'" name="'.$option_id.'" >'.$input_values.'</textarea> ';
					
					}
					
				elseif($input_type == 'wp_editor'){

					ob_start();
					wp_editor( stripslashes($input_values), $option_id, $settings = array('textarea_name'=>$option_id, 'media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'200px', ) );				
					$editor_contents = ob_get_clean();
					
					$html.= $editor_contents;

					}
					
				elseif($input_type == 'select'){

					$html.= '<select name="'.$option_id.'" >';
					
					foreach($input_args as $input_args_key => $input_args_values){
						
						if($input_args_key == $input_values){
							$selected = 'selected';
							}
						else{
							$selected = '';
							}
						
						$html.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';

						}
					$html.= '</select>';
					
					}
					
				elseif($input_type  == 'radio'){
					
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $input_values){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
							
						$html.= '<label><input class="'.$option_id.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$option_id.'"   >'.$input_args_values.'</label><br/>';
						
						}
					
					
					}
					
				elseif($input_type == 'checkbox'){

					//var_dump($input_values);

					foreach($input_args as $input_args_key => $input_args_values){

						//var_dump($input_values);
						if(in_array($input_args_key, $input_values)){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
						$html.= '<label><input class="'.$option_id.'" '.$checked.' value="'.$input_args_key.'" name="'.$option_id.'[]"  type="checkbox" >'.$input_args_values.'</label><br/>';
						
						
						}
					
					}	
					
					
				
					
					
					
					
					
					
				elseif($input_type == 'upload'){
					
					
					//$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"></div>';
					
					//$html .= '<div class="file-upload">';
					//$html.= '<input  type="text" id="file_'.$meta_key.'" name="'.$meta_key.'" value="'.$input_values.'" />';

					//$html .= '<span class="loading">'.__('loading',classified_maker_textdomain).'</span>';	
					//$html .= '<a title="'.__('filetype: (jpg, png, jpeg), max size: 2Mb',classified_maker_textdomain).'" id="file-uploader" href="#">'.__('Upload',classified_maker_textdomain).'</a>';			
					//$html.= '</div>';
					$html.= '<input id="'.$option_id.'" type="hidden" placeholder="" name="'.$option_id.'" value="'.$input_values.'" /> ';
					$html .= '<div id="file-upload-container">';
					//$html.= '<input  type="text" id="file_'.$option_key.'" name="'.$option_key.'" value="'.$input_values.'" />';
					//$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"></div>';

					$html.= '<div id="uploaded-image-container">';

					$cookie_name = 'classified_maker_ads_thumbs';
					
					if(!empty($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						
						$attach_ids = explode(',',$attach_ids);
						
						foreach($attach_ids as $attach_id){
							
							$attach_url = wp_get_attachment_url($attach_id);
							$attach_title = get_the_title($attach_id);	
							if(!empty($attach_id)){
								
							$html.= '<div  class="file"><div class="preview"><img src="'.$attach_url.'" title="'.$attach_title.'" /></div><div class="name">'.$attach_title.'</div><span attach_id="'.$attach_id.'" class="remove"><i class="fa fa-times"></i></span></div>';
								
								}

								
							}	
						
						
						
						}
									
										
										
					$html.= '</div>';	
					
					$html .= '<a title="'.__('filetype: (jpg, png, jpeg), max size: 200Mb',classified_maker_textdomain).'" id="file-uploader" href="#">'.__('Upload',classified_maker_textdomain).'</a>';
					
					$html .= '<div class="reset">'.__('Reset',classified_maker_textdomain).'</div>';					
					
														
					$html.= '</div>';
					
					
					
					
					
					
					
					
					}
					
					
					
		
				$html.= '</div>';
		
		
			return $html;			
					
					

	}








	public function form_input($field_data){
		
				$classified_maker_reCAPTCHA_enable = get_option('classified_maker_reCAPTCHA_enable');
				$classified_maker_reCAPTCHA_site_key = get_option('classified_maker_reCAPTCHA_site_key');
		
				$meta_key = $field_data['meta_key'];	
				$css_class = $field_data['css_class'];
				$placeholder = $field_data['placeholder'];
				$title = $field_data['title'];				
				$option_details = $field_data['option_details'];
				$input_type = $field_data['input_type'];				
				$input_values = $field_data['input_values'];
				
				if(isset($field_data['input_args'])){
					$input_args = $field_data['input_args'];
					}								
				
				//var_dump($meta_key.' - ');
				//var_dump($input_values);				
					
				//var_dump($input_values);
				
				$html = '';
				
				$html.= '<div class="option">';
				
				if($input_type == 'hidden' || ($meta_key=='classified_maker_ads_recaptcha' && $classified_maker_reCAPTCHA_enable=='no' )){
					
					
					}
				
				else{
					$html.= '<div class="option-title">'.$title.'</div>';
					$html.= '<div class="option-details">'.$option_details.'</div>';
					}
								
				
				if($input_type == 'text'){
				$html.= '<input id="'.$meta_key.'" type="text" placeholder="" name="'.$meta_key.'" value="'.$input_values.'" /> ';					

					}
					
					
					
					
					
				elseif($input_type == 'hidden'){
					$html.= '<input id="'.$meta_key.'" type="hidden" placeholder="" name="'.$meta_key.'" value="'.$input_values.'" /> ';
					
					}					
					
					
				elseif($input_type == 'textarea'){
					$html.= '<textarea placeholder="" id="'.$meta_key.'" name="'.$meta_key.'" >'.$input_values.'</textarea> ';
					
					}
					
				elseif($input_type == 'wp_editor'){

					ob_start();
					wp_editor( stripslashes($input_values), $meta_key, $settings = array('textarea_name'=>$meta_key, 'media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'200px', ) );				
					$editor_contents = ob_get_clean();
					
					$html.= $editor_contents;

					}
					
				elseif($input_type == 'select'){

					$html.= '<select name="'.$meta_key.'" >';
					
					foreach($input_args as $input_args_key => $input_args_values){
						
						if($input_args_key == $input_values){
							$selected = 'selected';
							}
						else{
							$selected = '';
							}
						
						$html.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';

						}
					$html.= '</select>';
					
					}
					
				elseif($input_type  == 'radio'){
					
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $input_values){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
							
						$html.= '<label><input class="'.$meta_key.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$meta_key.'"   >'.$input_args_values.'</label><br/>';
						
						}
					
					
					}
					
				elseif($input_type == 'checkbox'){

					//var_dump($input_values);

					foreach($input_args as $input_args_key => $input_args_values){

						//var_dump($input_values);
						if(in_array($input_args_key, $input_values)){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
						$html.= '<label><input class="'.$meta_key.'" '.$checked.' value="'.$input_args_key.'" name="'.$meta_key.'[]"  type="checkbox" >'.$input_args_values.'</label><br/>';
						
						
						}
					
					}	
					
					
				elseif($input_type == 'file'){
					
					
					
		
			$html.= '
				   <div id="plupload-upload-ui-'.$meta_key.'" class="plupload-upload-ui hide-if-no-js">
					 <div id="drag-drop-area-'.$meta_key.'" class="drag-drop-area">
					   <div class="drag-drop-inside">';
			
			
					   
			if(is_array($input_values)){
				$input_values = $input_values;
				
				}
			else{
				$input_values = unserialize($input_values);
				}
			//var_dump($input_values);
			
			if(!empty($input_values)){
				foreach($input_values as $file_id){
					
					$attachment_url = wp_get_attachment_url($file_id);
					if(!empty($attachment_url)){
						$html.= '<div class=item attach_id="'.$file_id.'"><img src="'.wp_get_attachment_url($file_id).'" /><span attach_id="'.$file_id.'" class=delete>Delete</span><input  type=hidden name='.$meta_key.'[] value="'.$file_id.'" /></div>';
						}

					
					}
				
				}
			else{
				$html.= '<input type="hidden" value="0" name="'.$meta_key.'[]">';
				}


			$html.= '<p class="ui-state-default ui-state-disabled" >'.__("Drop - files here",classified_maker_textdomain).'</p>
						<p class="drag-drop-buttons ui-state-default ui-state-disabled"><input id="plupload-browse-'.$meta_key.'" type="button" value="'.__("Select Files",classified_maker_textdomain).'" class="button" /></p>
					  </div>
					 </div>
				  </div>

			';			
			
			
  $plupload_init = array(
    'runtimes'            => 'html5,silverlight,flash,html4',
    'browse_button'       => 'plupload-browse-'.$meta_key.'',
	//'multi_selection'	  =>false,
    'container'           => 'plupload-upload-ui-'.$meta_key.'',
    'drop_element'        => 'drag-drop-area-'.$meta_key.'',
    'file_data_name'      => 'async-upload',
    'multiple_queues'     => true,
    'max_file_size'       => wp_max_upload_size().'b',
    'url'                 => admin_url('admin-ajax.php'),
    //'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
    //'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
    'filters'             => array(array('title' => __('Allowed Files',classified_maker_textdomain), 'extensions' => 'gif,png,jpg,jpeg')),
    'multipart'           => true,
    'urlstream_upload'    => true,

    // additional post data to send to our ajax hook
    'multipart_params'    => array(
      '_ajax_nonce' => wp_create_nonce('photo-upload'),
      'action'      => 'photo_gallery_upload',            // the ajax action name
    ),
  );

  // we should probably not apply this filter, plugins may expect wp's media uploader...
  $plupload_init = apply_filters('plupload_init', $plupload_init);
			
			
	$html.= '
			
		 <script>
		
			jQuery(document).ready(function($){
		
			  // create the uploader and pass the config from above
			  var uploader_'.$meta_key.' = new plupload.Uploader('.json_encode($plupload_init).');
		
			  // checks if browser supports drag and drop upload, makes some css adjustments if necessary
			  uploader_'.$meta_key.'.bind("Init", function(up){
				var uploaddiv = $("#plupload-upload-ui-'.$meta_key.'");
		
				if(up.features.dragdrop){
				  uploaddiv.addClass("drag-drop");
					$("#drag-drop-area-'.$meta_key.'")
					  .bind("dragover.wp-uploader", function(){ uploaddiv.addClass("drag-over"); })
					  .bind("dragleave.wp-uploader, drop.wp-uploader", function(){ uploaddiv.removeClass("drag-over"); });
		
				}else{
				  uploaddiv.removeClass("drag-drop");
				  $("#drag-drop-area-'.$meta_key.'").unbind(".wp-uploader");
				}
			  });
		
			  uploader_'.$meta_key.'.init();
		
			  // a file was added in the queue
			  uploader_'.$meta_key.'.bind("FilesAdded", function(up, files){
				var hundredmb = 100 * 1024 * 1024, max = parseInt(up.settings.max_file_size, 10);
		
				plupload.each(files, function(file){
				  if (max > hundredmb && file.size > hundredmb && up.runtime != "html5"){
					// file size error?
					console.log("Error...");
				  }else{
		
					// a file was added, you may want to update your DOM here...
					//console.log(file);
					//alert(file);
					//
					
				  }
				});
		
				up.refresh();
				up.start();
			  });
		
			  // a file was uploaded 
			  uploader_'.$meta_key.'.bind("FileUploaded", function(up, file, response) {
		
				// this is your ajax response, update the DOM with it or something...
				//console.log(response);
				
				
				var result = $.parseJSON(response.response);
				
				
		
				var attach_url = result.html.attach_url;
				var attach_id = result.html.attach_id;
				var attach_title = result.html.attach_title;
				
				var html_new = "<div class=item attach_id="+attach_id+"><img src="+attach_url+" /><span attach_id="+attach_id+" class=delete>Delete</span><input  type=hidden name='.$meta_key.'[] value="+attach_id+" /></div>";
				
				$("#plupload-upload-ui-'.$meta_key.' .drag-drop-inside").prepend(html_new); 
				 
			  });
		
			});   
		
		  </script>
			
			';		
			
				
					
					return $html;		
					
					
					}	
					
					
					
					
					
					
				elseif($input_type == 'upload'){
					
					
					//$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"></div>';
					
					//$html .= '<div class="file-upload">';
					//$html.= '<input  type="text" id="file_'.$meta_key.'" name="'.$meta_key.'" value="'.$input_values.'" />';

					//$html .= '<span class="loading">'.__('loading',classified_maker_textdomain).'</span>';	
					//$html .= '<a title="'.__('filetype: (jpg, png, jpeg), max size: 2Mb',classified_maker_textdomain).'" id="file-uploader" href="#">'.__('Upload',classified_maker_textdomain).'</a>';			
					//$html.= '</div>';
					$html.= '<input id="'.$meta_key.'" type="hidden" placeholder="" name="'.$meta_key.'" value="'.$input_values.'" /> ';
					$html .= '<div id="file-upload-container">';
					//$html.= '<input  type="text" id="file_'.$option_key.'" name="'.$option_key.'" value="'.$input_values.'" />';
					//$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"></div>';




					$html.= '<div id="uploaded-image-container">';

					$cookie_name = 'classified_maker_ads_thumbs';
					
					
					if(!empty($input_values)){
						
						$attach_ids = explode(',',$input_values);
						
						}
					elseif(!empty($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						$attach_ids = explode(',',$attach_ids);
						
						}
					else{
						$attach_ids = array();
						}
						
						foreach($attach_ids as $attach_id){
							
							$attach_url = wp_get_attachment_url($attach_id);
							$attach_title = get_the_title($attach_id);	
							if(!empty($attach_id) && !empty($attach_url)){
								
							$html.= '<div attach_id="'.$attach_id.'" class="file"><div class="preview"><img src="'.$attach_url.'" title="'.$attach_title.'" /></div><div class="name">'.$attach_title.'</div><span attach_id="'.$attach_id.'" class="remove"><i class="fa fa-times"></i></span><span class="move"><i class="fa fa-sort"></i></span></div>';
								
								}

								
							}	

									
										
										
					$html.= '</div>';	
					
					$html .= '<a title="'.__('filetype: (jpg, png, jpeg), max size: 200Mb',classified_maker_textdomain).'" id="file-uploader" href="#">'.__('Upload',classified_maker_textdomain).'</a>';
					
					$html .= '<div class="reset">'.__('Reset',classified_maker_textdomain).'</div>';					
					
														
					$html.= '</div>';
					
					
					
					
					
					
					
					
					}
					
				elseif($input_type == 'recaptcha'){
					

					
					
					if($classified_maker_reCAPTCHA_enable=='yes'){
						
						$html.= '<script src="https://www.google.com/recaptcha/api.js"></script>';
						$html.= '<div class="g-recaptcha" data-sitekey="'.$classified_maker_reCAPTCHA_site_key.'"></div>';
						$html.= '<input id="'.$meta_key.'" type="hidden" placeholder="" name="'.$meta_key.'" value="'.$input_values.'" /> ';
						
						}
					

					
					}
					
		
				$html.= '</div>';
		
		
			return $html;
		
		}
		
	
	}
	
	//new class_classified_maker_functions();