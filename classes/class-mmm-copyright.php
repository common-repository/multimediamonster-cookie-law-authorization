<?php
class mmm_cla_copyright 
{		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	CREATE COPYRIGHT COLUMN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
	static function copyright_column ()
	{		
		?>
		<div class="div-to-cell mmm-copyright">
			<div class="copyright-container">
				<div class="copyright-content">
					<h4><?php _e('Hi there!', MMM_CLA_PLUGIN_TRANSLATE); ?></h4>
					<?php
					$replace_array 								= 	array(
																		MMM_CLA_PLUGIN_CREATOR_EMAIL,
																		MMM_CLA_PLUGIN_CREATOR_URL,
																		MMM_CLA_PLUGIN_CREATOR,
																		MMM_CLA_PLUGIN_CREATOR_AUTHOR,
																		MMM_CLA_PLUGIN_CREATOR_URL,
																		MMM_CLA_PLUGIN_CREATOR_URL
																	);
					mmm_cla_admin_functions::printf_array (__("How nice you started using my plugin! I really have no terms or conditions of using it. You can just install it. You don&#8217;t have to mention anything or link to my page or other weird stuff.<br /><br />If you encounter something where your mind goes &#8220;ehmmm that&#8217;s not right&#8221; (I can&#8217;t imagine it happening but you never know) please contact me. You can <a href='mailto:%s'>e-mail me</a> or send me a message through the contact form on <a href='http://%s' target='_blank'>my website</a>.<br /><br /><b>With love and cookies %s</b><br />(%s)<br /><a href='http://%s' target='_blank'>%s</a>", MMM_CLA_PLUGIN_TRANSLATE), $replace_array); 
					?>
					<img src="<?php echo MMM_CLA_PLUGIN_URL; ?>/images/admin/logo.png" class="logo" />
				</div>
			</div>
		</div>
		<?php
	}
}