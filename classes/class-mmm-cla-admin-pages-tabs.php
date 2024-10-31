<?php
class mmm_cla_admin_pages_tabs 
{

		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE TABS LINKS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function display_tab_link($options)
		{
			$return_tabs									=	'';
			$tabs											= 	mmm_cla_settings::tabs($options['to_administrate']);
			$tab_counter									= 	1;
			
			if (count($tabs) > 1)
			{
				// multiple tabs
				echo '<h2 class="nav-tab-wrapper">';
				foreach ($tabs as $tab_key => $tab_val)
				{
					$current_tab_class						= 	'';
					if ($tab_counter == 1)
					{
						$current_tab_class					= 	' nav-tab-active';
					}
					echo '<a href="javascript:void(0);" class="nav-tab'.$current_tab_class.' '.$tab_key.'">'.$tab_val.'</a>';
					$tab_counter++;
				}
				echo '</h2>';
			}
			echo $return_tabs;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE TABS CONTENT
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function display_tab_content($options = '')
		{
			$tabs											= 	mmm_cla_settings::tabs($options['to_administrate']);
			$tab_counter									= 	1;
			
			if (count($tabs) > 1)
			{
				// multiple tabs
				?>
                <table class="form-table">
                	<tr>
                        <td>
                        	<div class="nav-tab-wrapper-content">
								<?php
								foreach ($tabs as $tab_key => $tab_val)
								{
									$current_tab_class						= '';
									if ($tab_counter == 1)
									{
										$current_tab_class					= ' nav-tab-active-content';
									}
									?>
                                    <div class="nav-tab-content<?php echo $current_tab_class; ?> <?php echo $tab_key; ?>">
										<?php
                                        // run true function to get the info
                                        $function_name_base					= 'tab_function_'.$options['to_administrate'];
										$function_name_complete				= $function_name_base."_".$tab_key;
                                        $class_name							= get_class() ;
                                        
										if (method_exists($class_name, $function_name_complete))
                                        {	
											$function_to_run				= $function_name_complete;
                                        }
                                        elseif (method_exists($class_name, $function_name_base))
                                        {										
											$function_to_run 				= $function_name_base;
                                        }
										if (method_exists($class_name, $function_to_run))
                                        {										
											$options['tab'] 				= $tab_key;
											self::$function_to_run($options);
                                        }
                                        else
                                        {
                                            echo __( 'No info available.' , MMM_CLA_PLUGIN_TRANSLATE );
                                        }
                                        ?>
                                    </div>
                                    <?php
									$tab_counter++;
								}
								?>
							</div>
                    	</td>
                    </tr>
                </table>
                <input type="submit" id="save" name="save" class="button-primary" value="<?php _e( 'Save settings', MMM_CLA_PLUGIN_TRANSLATE ) ?>"/>
                <input type="submit" id="reset" name="reset" class="button-secondary" value="<?php _e( 'Reset settings', MMM_CLA_PLUGIN_TRANSLATE ) ?>"/>
                <br /><?php  echo __( '<em>*</em> <span class="small">required</span>' , MMM_CLA_PLUGIN_TRANSLATE ); ?>
				<?php
			}
			elseif (count($tabs) == 1)
			{
				// single tab
				foreach ($tabs as $tab_key => $tab_val)
				{
					$current_tab_class						= '';
					if ($tab_counter == 1)
					{
						$current_tab_class					= ' nav-tab-active-content';
					}
					// run true function to get the info
                    $function_name_base						= 'tab_function_'.$options['to_administrate'];
					$function_name_complete					= $function_name_base."_".$tab_key;
					$class_name								= get_class() ;
					
					if (method_exists($class_name, $function_name_complete))
					{	
						$function_to_run				= $function_name_complete;
					}
					elseif (method_exists($class_name, $function_name_base))
					{										
						$function_to_run 				= $function_name_base;
					}
					if (method_exists($class_name, $function_to_run))
					{										
						$options['tab'] 				= $tab_key;
						self::$function_to_run($options);
					}
					else
					{
						echo __( 'No info available.' , MMM_CLA_PLUGIN_TRANSLATE );
					}
				}
			}
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE ACTUAL TAB FUNCTIONS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	TAB:::AUTHORIZED
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static public function tab_function_authorized($options)
		{
			$plugin_results = $options['plugin_results'];
			if ($plugin_results)
			{
				?>
				<div class="hidden_ajax"></div>
                <div class="map-canvas-main-toggler">
                	<h3>
						<?php _e('Google maps', MMM_CLA_PLUGIN_TRANSLATE); ?>
                    	<a href="javascript:void(0);" class="slide googlemaps"><?php _e('slide up', MMM_CLA_PLUGIN_TRANSLATE); ?></a> 
                    </h3>
                	<div class="container googlemaps">
                    	<div class="map-canvas-main" id="map-canvas-main"></div>
                    </div>
                </div>
				<table class="wp-list-table widefat fixed posts">
					<thead>
						<tr>
							<?php
							$cols		= 0;
							foreach ( $plugin_results[0] as $col_name => $col_val) 
							{ 
								$column_th_class 			= ' class="'.$col_name.'"';
								$column_th_val 				= __($col_name, MMM_CLA_PLUGIN_TRANSLATE);
								if ($col_name == 'id')
								{
									$column_th_class 		= ' class="check-column"';
									$column_th_val 			= '<input type="checkbox" id="" class="'.MMM_CLA_PLUGIN_ID_LONG_MINUS.'-select-all" title="'.MMM_CLA_PLUGIN_ID_LONG_MINUS.'-bulk-action">';
								}
								?>
								<th<?php echo $column_th_class; ?>><?php _e( $column_th_val , MMM_CLA_PLUGIN_TRANSLATE )?></th>
								<?php
								$cols++;
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($plugin_results) 
						{
							foreach ( $plugin_results as $col_name => $col_val) 
							{
								?>
								<tr class="records<?php if ($col_name % 2 == 0) { ?> alternate<?php } ?>">
									<?php 
									foreach ( $col_val as $key => $val) 
									{ 
										// the val
										$the_val		 = $val;
										if ($key == 'date_time')
										{
											$the_val	= ''; 
											$the_val 	.= mmm_cla_admin_functions::return_date($val);
											$the_val 	.= mmm_cla_admin_functions::return_time($val);
										}
										if ($key == 'id')
										{
											$the_id		= $val;
											$the_val 	= '<input name="delete_ip_with_'.$key.'[]" type="checkbox" value="'.$val.'" />';
										}
										if ($key == 'level')
										{
											$defaults 	= 	mmm_cla_settings::default_values();
											$values_db	= 	get_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $defaults );
											$the_val 	= 	$val.' <span class="small">('.$values_db['levels']['title'.$val].')</span>';
										}
										// show the loop
										if ($key == 'id')
										{
											?>
											<th scope="row" class="check-column"><?php echo $the_val; ?></th>
											<?php
										}
										elseif ($key == 'ipaddress')
										{
											?>
											<td class="post-title page-title column-title">
												<strong>
													<img src="<?php echo MMM_CLA_PLUGIN_URL; ?>/images/admin/lang-icons/unknown.gif" class="img<?php echo $the_id; ?>" />
                                                    <a href="javascript:void(0);" class="showmarker <?php echo $col_val->id; ?>" id="<?php echo $the_val; ?>"><?php echo $the_val; ?></a>
												</strong>
												<div class="row-actions">
													<span class="trash"><a href="javascript:void(0);" class="ajax delete" id="<?php echo $col_val->id; ?>" title="<?php _e('delete', MMM_CLA_PLUGIN_TRANSLATE); ?>"><?php _e('delete', MMM_CLA_PLUGIN_TRANSLATE); ?></a></span>
												</div>
												<input name="ip" type="hidden" id="<?php echo $the_id; ?>" value="<?php echo $the_val; ?>" />
											</td>
											<?php
										}
										else
										{
											?>
											<td><?php echo $the_val; ?></td>
											<?php
										}
									}
									?>
								</tr>
                                <?php
							} 
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<?php
							foreach ( $plugin_results[0] as $col_name => $col_val) 
							{ 
								$column_th_class 			= '';
								$column_th_val 				= __($col_name, MMM_CLA_PLUGIN_TRANSLATE);
								if ($col_name == 'id')
								{
									$column_th_class 		= ' class="check-column"';
									$column_th_val 			= '<input type="checkbox" id="" class="ninja-forms-select-all" title="ninja-forms-bulk-action">';
								}
								?>
								<th<?php echo $column_th_class; ?>><?php _e( $column_th_val , MMM_CLA_PLUGIN_TRANSLATE )?></th>
								<?php
							}
							?>
						</tr>
					</tfoot>
				</table>
				<input class="button-primary" type="submit" value="<?php _e( 'Delete checked' , MMM_CLA_PLUGIN_TRANSLATE )?>" />
				<?php
			}
			else
			{
				echo __( 'No info available.' , MMM_CLA_PLUGIN_TRANSLATE );
			}
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	TAB:::SETTIGS ALL
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static public function tab_function_settings($options)
		{
			$formfields							= 	mmm_cla_settings::formfields_tabs($options);
			mmm_cla_settings::return_form($options, $formfields);
		}
		static public function tab_function_settings_help($options)
		{
			//values
			?>
            <h3><?php echo __('Help', MMM_CLA_PLUGIN_TRANSLATE); ?></h3>
            
			<?php
			$replace_array 								= 	array(
																MMM_CLA_PLUGIN_URL
															);
			mmm_cla_admin_functions::printf_array (__("With this plugin (and when you put it on) there wil be 2 elements placed on the website. One small block with basic information and one large block with extended information. The large block will be shown as a semi-fancybox when you click on the more information link. When you leave the link text blank this block will not be inserted.<br /><br /><img src='%s/images/admin/help1.jpg' /><br /><br />Besides configuration on the tabs you can also adjust other things true your them stylesheet. Below you will find a piece of code in wich I will try to make clear to you how the elements are placed.<br /><br />", MMM_CLA_PLUGIN_TRANSLATE), $replace_array); 
			?>
			<?php
            echo mmm_cla_admin_functions::printCode('<div class=|LIGHTBLUE:"cookie-tool-container small":LIGHTBLUE|> 
	|ORANGE:<form name=|LIGHTBLUE:"form-cookie-law":LIGHTBLUE|>:ORANGE|
		<div class=|LIGHTBLUE:"cookie-tool-content":LIGHTBLUE|> 
			<h1>|BLACK:|DYNAMIC:'.__('Title small block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</h1>
			|BLACK:|DYNAMIC:'.__('Text small block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|
			<br />
			|ORANGE:<input type=|LIGHTBLUE:"hidden":LIGHTBLUE| name=|LIGHTBLUE:"cookie_tool_choice":LIGHTBLUE| value=|LIGHTBLUE:"1":LIGHTBLUE| />:ORANGE|
			|ORANGE:<input type=|LIGHTBLUE:"button":LIGHTBLUE| value=|LIGHTBLUE:"|DYNAMIC:'.__('Button small block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|":LIGHTBLUE| />:ORANGE|
			|GREEN:<a class="|LIGHTBLUE:mmm-fancybox:LIGHTBLUE|">|BLACK:|DYNAMIC:'.__('Link small block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</a>:GREEN|
		</div>
	|ORANGE:</form>:ORANGE|
</div>', true);
            ?>
            
            <?php
            echo mmm_cla_admin_functions::printCode('<div class=|LIGHTBLUE:"cookie-tool-container large":LIGHTBLUE| id=|LIGHTBLUE:"cookie-tool-container-large":LIGHTBLUE|>
	|ORANGE:<form name=|LIGHTBLUE:"form-cookie-law":LIGHTBLUE|>:ORANGE|
		<div class=|LIGHTBLUE:"cookie-tool-content":LIGHTBLUE|>
			<h1>|BLACK:|DYNAMIC:'.__('Title large block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</h1>
			|BLACK:|DYNAMIC:'.__('Text large block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|
			<div class=|LIGHTBLUE:"options":LIGHTBLUE|>
				<h2>|BLACK:|DYNAMIC:'.__('Title large wanted', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</h2>
				<div class=|LIGHTBLUE:"div-to-table":LIGHTBLUE|>
					<?php /* LEVEL LOOP */ ?>
					<div class=|LIGHTBLUE:"div-to-cell option<?php /* LEVEL NR */ ?>":LIGHTBLUE| style=|LIGHTBLUE:"width|PINK:::PINK|<?php /* CALCULATED WIDTH */ ?>%|PINK:;:PINK|":LIGHTBLUE|>
						<div class=|LIGHTBLUE:"image":LIGHTBLUE|></div>
						<?php /* ONLY IF LOOPED IS THE FIRST */ ?>
						<div class=|LIGHTBLUE:"cookie-tool-recommended":LIGHTBLUE|>|BLACK:|DYNAMIC:'.__('Title large recommended', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</div>
						<?php /* END ONLY IF LOOPED IS THE FIRST */ ?>
						|ORANGE:<input type=|LIGHTBLUE:"radio":LIGHTBLUE| class=|LIGHTBLUE:"radio":LIGHTBLUE| name=|LIGHTBLUE:"cookie_tool_choice":LIGHTBLUE| value=|LIGHTBLUE:"<?php /* LEVEL NR */ ?>":LIGHTBLUE| checked=|LIGHTBLUE:"checked":LIGHTBLUE| />:ORANGE|
						|BLACK:|DYNAMIC:'.__('Level title large', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK| 
					</div>
					<?php /* END LEVEL LOOP */ ?>
				</div>
			</div>
			<div class=|LIGHTBLUE:"options-explained":LIGHTBLUE|>
				<?php /* LEVEL LOOP */ ?>
				<div class=|LIGHTBLUE:"options-explained-item":LIGHTBLUE| id=|LIGHTBLUE:"cookie-tool-view<?php /* LEVEL NR */ ?>":LIGHTBLUE|>
					<div class=|LIGHTBLUE:"div-to-table":LIGHTBLUE|>
						<div class=|LIGHTBLUE:"div-to-cell options-do":LIGHTBLUE|>
							<h3>|BLACK:|DYNAMIC:'.__('Title large do&#8217;s', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</h3>
							|BLACK:|DYNAMIC:'.__('Text large do&#8217;s', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|
						</div>
						<div class=|LIGHTBLUE:"div-to-cell options-dont":LIGHTBLUE|>
							<h3>|BLACK:|DYNAMIC:'.__('Title large dont&#8217;s', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|</h3>
							|BLACK:|DYNAMIC:'.__('Text large dont&#8217;s', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|:BLACK|
						</div>
					</div>
				</div>
				<?php /* END LEVEL LOOP */ ?>
			</div>
			|ORANGE:<input type=|LIGHTBLUE:"button":LIGHTBLUE| name=|LIGHTBLUE:"cookie-law-accept":LIGHTBLUE| value=|LIGHTBLUE:"|DYNAMIC:'.__('Button large block', MMM_CLA_PLUGIN_TRANSLATE).':DYNAMIC|":LIGHTBLUE| />:ORANGE|
		</div>
	|ORANGE:</form>:ORANGE|
</div>', true);
		}
		
}