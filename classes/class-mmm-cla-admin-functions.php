<?php
class mmm_cla_admin_functions 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	FUNCTIONS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------

		static public function colorize_code($code)
		{
			$new_code					= 	$code;
			$colorize_code_array		= 	array
											(
												'BLACK'				=> 	'black',
												'ORANGE' 			=> 	'orange',
												'LIGHTBLUE' 		=> 	'lightblue',
												'GREEN' 			=> 	'green',
												'PINK' 				=> 	'pink',
												'DYNAMIC' 			=> 	'dynamic'
												
											);
			foreach ($colorize_code_array as $key => $replace)
			{
				$new_code 				= 	str_replace('|'.$key.':', '<span class="'.$replace.'">', $new_code);
				$new_code 				= 	str_replace(':'.$key.'|', '</span>', $new_code);
			}
			return $new_code;
		}
		static public function printCode($code, $lines_number = 0)
		{ 
			ini_set('highlight.comment', 'comment');
			ini_set('highlight.default', 'default');			
			ini_set('highlight.keyword', 'keyword');
			ini_set('highlight.string', 'string');
			ini_set('highlight.html', 'html');

			if (!is_array($code)) 
				$codeE = explode("\n", $code); 
			$count_lines 				= 	count($codeE); 
		
			$new_code					= 	'';
			$r1 						= 	"";
			if ($lines_number)
			{            
				$r1 					.= 	"<div class=\"linenum\"><div class=\"inner\">";
				foreach($codeE as $line => $c)
				{
					$new_code 			.= 	$c."\n";
					$r1 				.= 	($line+1)."<br />";
				} 
				$r1 					.=	"</div></div>"; 
			} 
			else
			{
				$new_code				= 	$code;
			}
			
			$new_code 					= 	highlight_string($new_code,1);
			$new_code 					= 	str_replace('<span style="color: ', '<span class="', $new_code);
			$new_code					= 	self::colorize_code($new_code);		
			
			$r2 						= 	"<div class=\"linetext\">";
			$r2 						.= 	$new_code;
			$r2 						.= 	"</div>"; 
	
			$r 							.= 	$r1.$r2; 
	
			echo "<div class=\"code-container\"><div class=\"code\">".$r."</div></div>\n"; 
		}
		
		static function translated_texts ($return = '')
		{			
			$to_return								= '';
			
			$texts['ipaddress'] 					= __('ipaddress', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['date_time'] 					= __('date_time', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['level'] 						= __('level', MMM_CLA_PLUGIN_TRANSLATE);
			
			$texts['plugin_id_short'] 				= MMM_CLA_PLUGIN_ID_SHORT;
			$texts['plugin_id_short_minus'] 		= MMM_CLA_PLUGIN_ID_SHORT_MINUS;
			$texts['plugin_id_long'] 				= MMM_CLA_PLUGIN_ID_LONG;
			$texts['plugin_id_long_minus'] 			= MMM_CLA_PLUGIN_ID_LONG_MINUS;
			$texts['plugin_url'] 					= MMM_CLA_PLUGIN_URL;
			$texts['confirm_delete_authorized'] 	= __('Really delete this IP address? (Irreversible)', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['confirm_reset'] 				= __('Are you sure you want to reset? The widget will be disabled and all configuration and layout settings will be permanently deleted. (Irreversible)', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['max_level_elements'] 			= __('You have reached the maximum number of levels to add.', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['slide_up'] 						= __('slide up', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['slide_down']					= __('slide down', MMM_CLA_PLUGIN_TRANSLATE);
			$texts['remove'] 						= __('remove', MMM_CLA_PLUGIN_TRANSLATE);
			if (!$return)
			{
				$to_return 							= $texts;
			}
			elseif (isset($texts[$return]) && $texts[$return])
			{
				$to_return 							= $texts[$return];
			}
			return ($to_return);
		}
		static function printf_array($format, $arr) 
		{ 
			return call_user_func_array('printf', array_merge((array)$format, $arr)); 
		} 
		static function return_replaced_array($format, $arr) 
		{ 
			return call_user_func_array('sprintf', array_merge((array)$format, $arr)); 
		}
		static function months($input)
		{
			$array_months 		
									= array(
									"01" 		=> __ ("January", MMM_CLA_PLUGIN_TRANSLATE),
									"02" 		=> __ ("Februari", MMM_CLA_PLUGIN_TRANSLATE),
									"03" 		=> __ ("March", MMM_CLA_PLUGIN_TRANSLATE),
									"04" 		=> __ ("April", MMM_CLA_PLUGIN_TRANSLATE),
									"05" 		=> __ ("May", MMM_CLA_PLUGIN_TRANSLATE),
									"06" 		=> __ ("June", MMM_CLA_PLUGIN_TRANSLATE),
									"07" 		=> __ ("July", MMM_CLA_PLUGIN_TRANSLATE),
									"08" 		=> __ ("August", MMM_CLA_PLUGIN_TRANSLATE),
									"09" 		=> __ ("September", MMM_CLA_PLUGIN_TRANSLATE),
									"10" 		=> __ ("October", MMM_CLA_PLUGIN_TRANSLATE),
									"11" 		=> __ ("November", MMM_CLA_PLUGIN_TRANSLATE),
									"12" 		=> __ ("December", MMM_CLA_PLUGIN_TRANSLATE)
									);
			return ($array_months[$input]);
		}
		static function return_date($input)
		{			
			$splitted			 	= str_replace ("-", "", $input); 
			$year			 		= substr ("$splitted", 0, 4);
			$month			 		= substr ("$splitted", 4, 2);
			$day			 		= substr ("$splitted", 6, 2);
			
			if ($year != '0000')
			{
				return $day." ".self::months($month)." ".$year;		
			}
			else
			{
				return '...';
			}
		}
		static function return_time($input)
		{
			// datums splitsen 
			$splitted			 	= str_replace ("-", "", $input);
			$time					= substr ("$splitted", 8, 9);
			return $time;		
		}
}