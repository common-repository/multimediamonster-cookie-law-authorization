jQuery( document ).ready(function()
{
	if (mmm_cla_js_variables_array.small_pos_vertical == 1)
	{
		jQuery(".cookie-tool-container").each(function(index, element) 
		{
			jQuery('body').prepend(jQuery(this).clone()).html();
			jQuery(this).remove();
		});
	}
	jQuery(".draggable").draggable({
		start: function()
		{
			jQuery(this).css('bottom', 'auto');
		}
	});
});
