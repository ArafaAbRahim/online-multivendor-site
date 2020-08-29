jQuery(document).ready(function($)
	{



	$(function() {
		$( ".classified-maker .repatble" ).sortable();
	//$( ".items-container" ).disableSelection(); //{ handle: '.section-header' }
	});
	
	
	$(function() {
		$( ".drag-drop-inside" ).sortable({
			
			cancel: ".ui-state-disabled",
			revert: "invalid", 
			//handle: '.move',

			});
	//$( ".items-container" ).disableSelection(); //{ handle: '.section-header' }
	});	



		$(document).on('click', '.classified-maker .add-field', function()
			{	
			
				var option_id = $(this).attr('option-id');
				
				var id = $.now();

				var html = '<div class="single"><input type="text" name="'+option_id+'['+id+']" value="" /><input class="remove-field" type="button" value="Remove"></div>';
				//alert(html);
					$(this).prev('.repatble').append(html);
					
					
				})

		$(document).on('click', '.classified-maker .remove-field', function()
			{	
				var is_confirm = $(this).attr('confirm');
				
				if(is_confirm=='yes'){
					
						$(this).prev().remove();
						$(this).remove();	
					
					}
				else{
						$(this).attr('confirm','yes');
						$(this).val('Confirm');
						$(this).css('color','#ff6d4b');
					
					}

				})

	});	







