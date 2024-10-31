<?php
class mmm_cla_frontend_actions 
{
	static function insert_ip()
	{
		global $wpdb;
		$ip 									= 	mmm_cla_frontend_functions::get_ip();
		$result 								= 	$wpdb->insert
													( 
														"{$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT, 
															array( 
																'id' 							=> "",
																'ipaddress' 					=> $ip,
																'date_time' 					=> current_time( 'mysql' ),
																'level' 						=> $_POST['cookie_tool_choice']
															), 
															array(
																'%d',
																'%s',
																'%s',
																'%s'
														)
													);
		die ();
	}
}