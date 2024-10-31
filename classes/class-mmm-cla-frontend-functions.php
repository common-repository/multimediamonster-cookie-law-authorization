<?php
class mmm_cla_frontend_functions 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	GET IP
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function get_ip()
		{
			$ip 				= '';
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
			{
				$ip				= $_SERVER['HTTP_CLIENT_IP'];
			} 
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			{
				$ip 			= $_SERVER['HTTP_X_FORWARDED_FOR'];
			} 
			else 
			{
				$ip 			= $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	SET AJAX URL
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_ajax_url()
		{
			$html				= '<script type="text/javascript">';
			$html 				.= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";';
			$html 				.= '</script>';
			echo $html;
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PERCENT TO 0.VAL
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function percent2dot($percent) 
		{
			$output 											= 	floatval($percent);
			$output												= 	$percent/100;
			return $output;
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	CREATE RGB(A)
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function hex2rgba($color, $opacity = false) 
		{
			$default 											= 	'rgb(0,0,0)';
			if(empty($color))									{ 	return $default; } 
			if ($color[0] == '#' ) 
			{
				$color 											=	substr( $color, 1 );
			}
			if (strlen($color) == 6)
			{
				$hex 											= 	array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			}
			elseif ( strlen( $color ) == 3 )
			{
				$hex 											= 	array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			}
			else
			{
				return $default;
			}
			$rgb 												= 	array_map('hexdec', $hex);
			if(abs($opacity) > 1)								{ 	$opacity = 1.0; }
			$output 											= 	'rgba('.implode(",",$rgb).','.$opacity.')';
			return $output;
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PARSE VALID PIXELS
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function parse_pixels($val = 0, $basic = 0) 
		{
			//floatval(
			$skip_vals											= 	array('auto');
			if (!$val)											{	$val 		= 	$basic; 	}
			else
			{
				if (is_numeric($val))
				{
					$val 		= 	$val.'px';
				}
			}
			return $val;
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PARSE VALID COLOR (INC TRANSPARENCY
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------

		static function parse_color($val = '', $transparancy = 100, $basic = 'transparent') 
		{
			$transparancy										= 	self::percent2dot($transparancy);
			if (!$val)											{	$val 		= 	$basic; 	}
			else 												{ 	$val 		= 	self::hex2rgba($val, $transparancy); }
			return $val;
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	POSITIONING
	// 	@since									MultiMediaMonster 1.1
	/*
		horizontal:
		1 = left 
		2 = right
		vertical
		1 = top 
		2 = bottom
	*/
	// ---------------------------------------------------------------------------------------------------------------------

	static function parse_position($floating = 1, $horizontal = 2, $vertical = 2) 
	{
		$val													= 	'';
		if ($floating == 1)										{ 	$val		.= 	"position:fixed;";								}
		elseif ($floating == 2)									{	$val 		.= 	"";												}
		
		if ($horizontal == 1)									{	$val 		.= 	"left:0;";										}
		elseif ($horizontal == 2)								{	$val 		.= 	"right:0; float:right;";							}
		
		if ($vertical == 1)										{	$val 		.= 	"top:0;";										}
		elseif ($vertical == 2)									{	$val 		.= 	"bottom:0;";										}
		
		return $val;
	}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PARSE BROWSER
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function parse_browser($val = 0, $to_parse = '') 
		{
			if ($to_parse)
			{
				$val 											= 	$to_parse.":					".$val.";
																	-moz-".$to_parse.": 			".$val.";
																	-webkit-".$to_parse.": 			".$val.";
																	-khtml-".$to_parse.":	 		".$val.";
																	";
			}
			return $val;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PARSE COMPLETE LAYOUT (FINAL)
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function parse_layout($array_layout = array())
		{
			$layout 											= 	"";
			$basics												= 	array();
			// the values
			if (count($array_layout) > 1)
			{
				foreach ($array_layout as $array_layout_key => $array_layout_val)
				{
					$get_basics									= 	mmm_cla_settings::default_values($array_layout_key);
					foreach ($get_basics as $get_basics_key => $get_basics_val)
					{
						$newval_reset							=	$get_basics_val;
						$newval_key								= 	$array_layout_key.'_'.$get_basics_key;
						
						if ($array_layout[$array_layout_key][$get_basics_key] != '' && $array_layout[$array_layout_key][$get_basics_key] != '0' && $array_layout[$array_layout_key][$get_basics_key] != $get_basics_val)
						{
							$newval_reset						=	$array_layout[$array_layout_key][$get_basics_key];
						}
						//echo $newval_key.':'.$newval_reset.'<br />';
						eval("\$$newval_key 					= \"$newval_reset\";");
					}
				}
			}
			// the small block
			$layout 											.= 	"
																		.cookie-tool-container.small
																		{
																			".self::parse_position($layout_small_floating, $layout_small_pos_horizontal, $layout_small_pos_vertical)."
																			width: 							".self::parse_pixels($layout_small_width, '100%').";
																			background-color: 				".self::parse_color($layout_small_outer_backgroundcolor, $layout_small_outer_backgroundopacity).";
																			margin: 						".self::parse_pixels($layout_small_outer_margin).";
																			padding: 						".self::parse_pixels($layout_small_outer_padding).";
																			".self::parse_browser(self::parse_pixels($layout_small_borderradius), 'border-radius')."
																			".self::parse_browser('0 0 '.self::parse_pixels($layout_small_dropshadow).' 0 rgba(0,0,0,0.5)', 'box-shadow')."
																		}
																		.cookie-tool-container.small .cookie-tool-content
																		{
																			background-color: 				".self::parse_color($layout_small_inner_backgroundcolor, $layout_small_inner_backgroundopacity).";
																			margin: 						".self::parse_pixels($layout_small_inner_margin).";
																			padding: 						".self::parse_pixels($layout_small_inner_padding).";
																			".self::parse_browser(self::parse_pixels($layout_small_borderradius), 'border-radius')."
																		}
																	";
			$layout 											.= 	"
																		.cookie-tool-container-large-overlay
																		{
																			background-color: 				".self::parse_color($layout_large_overlay_backgroundcolor, $layout_large_overlay_backgroundopacity).";
																		}
																		.cookie-tool-container.large
																		{
																			width: 							".self::parse_pixels($layout_large_width, '100%').";
																			background-color: 				".self::parse_color($layout_large_outer_backgroundcolor, $layout_large_outer_backgroundopacity).";
																			margin: 						".self::parse_pixels($layout_large_outer_margin).";
																			padding: 						".self::parse_pixels($layout_large_outer_padding).";
																			".self::parse_browser(self::parse_pixels($layout_large_borderradius), 'border-radius')."
																			".self::parse_browser('0 0 '.self::parse_pixels($layout_large_dropshadow).' 0 rgba(0,0,0,0.5)', 'box-shadow')."
																		}
																		.cookie-tool-container.large .cookie-tool-content
																		{
																			background-color: 				".self::parse_color($layout_large_inner_backgroundcolor, 100).";
																			margin: 						".self::parse_pixels($layout_large_inner_margin).";
																			padding: 						".self::parse_pixels($layout_large_inner_padding).";
																			".self::parse_browser(self::parse_pixels($layout_large_borderradius), 'border-radius')."
																		}
																	";
			return $layout;
		}
}