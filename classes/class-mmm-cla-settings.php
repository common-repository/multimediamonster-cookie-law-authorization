<?php
class mmm_cla_settings 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADD SETTINGS PAGE TO PLUGIN PAGE
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_plugin_settings_link($actions, $file) 
		{
			if(false !== strpos($file, MMM_CLA_PLUGIN_ID_LONG_MINUS))
			{
			 	$actions['settings']						= 	'<a href="admin.php?page='.MMM_CLA_PLUGIN_ID_LONG_MINUS.'-settings">'.__('Settings', MMM_CLA_PLUGIN_TRANSLATE).'</a>';
			}
			return $actions; 
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PAGE TABS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function tabs($to_administrate)
		{
			$tabs											=	array();
			if ($to_administrate == 'authorized')
			{
				$tabs['general']							=	__('General', MMM_CLA_PLUGIN_TRANSLATE);
			}
			if ($to_administrate == 'settings')
			{
				$tabs['general']							=	__('General', MMM_CLA_PLUGIN_TRANSLATE);
				$tabs['levels']								=	__('Cookie levels', MMM_CLA_PLUGIN_TRANSLATE);
				$tabs['texts']								=	__('Texts', MMM_CLA_PLUGIN_TRANSLATE);
				$tabs['layout_small']						=	__('Layout small', MMM_CLA_PLUGIN_TRANSLATE);
				$tabs['layout_large']						=	__('Layout large', MMM_CLA_PLUGIN_TRANSLATE);
				$tabs['help']								=	__('Help', MMM_CLA_PLUGIN_TRANSLATE);
			}
			return $tabs;
		}	
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	FORMFIELDS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		public static function formfields_tabs($options = '') 
		{
			$formfields 						= 	array();
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	SETTINGS GENERAL
			// ---------------------------------------------------------------------------------------------------------------------
				
				$formfields['settings_general']	=
				array
				(
					1 					=> 	array
											(
												'label' 			=> 	__('Help', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'help', 
												'text'	 			=> 	__('You just need to tell me: put it on or off? Nothing more. After that you can adjust settings, content and layout as you wish.', MMM_CLA_PLUGIN_TRANSLATE)
											),
					'status' 			=> 	array
											(
												'label' 			=> 	__('ON or OFF?<br /><span class="small">Are you kiddin? No I am not ...</span>', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'radio', 
												'required' 			=> 	true, 
												'values'			=> 	array
																		(
																			1 	=>	__('ON', MMM_CLA_PLUGIN_TRANSLATE), 
																			2 	=> 	__('OFF', MMM_CLA_PLUGIN_TRANSLATE)
																		)
											),
					'keep' 				=> 	array
											(
												'label' 			=> 	__('How long do you want records to be kepped?<br /><span class="small">To make sure your database does not get filled with too many records tell after how many days the record should be deleted. Zero (0) or empty does nothing. So it keeps them all.</span>', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text'
											)
				);
					
			// ---------------------------------------------------------------------------------------------------------------------
			// 	SETTINGS LEVELS
			// ---------------------------------------------------------------------------------------------------------------------
			
				$formfields['settings_levels'] =
				array
				(
					1 					=> 	array
											(
												'label' 			=> 	__('Help', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'help', 
												'text'	 			=> 	__('<div class="hidden_ajax"></div>Basicly there are 3 levels, but you can add more or remove the existing levels. Click <a href="javascript:void(0);" class="ajax duplicate" title="levels1 duplicate">here</a> to add more.', MMM_CLA_PLUGIN_TRANSLATE)
											),
					'levels' 			=> 	array
											(
												'label' 			=> 	__('Levels', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'levels',  
												'required' 			=> 	true, 
												'values'			=> 	array
																		(
																			1 	=> 	array
																					(
																						'title' 	=> 	array
																										(
																											'label' 	=> 	__('Level title', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'text',
																											'required' 	=> 	true
																										), 
																						'dos' 		=> 	array
																										(
																											'label' 	=> 	__('Level do&#8217;s', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'textarea'
																										), 
																						'donts' 	=> 	array
																										(
																											'label' 	=> 	__('Level dont&#8217;s', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'textarea'
																										)
																					),
																			2 	=> 	array
																					(
																						'title' 	=> 	array
																										(
																											'label' 	=> 	__('Level title', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'text',
																											'required' 	=> 	true
																										), 
																						'dos' 		=> 	array
																										(
																											'label' 	=> 	__('Level do&#8217;s', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'textarea'
																										), 
																						'donts' 	=> 	array
																										(
																											'label' 	=> 	__('Level dont&#8217;s', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'textarea'
																										)
																					),
																			3 	=> 	array
																					(
																						'title' 	=> 	array
																										(
																											'label' 	=> 	__('Level title', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'text',
																											'required' 	=> 	true
																										), 
																						'dos' 		=> 	array
																										(
																											'label' 	=> 	__('Level do&#8217;s', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'textarea'
																										), 
																						'donts' 	=> 	array
																										(
																											'label' 	=> 	__('Level dont&#8217;s', MMM_CLA_PLUGIN_TRANSLATE), 
																											'type' 		=> 	'textarea'
																										)
																					)
																		)
											)
				);
					
			// ---------------------------------------------------------------------------------------------------------------------
			// 	SETTINGS TEXTS
			// ---------------------------------------------------------------------------------------------------------------------
			
				$formfields['settings_texts'] = 
				array
				(
					1 					=> 	array
											(
												'label' 			=> 	__('Help', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'help', 
												'text'	 			=> 	__('If you are not sure which texts belong to which elements (please first check the small text in front of the inputs) look on the &#8217;help&#8217; tab.', MMM_CLA_PLUGIN_TRANSLATE)
											),
					'small_title' 		=> 	array
											(
												'label' 			=> 	__('Title small block', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true
											),
					'small_text' 		=> 	array
											(
												'label' 			=> 	__('Text small block', MMM_CLA_PLUGIN_TRANSLATE),
												'type'				=> 	'textarea',
												'required' 			=> 	true
											),
					'small_button' 		=> 	array
											(
												'label' 			=> 	__('Button small block', MMM_CLA_PLUGIN_TRANSLATE),
												'type'				=> 	'text',
												'required' 			=> 	true
											),
					'small_link' 		=> 	array
											(
												'label' 			=> 	__('Link small block<br /><span class="small">if left blank there will be no more information</span>', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true
											),
					
					'large_title' 		=> 	array
											(
												'label' 			=> 	__('Title large block', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true
											),
					'large_text' 		=> 	array
											(
												'label' 			=>	__('Text large block', MMM_CLA_PLUGIN_TRANSLATE),
												'type'				=> 	'textarea',
												'required' 			=> 	true 
											),
					'large_wanted' 		=> 	array
											(
												'label' 			=> 	__('Title large wanted', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true
											),
					'large_recommended' => 	array
											(
												'label' 			=> 	__('Title large recommended', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true
											),
					'large_do' 			=> 	array
											(
												'label' 			=> 	__('Title large do&#8217;s', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true
											),
					'large_dont' 		=> 	array
											(
												'label' 			=> 	__('Title large dont&#8217;s', MMM_CLA_PLUGIN_TRANSLATE),
												'type' 				=> 	'text',
												'required' 			=> 	true 
											),
					'large_button' 		=> 	array
											(
												'label' 			=> 	__('Button large block', MMM_CLA_PLUGIN_TRANSLATE),
												'type'				=> 	'text',
												'required' 			=> 	true 
											)
				);
					
			// ---------------------------------------------------------------------------------------------------------------------
			// 	SETTINGS LAYOUT
			// ---------------------------------------------------------------------------------------------------------------------
			
				$formfields['settings_layout_small'] =
				array
				(
					1 							=> 	array
												(
													'label' 			=> 	__('Help', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'help', 
													'text'	 			=> 	__('Below you can adjust some basic layout settings for the small block on the website. But ofcourse there is more you can do about making the apearance fit more with you own website. You can do this by styling the elements in your theme&#8217;s CSS file. On the &#8217;help&#8217; tab on this page I have put an example on what elements are used. Good luck! You can do it!', MMM_CLA_PLUGIN_TRANSLATE)
												),
					'floating' 					=> 	array
												(
													'label' 			=> 	__('Floating', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'radio',
													'required' 			=> 	true,
													'values'	 		=> 	array
																			(
																				1 	=>	__('yes', MMM_CLA_PLUGIN_TRANSLATE), 
																				2 	=> 	__('no', MMM_CLA_PLUGIN_TRANSLATE)
																			)
												),
					'draggable' 				=> 	array
												(
													'label' 			=> 	__('Draggable', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'radio', 
													'required' 			=> 	true,
													'values'	 		=> 	array
																			(
																				1 	=>	__('yes', MMM_CLA_PLUGIN_TRANSLATE), 
																				2 	=> 	__('no', MMM_CLA_PLUGIN_TRANSLATE)
																			)
												),
					'pos_horizontal' 			=> 	array
												(
													'label' 			=> 	__('Position horizontal', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'radio', 
													'required' 			=> 	true,
													'values'	 		=> 	array
																			(
																				1 	=>	__('left', MMM_CLA_PLUGIN_TRANSLATE), 
																				2 	=> 	__('right', MMM_CLA_PLUGIN_TRANSLATE)
																			)
												),
					'pos_vertical' 				=> 	array
												(
													'label' 			=> 	__('Position vertical', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'radio', 
													'required' 			=> 	true,
													'values'	 		=> 	array
																			(
																				1 	=>	__('top', MMM_CLA_PLUGIN_TRANSLATE), 
																				2 	=> 	__('bottom', MMM_CLA_PLUGIN_TRANSLATE)
																			)
												),
					'width' 					=> 	array
												(
													'label' 			=> 	__('Width<br /><span class="small">in pixels, if left empty it will be 100%<br />(fe "350", "350px", "50%")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'borderradius' 				=> 	array
												(
													'label' 			=> 	__('Border radius<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "10", "10px", "10px 10px 10px 10px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'dropshadow' 				=> 	array
												(
													'label' 			=> 	__('Drop shadow<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "10", "10px", "10px 10px 10px 10px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'outer_backgroundcolor' 	=> 	array
												(
													'label' 			=> 	__('Backgroundcolor (outer)<br /><span class="small">in hex #, if left empty it will be #f4f4f4<br />(fe #000)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'color'
												),
					'outer_backgroundopacity'	 => 	array
												(
													'label' 			=> 	__('Backgroundopacity (outer)<br /><span class="small">in %, if left empty it will be 100%<br />(fe 50)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'outer_margin' 				=> 	array
												(
													'label' 			=> 	__('Margin (outer)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "25", "25px", "25px 25px 25px 25px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'outer_padding' 			=> 	array
												(
													'label' 			=> 	__('Padding (outer)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "25", "25px", "25px 25px 25px 25px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'inner_backgroundcolor' 	=> 	array
												(
													'label' 			=> 	__('Backgroundcolor (inner)<br /><span class="small">in hex #, if left empty it will be #fff<br />(fe #000)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'color'
												),
					'inner_backgroundopacity' 	=> 	array
												(
													'label' 			=> 	__('Backgroundopacity (inner)<br /><span class="small">in %, if left empty it will be 100%<br />(fe 50)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'inner_margin' 				=> 	array
												(
													'label' 			=> 	__('Margin (inner)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "10", "10px", "10px 10px 10px 10px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'inner_padding' 			=> 	array
												(
													'label' 			=> 	__('Padding (inner)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "25", "25px", "25px 25px 25px 25px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												)
				);
				$formfields['settings_layout_large'] =
				array
				(
					1 							=> 	array
												(
													'label' 			=> 	__('Help', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'help', 
													'text'	 			=> 	__('Below you can adjust some basic layout settings for the large block on the website. But ofcourse there is more you can do about making the apearance fit more with you own website. You can do this by styling the elements in your theme&#8217;s CSS file. On the &#8217;help&#8217; tab on this page I have put an example on what elements are used. Good luck! You can do it!', MMM_CLA_PLUGIN_TRANSLATE)
												),
					'width' 					=> 	array
												(
													'label' 			=> 	__('Width<br /><span class="small">in pixels, if left empty it will be 100%<br />(fe 250, 250px, 50%)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'overlay_backgroundcolor' 	=> 	array
												(
													'label' 			=> 	__('Backgroundcolor (overlay)<br /><span class="small">in hex #, if left empty it will be #000<br />(fe #000)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'color'
												),
					'overlay_backgroundopacity'	 => 	array
												(
													'label' 			=> 	__('Backgroundopacity (overlay)<br /><span class="small">in %, if left empty it will be 80%<br />(fe 50)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'borderradius' 				=> 	array
												(
													'label' 			=> 	__('Border radius<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "10", "10px", "10px 10px 10px 10px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'dropshadow' 				=> 	array
												(
													'label' 			=> 	__('Drop shadow<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "10", "10px", "10px 10px 10px 10px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'outer_backgroundcolor' 	=> 	array
												(
													'label' 			=> 	__('Backgroundcolor (outer)<br /><span class="small">in hex #, if left empty it will be #f4f4f4<br />(fe #000)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'color'
												),
					'outer_backgroundopacity'	 => 	array
												(
													'label' 			=> 	__('Backgroundopacity (outer)<br /><span class="small">in %, if left empty it will be 100%<br />(fe 50)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'outer_margin' 				=> 	array
												(
													'label' 			=> 	__('Margin (outer)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "25", "25px", "25px 25px 25px 25px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'outer_padding' 			=> 	array
												(
													'label' 			=> 	__('Padding (outer)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "25", "25px", "25px 25px 25px 25px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'inner_backgroundcolor' 	=> 	array
												(
													'label' 			=> 	__('Backgroundcolor (inner)<br /><span class="small">in hex #, if left empty it will be #fff<br />(fe #000)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'color'
												),
					'inner_backgroundopacity' 	=> 	array
												(
													'label' 			=> 	__('Backgroundopacity (inner)<br /><span class="small">in %, if left empty it will be 100%<br />(fe 50)</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'inner_margin' 				=> 	array
												(
													'label' 			=> 	__('Margin (inner)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "10", "10px", "10px 10px 10px 10px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												),
					'inner_padding' 			=> 	array
												(
													'label' 			=> 	__('Padding (inner)<br /><span class="small">in pixels, if left empty it will be 0<br />(fe "25", "25px", "25px 25px 25px 25px")</span>', MMM_CLA_PLUGIN_TRANSLATE),
													'type' 				=> 	'text'
												)
				);
			
			if ($options && isset($formfields[$options['to_administrate'].'_'.$options['tab']]))
			{
				$formfields				= $formfields[$options['to_administrate'].'_'.$options['tab']];
			}
			return $formfields;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	DEFAULT VALUES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		public static function default_values($to_return = '') 
		{
			$defaults 						= 	array();
			$defaults['general'] 			= 	array
												(
													'status'	 				=> 	2,
													'keep'		 				=> 	365
												);
			
			$defaults['levels']				= 	array
												(
													'title1'					=> 	__('Reccomended', MMM_CLA_PLUGIN_TRANSLATE),
													'dos1'						=> 	__('Placing necessary cookies (remembering basic settings)<br />Keep track of statistics<br />Allow pages to share through social media<br />Use visitor information for relevant advertising', MMM_CLA_PLUGIN_TRANSLATE),
													'donts1' 					=> 	'',
													'title2' 					=> 	__('Functional', MMM_CLA_PLUGIN_TRANSLATE),
													'dos2' 						=> 	__('Placing necessary cookies (remembering basic settings)<br />Keep track of statistics<br />Allow pages to share through social media', MMM_CLA_PLUGIN_TRANSLATE),
													'donts2' 					=>	__('Use visitor information for relevant advertising', MMM_CLA_PLUGIN_TRANSLATE),
													'title3' 					=> 	__('Necessary', MMM_CLA_PLUGIN_TRANSLATE),
													'dos3' 						=> 	__('Placing necessary cookies (remembering basic settings)', MMM_CLA_PLUGIN_TRANSLATE),
													'donts3'					=> 	__('Keep track of statistics<br />Allow pages to share through social media<br />Use visitor information for relevant advertising', MMM_CLA_PLUGIN_TRANSLATE)
												);
			
			$defaults['texts'] 				= 	array
												(
													'small_title' 				=> 	__('Cookie settings', MMM_CLA_PLUGIN_TRANSLATE),
													'small_text'				=> 	__('We use cookies to ensure you get the best experience on our website.', MMM_CLA_PLUGIN_TRANSLATE),
													'small_button' 				=> 	__('Accept cookies', MMM_CLA_PLUGIN_TRANSLATE),
													'small_link'				=> 	__('Information', MMM_CLA_PLUGIN_TRANSLATE),
													'large_title' 				=>	__('Cookie settings', MMM_CLA_PLUGIN_TRANSLATE),
													'large_text'				=> 	__('Most websites you visit will use cookies in order to improve your user experience by enabling that website to ‘remember’ you.
																						<br /><br />Cookies do lots of different jobs, like letting you navigate between pages efficiently, storing your preferences, and generally improving your experience of a website. Cookies make the interaction between you and the website faster and easier. If a website doesn’t use cookies, it will think you are a new visitor every time you move to a new page on the site – for example, when you enter your login details and move to another page it won’t recognise you and it won’t be able to keep you logged in.
																						<br /><br />Some websites will also use cookies to enable them to target their advertising or marketing messages based for example, on your location and/or browsing habits.
																						<br /><br />Cookies may be set by the website you are visiting (‘first party cookies’) or they may be set by other websites who run content on the page you are viewing (‘third party cookies’).
																						<br /><br />What is in a cookie?
																						<br /><br />A cookie is a simple text file that is stored on your computer or mobile device by a website’s server and only that server will be able to retrieve or read the contents of that cookie. Each cookie is unique to your web browser. It will contain some anonymous information such as a unique identifier and the site name and some digits and numbers. It allows a website to remember things like your preferences or what’s in your shopping basket.
																						<br /><br />What to do if you don’t want cookies to be set
																						<br /><br />Some people find the idea of a website storing information on their computer or mobile device a bit intrusive, particularly when this information is stored and used by a third party without them knowing. Although this is generally quite harmless you may not, for example, want to see advertising that has been targeted to your interests. If you prefer, it is possible to block some or all cookies, or even to delete cookies that have already been set; but you need to be aware that you might lose some functions of that website.', MMM_CLA_PLUGIN_TRANSLATE),
													'large_wanted'				=> 	__('Wanted', MMM_CLA_PLUGIN_TRANSLATE),
													'large_recommended' 		=> 	__('Recommended', MMM_CLA_PLUGIN_TRANSLATE),
													'large_do' 					=> 	__('This website will:', MMM_CLA_PLUGIN_TRANSLATE),
													'large_dont' 				=> 	__('This website won&#8217;t:', MMM_CLA_PLUGIN_TRANSLATE),
													'large_button'				=> 	__('Save', MMM_CLA_PLUGIN_TRANSLATE)
												);
			$defaults['layout_small'] 		= 	array
												(
													'floating' 								=> 	1,
													'draggable'								=> 	1,
													'pos_horizontal' 						=> 	2,
													'pos_vertical' 							=>	2,
													'width' 								=> 	350,
													'borderradius' 							=> 	10,
													'dropshadow' 							=> 	10,
													'outer_backgroundcolor' 				=> 	'#f4f4f4',
													'outer_backgroundopacity' 				=> 	100,
													'outer_margin' 							=> 	25,
													'outer_padding' 						=> 	10,
													'inner_backgroundcolor' 				=> 	'#fff',
													'inner_backgroundopacity' 				=> 	100,
													'inner_margin' 							=> 	0,
													'inner_padding' 						=> 	25
												);
			$defaults['layout_large'] 		= 	array
												(
													'width' 								=> 	650,
													'borderradius' 							=> 	10,
													'dropshadow' 							=> 	10,
													'overlay_backgroundcolor' 				=> 	'#000',
													'overlay_backgroundopacity' 			=> 	70,
													'outer_backgroundcolor' 				=> 	'#f4f4f4',
													'outer_backgroundopacity' 				=> 	100,
													'outer_margin' 							=> 	'25px auto 25px auto',
													'outer_padding' 						=> 	10,
													'inner_backgroundcolor' 				=> 	'#fff',
													'inner_backgroundopacity' 				=> 	100,
													'inner_margin' 							=> 	0,
													'inner_padding' 						=> 	25
												);
			if ($to_return)
			{
				$defaults					= $defaults[$to_return];
			}
			return $defaults;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	RETURN SETTINGS ARRAY AS A FORM
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function return_form($options = '', $formfields = '') 
		{
			foreach ($formfields as $formfields_key => $formfields_val)
			{
				if (isset($formfields_val) && count($formfields) > 0)
				{
					self::return_inputtype($options, $formfields_key, $formfields_val);
				}
			}
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	INPUT TYPES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function return_required($required = '') 
		{
			if ($required)
			{
				return ' <em>*</em>';
			}
		}
		static function return_inputtype($options = '', $instance_key = '', $instance_val = '') 
		{
			$label 								= 	$instance_val['label'];
			$type 								= 	$instance_val['type'];
			$values 							=	$instance_val['values'];
			$text 								=	$instance_val['text'];
			$required 							=	$instance_val['required'];
			
			$field_name_id						= 	$instance_key;
			
			// the values
			$defaults 							= 	self::default_values();
			$values_db							= 	get_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings', $defaults );
			$values_field 						= 	wp_parse_args((array) $values_db, $defaults);
			//echo '<pre>';
			//print_r ($values_field);
			//echo '</pre>';
			$value_field						= 	'';
			if (isset($values_field[$options['tab']][$field_name_id]) && $values_field[$options['tab']][$field_name_id])
			{
				$value_field					= 	 $values_field[$options['tab']][$field_name_id];
			}
			
			$fieldset_label_for 				= 	'';
			if (!$field_name_id || $type == 'help')
			{
				$fieldset_label_for				= 	'no-inputs '.$type;
			}
			else
			{
				$fieldset_label_for				= 	$type;
			}
			$fieldset_class 					= 	' class="multiple"';
			if (count($instance) == 1)
			{
				$fieldset_class 				= 	' class="single"';
			}
			if ($field_name_id != "0" && $options['tab'] != $field_name_id)
			{
				$field_id						=	MMM_CLA_PLUGIN_ID_SHORT.'_'.$options['to_administrate'].'_'.$options['tab'].'_'.$field_name_id;
				$field_name						=	MMM_CLA_PLUGIN_ID_SHORT.'_'.$options['to_administrate'].'['.$options['tab'].']['.$field_name_id.']';
			}
			?>
            <fieldset<?php echo $fieldset_class; ?>>
            	<?php
				if ($label)
				{
					if ($type == 'help')
					{
						$label = '<h3>'.$label.'</h3>';
					}
					?>
             		<label for="<?php echo $fieldset_label_for; ?>"><?php echo $label; ?><?php echo self::return_required($required); ?></label>
                	<?php
				}
				?>
                <div class="input <?php echo $type; ?>">
					<?php
					if ($type == 'radio')
                    {
						foreach ($values as $values_key => $values_val)
                        {
							$checked = '';
							if ($value_field == $values_key)
							{
								$checked = ' checked="checked"';
							}
                            ?>
                            <input type="radio"<?php echo $checked; ?> name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $values_key; ?>" /> <?php echo $values_val; ?><br />
                            <?php
                        }
                    }
					if ($type == 'select')
                    {
                        ?>
                        <select name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>">
							<?php
                            foreach ($values as $values_key => $values_val)
                            {
								$selected = '';
								if ($value_field == $values_key)
								{
									$selected = ' checked="checked"';
								}
                                ?>
                                <option<?php echo $selected; ?> value="<?php echo $values_key; ?>" /><?php echo $values_val; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    }
                    if ($type == 'text')
                    {
						?>
                        <input class="widefat" type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $value_field; ?>" />
                        <?php
                    }
					if ($type == 'color')
					{
						?>
						<input class="colorpicker" type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $value_field; ?>" />
                        <?php
					}
                    if ($type == 'textarea')
                    {
						//echo $field_name;
						//echo $field_id;
						$quicktags_settings 		= array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close' );
						$settings 					= array('media_buttons' => false, 'teeny' => true, 'quicktags' => $quicktags_settings, 'textarea_name' => $field_name);
                        wp_editor( $value_field, $field_id, $settings );
                    }
                    if ($type == 'hidden')
                    {
                        ?>
                        <?php echo $value_field; ?>
                        <input class="widefat" type="hidden" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $value_field; ?>" />
                        <?php
                    }
                    if ($type == 'help')
                    {
						echo $text;
                    }
                    if ($type == 'levels')
                    {
						// push if there are DB vals
						foreach ($values_db['levels'] as $values_key => $values_val)
						{
							if (preg_match('/title/', $values_key))
							{
								$the_level_num 		= str_replace('title', '', $values_key);
								$the_level_key 		= str_replace($the_level_num, '', $values_key);
								if ($the_level_num > 3)
								{
									$values[$the_level_num] = array();
									foreach ($values[1] as $values_key => $values_val)
									{
										$values[$the_level_num][$values_key] = array();
										foreach ($values_val as $values_val_key => $values_val_val)
										{
											$values[$the_level_num][$values_key][$values_val_key] = $values_val_val;
										}
									}
								}
							}
						}
						foreach ($values as $values_key => $values_val)
						{
							?>
							<div class="input <?php echo $type; ?> <?php echo $type.$values_key; ?> duplicate">
								<b>
									<?php echo $type.' '.$values_key; ?>
                                    <a href="javascript:void(0);" class="slide <?php echo $type.$values_key; ?>"><?php _e('slide down', MMM_CLA_PLUGIN_TRANSLATE); ?></a> 
                                    <?php
									if ($values_key > 3)
									{
										?>
                                    	<a href="javascript:void(0);" class="remove <?php echo $type.$values_key; ?>"><?php _e('remove', MMM_CLA_PLUGIN_TRANSLATE); ?></a>
                                		<?
									}
									?>
                                </b>
								<div class="container <?php echo $type.$values_key; ?>" style="display:none;">
									<?php
                                    foreach ($values_val as $values_val_key => $values_val_val)
                                    {
                                        self::return_inputtype($options, $values_val_key.$values_key, $values_val_val);
                                    }
                                    ?>
                                </div>
							</div>
							<?php
						}
                    }
                    ?>
                </div>
            </fieldset>
            <?php
		}
	
}