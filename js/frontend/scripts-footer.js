( function( $ ) 
{
	function find_a_node (what, inwhat)
	{
		var found_in		= '';
		var type 			= inwhat.get(0).nodeName.toLowerCase();
		if (what == type)
		{
			found_in 		= inwhat;
		}
		else
		{
			found_in 		= find_a_node (what, inwhat.parent());
		}
		if (found_in)
		{
			return found_in;
		}
	}	
	// toggle display radio select
	$("body").delegate("input[name=cookie_tool_choice]","click",function(e)
	{
		var selected_radio = $(this).attr('value');
		$("input[name=cookie_tool_choice]").each(function()
		{
			$(".options-explained-item").hide();
		});
		$("#cookie-tool-view"+selected_radio).show();
	});
	// more info custom overlay
	$("body").delegate(".mmm-fancybox","click",function(e)
	{
		var selected_mmm_fancybox_id 			= 	jQuery(this).attr('title');
		var mmm_fancybox_display 				= 	jQuery(selected_mmm_fancybox_id).css("display");
		if (mmm_fancybox_display == 'none')
		{
			jQuery(selected_mmm_fancybox_id).show();
		}
		else
		{
			jQuery(selected_mmm_fancybox_id).hide();
		}
	});
	$("body").delegate(".cookie-tool-container-close","click",function(e)
	{
		var selected_mmm_fancybox_id 			= 	jQuery(this).parent().parent().parent().parent();
		var mmm_fancybox_display 				= 	jQuery(selected_mmm_fancybox_id).css("display");
		if (mmm_fancybox_display == 'none')
		{
			jQuery(selected_mmm_fancybox_id).show();
		}
		else
		{
			jQuery(selected_mmm_fancybox_id).hide();
		}
	});
	// accept button
	$("body").delegate("input[name=cookie-law-accept]","click",function(e)
	{
		var find_form							= 	find_a_node('form', $(this));
		var inputs 								= 	find_form.find('input, select, textarea').serialize();
		var todo								= 	inputs + '&action=insert_ip';
		e.preventDefault();
		jQuery.ajax({
			   type: 		"POST",
			   url: 		window.ajaxurl,
			   data: 		todo
		});
		$('#cookie-tool-container-large').hide();
		$('.cookie-tool-container.small').hide();
		return false;
	});
} )( jQuery );