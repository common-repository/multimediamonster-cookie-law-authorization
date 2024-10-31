<?php
class mmm_cla_admin_pages 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE ADMIN PAGE:::ALL
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function add_admin_page ()
		{
			$to_administrate_array							= 	explode('-', $_GET['page']);
			$to_administrate 								= 	$to_administrate_array[count($to_administrate_array)-1];
			?>
			<div class="wrap <?php echo MMM_CLA_PLUGIN_ID_LONG_MINUS; ?>">
                <h2>
					<?php echo MMM_CLA_PLUGIN_CREATOR; ?> &raquo; 
                    <?php echo MMM_CLA_PLUGIN_NAME; ?> &raquo; 
                    <?php _e(ucwords($to_administrate), MMM_CLA_PLUGIN_TRANSLATE); ?>
                </h2>

                <form method="post" action="admin.php?page=<?php echo MMM_CLA_PLUGIN_ID_LONG_MINUS.'-'.$to_administrate; ?>"> 
					<?php 
                    wp_nonce_field('handle_'.MMM_CLA_PLUGIN_ID_LONG, 'nonce_'.MMM_CLA_PLUGIN_ID_LONG); 
					$todo									= 	'';
                    if ($to_administrate == 'authorized')
					{
						global $wpdb;
						$user 								= 	get_current_user_id();
						$screen 							= 	get_current_screen();
						$option								= 	$screen->get_option('per_page', 'option');
						$per_page 							= 	get_user_meta($user, $option, true);
						if ( empty ( $per_page) || $per_page < 1 )
						{
						 	$per_page 						= 	$screen->get_option( 'per_page', 'default' );
						}
						
						$pagenum							= 	isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
						
						$limit 								= 	$per_page; // number of rows in page
						$offset 							= 	( $pagenum - 1 ) * $limit;
						$total 								= 	$wpdb->get_var( "SELECT COUNT(`id`) FROM {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT );
						$num_of_pages 						= 	ceil( $total / $limit );
								
						$todo								= 	'delete-';
						$query_to_run 						= 	"SELECT *
																FROM {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT."
																ORDER BY 
																`date_time` DESC
																 LIMIT $offset, $limit
																";
						$plugin_results 					= 	$wpdb->get_results( $query_to_run );
						$page_links 						= 	paginate_links( array(
																	'base' 			=> add_query_arg( 'pagenum', '%#%' ),
																	'format'		=> '',
																	'prev_text' 	=> __( '&laquo;', MMM_CLA_PLUGIN_TRANSLATE ),
																	'next_text' 	=> __( '&raquo;', MMM_CLA_PLUGIN_TRANSLATE ),
																	'total' 		=> $num_of_pages,
																	'current' 		=> $pagenum
																) );
					}
					if ($to_administrate == 'settings')
					{
						$todo								= 	'edit-';
					}					
					?>                    
                    <input type="hidden" name="todo" value="<?php echo $todo.$to_administrate; ?>" />
                    
                    <input type="hidden" name="action" value="custom_admin_actions" />
                    <input type="hidden" name="handled_by" value="post" />
                    <div class="div-to-table">
                        <div class="div-to-row">
                            <div class="div-to-cell">
								<?php
								if ( isset($page_links) && $page_links ) 
								{
									$found = array($total);
									$total_found = mmm_cla_admin_functions::return_replaced_array(__( 'We have found a total of %s ip-adresses.', MMM_CLA_PLUGIN_TRANSLATE ), $found);
									
									echo '<br /><div class="tablenav"><div class="tablenav-pages">' . $total_found.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$page_links . '</div></div>';
								}
								$messages 									= 	mmm_cla_admin_actions::custom_plugin_messages_create($to_administrate);
								$the_class									=	$messages['messages'][$_GET['message']][0];
								$the_message								=	$messages['messages'][$_GET['message']][1];
								mmm_cla_admin_actions::custom_admin_messages_show($the_message, $the_class);
                              	
								// show the tabs and content
								$options									=	array();
								$options['to_administrate']					=	$to_administrate;
								$options['plugin_results'] 					=	$plugin_results;
							    mmm_cla_admin_pages_tabs::display_tab_link($options);
								mmm_cla_admin_pages_tabs::display_tab_content($options);
                                ?>
                			</div>
							<?php mmm_cla_copyright::copyright_column(); ?>
                        </div>
                    </div>
                </form>
            </div>
			<?
		}
}