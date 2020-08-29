jQuery(document).ready(function($)
	{



		$(document).on('click', '.choose-ads-cat .select-category', function()
			{
				ads_cat = $('.ads-cat').val();
					
				console.log(ads_cat);
					
				$.ajax(
					{
				type: 'POST',
				context: this,
				url:classified_maker_ajax.classified_maker_ajaxurl,
				data: {"action": "classified_maker_select_category", },
				success: function(data)
						{	
						
							//$(this).html('Update Done');
						
							//location.reload();
						}
					});

			})




		$(document).on('click', '.tab-nav li', function()
			{
				$(".active").removeClass("active");
				$(this).addClass("active");
				
				var nav = $(this).attr("nav");
				
				$(".box li.tab-box").css("display","none");
				$(".box"+nav).css("display","block");
		
			})


		$(document).on('click', '.field-set .update-field-set', function()
			{

				if(confirm("Do you really want to update ?")){
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:classified_maker_ajax.classified_maker_ajaxurl,
					data: {"action": "classified_maker_admin_update_field_set", },
					success: function(data)
							{	
							
								$(this).html('Update Done');
							
								location.reload();
							}
						});
					
					}

				})




		$(document).on('click', '.field-set .reset-field-set', function()
			{

				if(confirm("Do you really want to reset ?")){
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:classified_maker_ajax.classified_maker_ajaxurl,
					data: {"action": "classified_maker_admin_reset_field_set", },
					success: function(data)
							{	
							
								$(this).html('Reset Done');
							
								location.reload();
							}
						});
					
					}

				})









	});	







