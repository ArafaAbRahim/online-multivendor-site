jQuery(document).ready(function($)
	{
		
		$( "#classified_maker_ads_company_id" ).select2({        
			ajax: {
				url:classified_maker_ajax.classified_maker_ajaxurl,
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
						action: 'classified_maker_ajax_company'
					};
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
			},
			minimumInputLength: 2,
			placeholder: "Type Company Name",
		});

		
		
				
		$(document).on('click', '.my-wishlist .item .cm_meta.remove', function() {
			
			ads_id = $(this).parent().attr('ads_id');
			
			__HTML__ = $(this).html();
			$(this).html('<i class="fa fa-cog fa-spin"></i>');
			
			
			$.ajax(
				{
			type: 'POST',
			context: this,
			url:classified_maker_ajax.classified_maker_ajaxurl,
			data: {
				"action": "classified_maker_ajax_remove_wishlist_ads", 
				"ads_id":ads_id,
			},
			success: function(data) {	
				
				$(this).html( __HTML__ );
				
				if( data == 'removed' ) {
					$(this).parent().remove();
				}
			}
				});
				
				
				
		})
		
		
		$(document).on('click', '.single-ads .btn_wishlist', function() {
			
			ads_id = $(this).attr('ads_id');
			
			$('.single-ads .wishlist_notice').remove();
			
			__HTML__ = $(this).html();
			$(this).html('<i class="fa fa-cog fa-spin"></i>');
			
			$.ajax(
				{
			type: 'POST',
			context: this,
			url:classified_maker_ajax.classified_maker_ajaxurl,
			data: {
				"action": "classified_maker_ajax_ads_wishlist", 
				"ads_id":ads_id,
			},
			success: function(data) {	
				
				$(this).parent().prepend( data );
				$(this).html( __HTML__ );

			}
				});
				
				
		})
		
		
		
		
		
		
		
		$(document).on('click', '.single-ads .report_screen .screen_close', function() {
			
			$('.single-ads .report-ad .report_screen').fadeOut();
		})
		
		
		
		$(document).on('click', '.report_screen .report_submit', function() {
			
			ads_id = $(this).parent().parent().parent().attr('ads_id');
			input_reason = $('.report_screen .screen_input .input_reason').val();
			input_message = $('.report_screen .screen_input .input_message').val();
			
			if( input_reason.length == 0 ){
				$('.report_screen .screen_input .input_reason').addClass('input_error');
				return;
			}
			else $('.report_screen .screen_input .input_reason').removeClass('input_error');
			
			if( input_message.length == 0 ){
				$('.report_screen .screen_input .input_message').addClass('input_error');
				return;
			}
			else $('.report_screen .screen_input .input_message').removeClass('input_error');
			
			
			__HTML__ = $(this).html();
			$(this).html('<i class="fa fa-cog fa-spin"></i>');
			
			$.ajax(
				{
			type: 'POST',
			context: this,
			url:classified_maker_ajax.classified_maker_ajaxurl,
			data: {
				"action": "classified_maker_ajax_report_ads", 
				"ads_id":ads_id,
				"input_reason":input_reason,
				"input_message":input_message,
			},
			success: function(data) {	
				
				$('.report_screen .report_screen_box').prepend(data);
				$(this).html( __HTML__ );
			
				$('.report_screen .screen_input .input_reason').val("");
				$('.report_screen .screen_input .input_message').val("");
			}
				});
				
		})
		
		
		
		$(document).on('click', '.single-ads #report-ad', function() {
			
			$('.single-ads .report-ad .report_screen').fadeIn();
			
			$('.single-ads .report_screen .report_screen_box .report_screen_notice').remove();
			
		})
		
		
		
		
		$(document).on('click', '.my-ads .delete-ads', function() {
			
			var is_confirm = $(this).attr('confirm');
				
			if(is_confirm=='yes'){
					
						var ads_id = $(this).attr('ads-id');
					
						$.ajax(
							{
						type: 'POST',
						context: this,
						url:classified_maker_ajax.classified_maker_ajaxurl,
						data: {"action": "classified_maker_ajax_delete_ads", "ads_id":ads_id,},
						success: function(data)
								{	
									//alert(data);
									$(this).parent().parent().remove();
									//$('.see-phone-number .phone-number').html(data);
								location.reload(true);
			
								}
							});
					
					}
				else{
						$(this).html(L10n_classified_maker.confirm_text);
						$(this).attr('confirm','yes');
					
					}
				
					
					
					
					
					

						

						

										

				

				})



		$(document).on('click', '.single-ads .click-to-email', function()
			{	
			
			
				if($(this).hasClass('active'))
					{
						$(this).removeClass('active');
						$('.email-popup').fadeOut();
					}
				else
					{
						$(this).addClass('active');	
						$('.email-popup').fadeIn();
					}

			
				

				})

		$(document).on('click', '.single-ads .send-email', function()
			{
				
				var ads_id = $(this).attr('ads-id');
				
				var email = $('.email-popup .email').val();
				var name = $('.email-popup .name').val();				
				var phone = $('.email-popup .phone').val();	
				var message = $('.email-popup .message').val();							
				
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:classified_maker_ajax.classified_maker_ajaxurl,
					data: {"action": "classified_maker_send_email_to_seller", "ads_id":ads_id,"email":email,"name":name,"phone":phone,"message":message},
					success: function(data)
							{	
							
								var data = JSON.parse(data)
								
						
								
								if(data['error_name']){
									var error_name = data['error_name'];
									}
								else{
									var error_name = '';
									}								
								
								if(data['error_email']){
									var error_email = data['error_email'];
									}
								else{
									var error_email = '';
									}								

								if(data['error_phone']){
									var error_phone = data['error_phone'];
									}
								else{
									var error_phone = '';
									}								
								
								if(data['error_message']){
									var error_message = data['error_message'];
									}
								else{
									var error_message = '';
									}									

								if(data['success']){
									var success = data['success'];
									}
								else{
									var success = '';
									}
									
								if(data['failed']){
									var failed = data['failed'];
									}
								else{
									var failed = '';
									}									
									
									
								

								$('.status').html(error_name+''+error_email+''+error_phone+''+error_message+''+success+''+failed);
							
		
							}
						});
				

				})
				
				


		$(document).on('click', '.single-ads .see-phone-number', function()
			{
				
					var ads_id = $(this).attr('ads-id');
					
					$('.see-phone-number .phone-number').html('Loading...');
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:classified_maker_ajax.classified_maker_ajaxurl,
					data: {"action": "classified_maker_see_phone_number", "ads_id":ads_id,},
					success: function(data)
							{	
							
								$('.see-phone-number .phone-number').html(data);
							
		
							}
						});
				

				})




		$(document).on('click', '.post-ads #file-upload-container .reset', function()
			{
				
				if(confirm('Do you really want to reset ?')){
					
					$('#classified_maker_ads_thumbs').val('');
					
					$('#file-upload-container .file').fadeOut();
					document.cookie="classified_maker_ads_thumbs=; path=/";
					
					}
				

				})




		$(document).on('click', '.post-ads .plupload-upload-ui .delete', function()
			{

				var attach_id = $(this).attr('attach_id');
				
				//alert(attach_id);
				if(confirm('Do you really want to delete ?')){
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:classified_maker_ajax.classified_maker_ajaxurl,
					data: {"action": "classified_maker_delete_attachment", "attach_id":attach_id,},
					success: function(data)
							{	
								//alert('Hello');
								$('#classified_maker_ads_thumbs').val(data);
								
								$(this).parent().fadeOut()
		
							}
						});	
					
					}
				

				
				
				})




		$(document).on('click', '.post-ads .next-step-3', function()
			{

				var location = $(".post-ads .location").val();
				//var city = $(".post-ads .city").val();

				document.cookie="classified_maker_location="+location;
				//document.cookie="classified_maker_city="+city;				
				
				url = window.location.href.replace(/&?step=([^&]$|[^&]*)/i, "");
				window.location.href = url+'?step=3';

				
			})
			
			
		$(document).on('click', '.post-ads .ads-cats li', function()
			{
				$('.post-ads .ads-cats li').removeClass('active');				
				$(this).addClass('active');
				
				var cat_id = $(this).attr('cat-id');
			
				if(cat_id==null){
					cat_id = '';
					}
			
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:classified_maker_ajax.classified_maker_ajaxurl,
					data: {"action": "classified_maker_get_child_cats", "cat_id":cat_id,},
					success: function(data)
							{	
							
								document.cookie="classified_maker_cat_id="+cat_id;
							
								$('.ads-child-cats').html(data);
								
								
								
								
								
		
							}
						});

				
			})



		$(document).on('click', '.post-ads .ads-child-cats li', function()
			{
				
					var cat_id = $(this).attr('cat-id');
					
				$('.post-ads .ads-child-cats li').removeClass('active');				
				$(this).addClass('active');
				
				document.cookie="classified_maker_cat_id="+cat_id;
				
				url = window.location.href.replace(/&?step=([^&]$|[^&]*)/i, "");
				//window.location.href = url+'?step=2';

				
			})













	});	







