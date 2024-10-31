<?php
class mmm_cla_register 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU ACTIVATE THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function activate() 
		{
			add_option( 'activated_'.MMM_CLA_PLUGIN_ID_LONG, 'slug-'.MMM_CLA_PLUGIN_ID_LONG_MINUS );
		}
		static function load_this_plugin()
		{
			if ( is_admin() && get_option( 'activated_'.MMM_CLA_PLUGIN_ID_LONG ) == 'slug-'.MMM_CLA_PLUGIN_ID_LONG_MINUS )
			{
				delete_option( 'activated_'.MMM_CLA_PLUGIN_ID_LONG );
				add_action( 'init', self::create_table() );
			}
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU DEACTIVATE THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function deactivate() 
		{
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU UNINSTALL THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function uninstall() 
		{
			delete_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings' );
			add_action( 'init', self::drop_table() );
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	LOADING THE TEXTDOMAIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function plugin_load_textdomain() 
		{
			load_plugin_textdomain( 'mmm-cla-translated', false, MMM_CLA_PLUGIN_TEXTDOMAIN ); 
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PLUGIN SCRITPS AND SCRIPTS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function frontend_styles() 
		{
			$defaults 							= 	mmm_cla_settings::default_values();
			$values_db							= 	get_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $defaults );
			$values_field 						= 	wp_parse_args((array) $values_db, $defaults);
			// load frontend styles
			wp_enqueue_style( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-frontend-styles', MMM_CLA_PLUGIN_URL . '/css/frontend/style.css', array(), MMM_CLA_PLUGIN_ID_SHORT_MINUS );
			$layout_array					= 	array();
			$layout_array					= 	array_merge($layout_array, array('layout_small' => $values_field['layout_small']), array('layout_large' => $values_field['layout_large']));
			$parsed_layout					= 	mmm_cla_frontend_functions::parse_layout($layout_array);
			wp_add_inline_style( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-frontend-styles', $parsed_layout );
		}
		static function frontend_scripts()
		{					
			wp_enqueue_script( 'jquery-ui-draggable' ); 
			wp_enqueue_script( 'jquery-ui-droppable' );
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	ADD SOME VARIABLES TO JAVASCRIPT
			// ---------------------------------------------------------------------------------------------------------------------
				
				$defaults 																			= 	mmm_cla_settings::default_values();
				$values_db																			= 	get_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $defaults );
				$values_field 																		= 	wp_parse_args((array) $values_db, $defaults);
				$cla_js_vars																		=	MMM_CLA_PLUGIN_ID_SHORT."_js_variables_array"; 
				${$cla_js_vars}																		=	array();
				${$cla_js_vars}['small_pos_vertical']												=	$values_field['layout_small']['pos_vertical']; 
				${$cla_js_vars}['large_width']														=	$values_field['layout_large']['width']; 
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	END ADD SOME VARIABLES TO JAVASCRIPT
			// ---------------------------------------------------------------------------------------------------------------------
				
			// load frontend scripts
			wp_enqueue_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-frontend-scripts-header', MMM_CLA_PLUGIN_URL . '/js/frontend/scripts-header.js', array( 'jquery' ), MMM_CLA_PLUGIN_ID_SHORT_MINUS, false );
			wp_localize_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-frontend-scripts-header', $cla_js_vars, ${$cla_js_vars} );																				
														
			wp_enqueue_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-frontend-scripts-footer', MMM_CLA_PLUGIN_URL . '/js/frontend/scripts-footer.js', array( 'jquery' ), MMM_CLA_PLUGIN_ID_SHORT_MINUS, true );
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADMIN STYLES AND SCRIPTS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------

		static function admin_styles() 
		{
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-admin-styles', MMM_CLA_PLUGIN_URL . '/css/admin/style.css', array(), MMM_CLA_PLUGIN_ID_SHORT_MINUS );
			wp_enqueue_style( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-admin-styles-copyright', MMM_CLA_PLUGIN_URL . '/css/admin/style-copyright.css', array(), MMM_CLA_PLUGIN_ID_SHORT_MINUS.'-admin-styles-copyright' );
		}
		static function admin_scripts() 
		{
			// ---------------------------------------------------------------------------------------------------------------------
			// 	ADD SOME VARIABLES TO JAVASCRIPT
			// ---------------------------------------------------------------------------------------------------------------------
				
				$cla_js_vars																		=	MMM_CLA_PLUGIN_ID_SHORT."_js_variables_array"; 
				${$cla_js_vars}																		=	array();
				${$cla_js_vars} 																	= 	mmm_cla_admin_functions::translated_texts(); 
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	END ADD SOME VARIABLES TO JAVASCRIPT
			// ---------------------------------------------------------------------------------------------------------------------
			
			// load admin scripts
			wp_enqueue_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-admin-scripts-header', MMM_CLA_PLUGIN_URL . '/js/admin/scripts-header.js', array( 'jquery' ), MMM_CLA_PLUGIN_ID_SHORT_MINUS, false );
			wp_localize_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-admin-scripts-header', $cla_js_vars, ${$cla_js_vars} );
			
			wp_enqueue_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-admin-scripts-footer', MMM_CLA_PLUGIN_URL . '/js/admin/scripts-footer.js', array( 'jquery' ), MMM_CLA_PLUGIN_ID_SHORT_MINUS, true );
			
			// colorpicker
			wp_enqueue_script( 'wp-color-picker' );
			// google
			wp_register_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-google-api', "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
			wp_enqueue_script( MMM_CLA_PLUGIN_ID_LONG_MINUS.'-google-api');
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	CREATING AND DROPPING TABLES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function create_table ()
		{
			global $wpdb;
			$mmm_plugin_table_cols				= 	array
													(
														'`id` int(11) NOT NULL AUTO_INCREMENT', 
														'`ipaddress` varchar(255) NOT NULL', 
														'`date_time` datetime NOT NULL', 
														'`level` int(11) NOT NULL', 
														'PRIMARY KEY (`id`)'
													);
			$query_to_run 						= 	"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT." 
													(".join(', ', $mmm_plugin_table_cols).") DEFAULT CHARSET=utf8;";
			$wpdb->query( $query_to_run );
		}
		static function drop_table ()
		{
			global $wpdb;
			$query_to_run 						= 	"DROP TABLE IF EXISTS {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT;
			$wpdb->query( $query_to_run );
		}
}