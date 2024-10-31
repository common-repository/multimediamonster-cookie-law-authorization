<?php
class mmm_cla_admin_menu_items 
{
	static function add_screenoption ()
	{
		$option 					=	'per_page';
		$args 						= 	array(
											'label' 				=> __('IP addresses', MMM_CLA_PLUGIN_TRANSLATE),
											'default' 				=> 10,
											'option' 				=> MMM_CLA_PLUGIN_ID_SHORT.'_ipaddresses_per_page'
										);
		add_screen_option( $option, $args );
	}
	static function set_screenoption($status, $option, $value)
	{
		if ( MMM_CLA_PLUGIN_ID_SHORT.'_ipaddresses_per_page' == $option ) return $value;
		return $status;
	}

	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE ADMIN MENU ITEMS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_admin_menu_items ()
		{
			$admin_page 			= 	add_menu_page( '', MMM_CLA_PLUGIN_NAME, 'manage_options', MMM_CLA_PLUGIN_ID_LONG_MINUS.'-settings', array( MMM_CLA_PLUGIN_ID_SHORT.'_admin_pages', 'add_admin_page' ), MMM_CLA_PLUGIN_URL.'/images/admin/menu-icon.png', 100 );
			
			$submenu_pages 			= 	array(
											array(
												MMM_CLA_PLUGIN_ID_LONG_MINUS.'-settings',
												'',
												__('Authorized', MMM_CLA_PLUGIN_TRANSLATE),
												'manage_options',
												MMM_CLA_PLUGIN_ID_LONG_MINUS.'-authorized',
												array( MMM_CLA_PLUGIN_ID_SHORT.'_admin_pages', 'add_admin_page' )
											)
										);
			
			$submenu_pages 			= 	apply_filters( MMM_CLA_PLUGIN_ID_LONG, $submenu_pages );
			if (count($submenu_pages)) 
			{
				foreach ($submenu_pages as $submenu_page)
				{
					// Add submenu page
					$admin_subpage 	= 	add_submenu_page( $submenu_page[0], $submenu_page[2], $submenu_page[2], $submenu_page[3], $submenu_page[4], $submenu_page[5] );
					add_action( "load-".$admin_subpage, MMM_CLA_PLUGIN_ID_SHORT.'_admin_menu_items::add_screenoption' );
				}
			}
			global $submenu;
			if (isset($submenu[MMM_CLA_PLUGIN_ID_LONG_MINUS.'-settings']))
			{
				$submenu[MMM_CLA_PLUGIN_ID_LONG_MINUS.'-settings'][0][0] = __('Settings', MMM_CLA_PLUGIN_TRANSLATE);
			}
		}
}