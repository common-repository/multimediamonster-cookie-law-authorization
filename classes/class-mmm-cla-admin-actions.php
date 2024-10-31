<?php
class mmm_cla_admin_actions 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	CUSTOM RESPONSE MESSAGES AFTER REDIRECT
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function custom_admin_messages_show($message = null, $class = 'updated')
		{
			if($message === null)
				return;
			echo '<div id="message" class="'.$class.' fade">';
				echo '<p>';
					echo $message;
				echo '</p>';
			echo '</div>';
		}
		static function custom_plugin_messages_create($to_administrate)
		{
			$messages						= array();
			if ($to_administrate == 'settings')
			{
				$messages['messages'] 							= 	array
																	(
																		0 	=> 	array('updated', __('The settings have been succesfully updated.', MMM_CLA_PLUGIN_TRANSLATE)),
																		1 	=> 	array('error', __('You are not authorized to perform this action.', MMM_CLA_PLUGIN_TRANSLATE)),
																		2 	=> 	array('error', __('You did not fill in all the required fields.', MMM_CLA_PLUGIN_TRANSLATE))
																	);
			}
			if ($to_administrate == 'authorized')
			{
				$messages['messages'] 							= 	array
																	(
																		0 	=> 	array('updated', __('The IP-addresses are succesfully deleted.', MMM_CLA_PLUGIN_TRANSLATE)),
																		1 	=> 	array('error', __('You are not authorized to perform this action.', MMM_CLA_PLUGIN_TRANSLATE)),
																		2 	=> 	array('error', __('Please select one or more IP-adresses.', MMM_CLA_PLUGIN_TRANSLATE))
																	);
			}
			return $messages;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	CUSTOM ADMIN ACTIONS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function custom_admin_actions($handled_by = '') 
		{
			if (isset($_POST['handled_by']))
			{
				$handled_by 										= 	$_POST['handled_by'];
			}
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	THE ACTUAL DO
			// 	@since									MultiMediaMonster
			// ---------------------------------------------------------------------------------------------------------------------
			
				$redirect_error										= 	0;
				if (!empty($_POST['nonce_'.MMM_CLA_PLUGIN_ID_LONG]))
				{
					if (!wp_verify_nonce($_POST['nonce_'.MMM_CLA_PLUGIN_ID_LONG], 'handle_'.MMM_CLA_PLUGIN_ID_LONG))
					{
						$redirect_error								=	1;
					}
					else
					{
						// ---------------------------------------------------------------------------------------------------------------------
						// 	EDIT SETTINGS
						// 	@since									MultiMediaMonster
						// ---------------------------------------------------------------------------------------------------------------------
							
							if (isset($_POST['todo']) && $_POST['todo'] == 'edit-settings')
							{
								// looped error
								$looped_error						= '';
								$formfields							= mmm_cla_settings::formfields_tabs();
								foreach ($formfields as $formfields_key => $formfields_val)
								{
									foreach ($formfields_val as $formfields_val_key => $formfields_val_val)
									{
										if (isset($formfields_val_val['required']) && $formfields_val_val['required'] == true)
										{
											$the_post_key_array 								= 	explode('_', $formfields_key);
											$the_post_key_first									=	$the_post_key_array[0];
											$the_post_key_last									=	$the_post_key_array[1];
											if (count($the_post_key_array) > 2)
											{
												$the_post_key_last								.=	'_'.$the_post_key_array[2];
											}
											if ($formfields_val_val['type'] == 'levels')
											{
												$values 										= 	$formfields_val_val['values'];
												foreach ($values as $values_key => $values_val)
												{
													foreach ($values_val as $values_val_key => $values_val_val)
													{
														if (isset($values_val_val['required']) && $values_val_val['required'] == true)
														{
															$the_post_val 					= 	$_POST[MMM_CLA_PLUGIN_ID_SHORT.'_'.$the_post_key_first][$the_post_key_last][$values_val_key.$values_key];
															if (!$the_post_val)
															{
																$looped_error				= 	2;
															}
														}
													}
												}
											}
											else
											{
												$the_post_val 								= 	$_POST[MMM_CLA_PLUGIN_ID_SHORT.'_'.$the_post_key_first][$the_post_key_last][$formfields_val_key];
												if (!$the_post_val)
												{
													$looped_error							= 	2;
												}
											}
										}
									}
								}
								if ($looped_error)
								{
									$redirect_error					= 	$looped_error;
								}
								else
								{
									$defaults 						= 	mmm_cla_settings::default_values();
									$instance 						= 	wp_parse_args((array) $_POST[MMM_CLA_PLUGIN_ID_SHORT.'_settings'], $defaults);
									if (isset($_POST['reset']) && $_POST['reset'])
									{
										delete_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings' );
									}
									elseif (isset($_POST['save']) && $_POST['save'])
									{
										update_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $instance );
									}
								}
							}
							
						// ---------------------------------------------------------------------------------------------------------------------
						// 	DELETING IP's
						// 	@since									MultiMediaMonster
						// ---------------------------------------------------------------------------------------------------------------------
							
							if (isset($_POST['todo']) && $_POST['todo'] == 'delete-authorized')
							{
								if (empty($_POST['delete_ip_with_id']))
								{
									$redirect_error					= 	2;
								}
								else
								{
									global $wpdb;
									foreach ($_POST['delete_ip_with_id'] as $posted_key => $posted_val)
									{
										//delete the records
										$query_to_run 				= 	"DELETE FROM {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT." WHERE id = $posted_val";
										$wpdb->query( $query_to_run );
									}
								}
							}
					}
					if ($handled_by != 'ajax')
					{
						$_POST['_wp_http_referer'] 					= 	add_query_arg('message', $redirect_error, $_POST['_wp_http_referer']);
						wp_redirect( $_POST['_wp_http_referer']);
					}
				}
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	END THE ACTUAL DO
			// ---------------------------------------------------------------------------------------------------------------------
			
			if ($handled_by == 'ajax')
			{
				if ((isset($_POST['todo']) && $_POST['todo'] == 'tiny_mce') && (isset($_POST['textarea_id']) && $_POST['textarea_id'] && isset($_POST['textarea_name']) && $_POST['textarea_name']))
				{
					$quicktags_settings 		= array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close' );
					$settings 					= array('media_buttons' => false, 'teeny' => true, 'quicktags' => $quicktags_settings, 'textarea_name' => $_POST['textarea_name']); //, 'textarea_name' => 'mmm_cla_settings[levels][title4]'
					wp_editor( '', $_POST['textarea_id'], $settings );
				}
				die ();
			}
		}	

}