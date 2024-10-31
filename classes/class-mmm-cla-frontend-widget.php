<?php
class mmm_cla_frontend_widget
{
	static function check_old_ips()
	{
        global $wpdb;
		$defaults 							= 	mmm_cla_settings::default_values();
		$values_db							= 	get_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $defaults );
		$values_field 						= 	wp_parse_args((array) $values_db, $defaults);

		if (isset($values_field['general']['keep']) && $values_field['general']['keep'])
		{
			
			$delete_query_to_run 					= 	"DELETE 
														FROM {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT." 
														WHERE 
														date_time < (NOW() - INTERVAL ".$values_field['general']['keep']." DAY)
														";
			$wpdb->query( $delete_query_to_run );
		}
	}
	static function show_widget()
	{
        global $wpdb;
		$ip 									= 	mmm_cla_frontend_functions::get_ip();
		$query_to_run 							= 	"SELECT *
													FROM {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT."
													WHERE 
													ipaddress = '$ip'";
		$widget_results 						= 	$wpdb->get_results( $query_to_run );
					
		if (!isset($widget_results) || (isset($widget_results) && is_array($widget_results) && count($widget_results) <= 0))
		{
			$defaults 							= 	mmm_cla_settings::default_values();
			$values_db							= 	get_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $defaults );
			$values_field 						= 	wp_parse_args((array) $values_db, $defaults);

			if ($values_field['general']['status'] == 1)
			{
				
				?>
				<div id="cookie-tool-container-large">
                    <div class="cookie-tool-container-large-overlay"></div>
                    <div class="cookie-tool-container-large-overlay-centralizing">
                    	<div class="cookie-tool-content-large-overlay-centralizing">
                            <div class="cookie-tool-container large">
                			<div class="cookie-tool-container-close"></div>
                                <form action="" method="post" name="form-cookie-law" enctype="multipart/form-data">
                                    <div class="cookie-tool-content">
                                        <h1><?php echo $values_field['texts']['large_title']; ?></h1>
                                        <?php echo apply_filters('the_content', $values_field['texts']['large_text']); ?>
                                        <div class="options"> 
                                            <h2><?php echo $values_field['texts']['large_wanted']; ?> <?php echo $values_field['texts']['large_title']; ?></h2>
                                            <div class="div-to-table"> 
                                                <?php
                                                $new_levels 						= array();
                                                foreach ($values_field['levels'] as $values_key => $values_val)
                                                {
                                                    $new_levels_array 				= preg_split("/(\d+)/", $values_key, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                                                    $the_level_key					= $new_levels_array[0];
                                                    $the_level_num					= $new_levels_array[1];
                                                    
                                                    $new_levels[$the_level_num][$the_level_key] = $values_val;
                                                }
                                                $option_width						= floor(100/count($new_levels));
                                                foreach ($new_levels as $new_levels_key => $new_levels_val)
                                                {
                                                    ?>
                                                    <div class="div-to-cell option<?=$new_levels_key?>" style="width:20px<?php echo $option_width; ?>%;">
                                                        <div class="image"></div>
                                                        <?
                                                        if ($new_levels_key == 1)
                                                        {
                                                            ?>
                                                            <div class="cookie-tool-recommended"><?php echo $values_field['texts']['large_recommended']; ?></div>
                                                            <?
                                                        }
                                                        ?>
                                                        <input type="radio" class="radio" name="cookie_tool_choice" value="<?=$new_levels_key?>"<? if ($new_levels_key == 1) { ?> checked="checked"<? }?> /><?=$new_levels_val['title']?>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div> 
                                        </div>
                                        <div class="options-explained">
                                            <?
                                            foreach ($new_levels as $new_levels_key => $new_levels_val)
                                            {
                                                ?>
                                                <div class="options-explained-item<? if ($new_levels_key != 1) { ?> hide<? } ?>" id="cookie-tool-view<?=$new_levels_key?>">
                                                    <div class="div-to-table"> 
                                                        <div class="div-to-cell options-do">
                                                            <h3><?php echo $values_field['texts']['large_do']; ?></h3>
                                                            <?php echo apply_filters('the_content', $new_levels_val['dos']); ?>
                                                        </div>
                                                        <div class="div-to-cell options-dont"> 
                                                            <h3><?php echo $values_field['texts']['large_dont']; ?></h3>
                                                            <?php echo apply_filters('the_content', $new_levels_val['donts']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <input type="hidden" name="cookie_law_accept" value="true" />
                                        <input type="button" name="cookie-law-accept" value="<?php echo $values_field['texts']['large_button']; ?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="hidden_ajax"></div>
				<div class="cookie-tool-container small<?php if ($values_field['layout_small']['draggable'] == 1) { ?> draggable<?php } ?>"> 
					<form action="" method="post" name="form-cookie-law" enctype="multipart/form-data">
						<div class="cookie-tool-content"> 
							<h1><?php echo $values_field['texts']['small_title']; ?></h1>
							<?php echo apply_filters('the_content', $values_field['texts']['small_text']); ?><br />
							<input type="hidden" name="cookie_tool_choice" value="1" />
							<input type="hidden" name="cookie_law_accept" value="true" />
							<input type="button" name="cookie-law-accept" value="<?php echo $values_field['texts']['small_button']; ?>" />
							<?php if ($values_field['texts']['small_link']) { ?><a class="mmm-fancybox" href="javascript:void(0);" title="#cookie-tool-container-large"><?php echo $values_field['texts']['small_link']; ?></a><?php } ?>
						</div>
					</form>
				</div>
				<?php
			}
		}
	}
}