	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	JAVASCRIPT FUNCTIONS
	//	@since									MultiMediaMonster
	/*
		On loading the website ... what should we do?
	*/
	// ---------------------------------------------------------------------------------------------------------------------
		
		// functions
		jQuery( document ).ready(function()
		{
			// Google maps with ip adresses
			var markers 									= 	[];
			var infowindows 								= 	[];
			
			function clearOverlays()
			{   
				for (var i = 0; i < markers.length; i++)
				{
					markers[i].setMap(null);
				}
			}
			function createMarkers_on_action()
			{
			}
			function createMarkers(ip, id) 
			{
				if (ip != 'load')
				{
					clearOverlays();
					jQuery.get("http://ipinfo.io/"+ip+"/json", function(response)
					{
						if (response.loc)
						{
							var new_src									=	'';
							if (response.country)
							{
								var new_src								=	jQuery('img.img'+id).attr('src').replace('unknown', response.country.toLowerCase());
							}
							var loc										= 	response.loc.split(',');
							var lat										= 	loc[0];
							var lng										= 	loc[1];
							
							var image 									= 	mmm_cla_js_variables_array.plugin_url+"/images/admin/googlemaps-icon.png";
							var infowindow 								= 	new google.maps.InfoWindow();
							var latlng 									= 	new google.maps.LatLng(lat, lng);
							var marker 									= 	new google.maps.Marker(
																			{
																				icon		: image, 
																				position	: latlng,
																				center		: latlng,
																				map			: map,
																				zIndex		: Math.round(latlng.lat()*-100000)<<5
																			});
							markers.push(marker);
							infowindows.push(infowindow);
							
							var create_content							=	'';
							if (new_src)
							{
								create_content							+=	'<img src="'+new_src+'" /> ';
							}
							create_content								+=	response.ip+'<br />';
							create_content								+=	response.city+'<br />';
							create_content								+=	response.region+'<br />';
							create_content								+=	response.hostname+'<br />';
							create_content								+=	response.org;
							
							infowindow.setContent(create_content);
							infowindow.open(map,marker);
						}
					}, "jsonp");
				}
				else
				{
					clearOverlays();
					jQuery('input[name="ip"]').each(function(index, element) 
					{
						var ip												= 	jQuery(this).val();
						var id												= 	jQuery(this).attr('id');
						jQuery.get("http://ipinfo.io/"+ip+"/json", function(response)
						{
							if (response.loc)
							{
								var new_src									=	'';
								if (response.country)
								{
									var new_src								=	jQuery('img.img'+id).attr('src').replace('unknown', response.country.toLowerCase());
									jQuery('img.img'+id).attr('src', new_src);
								}
								var loc										= 	response.loc.split(',');
								var lat										= 	loc[0];
								var lng										= 	loc[1];
								
								var image 									= 	mmm_cla_js_variables_array.plugin_url+"/images/admin/googlemaps-icon.png";
								var infowindow 								= 	new google.maps.InfoWindow();
								var latlng 									= 	new google.maps.LatLng(lat, lng);
								var marker 									= 	new google.maps.Marker(
																				{
																					icon		: image, 
																					position	: latlng,
																					center		: latlng,
																					map			: map,
																					zIndex		: Math.round(latlng.lat()*-100000)<<5
																				});
								markers.push(marker);
								infowindows.push(infowindow);
								
								var create_content							=	'';
								if (new_src)
								{
									create_content							+=	'<img src="'+new_src+'" /> ';
								}
								create_content								+=	response.ip+'<br />';
								create_content								+=	response.city+'<br />';
								create_content								+=	response.region+'<br />';
								create_content								+=	response.hostname+'<br />';
								create_content								+=	response.org;
								
								google.maps.event.addListener(marker, 'click', function()
								{
									infowindow.setContent(create_content);
									infowindow.open(map,marker);
								});
							}
						}, "jsonp");
					});
				}
			}
			function googlemaps_initialize()
			{
				var map_id										=	'map-canvas-main';
				if (jQuery('#'+map_id).attr('class'))
				{
					var geocoder;
					var position;
					
					var lat										= 	0;
					var lng										= 	0;
					var latlng 									= 	new google.maps.LatLng(lat, lng);				
					var mapOptions 								= 	{
																		zoom: 			2,
																		center: 		latlng,
																		mapTypeId: 		google.maps.MapTypeId.ROADMAP
																	};
					map 										= 	new google.maps.Map(document.getElementById(map_id), mapOptions);
					createMarkers('load', '');
				}
			}
			googlemaps_initialize();
			jQuery("body").delegate(".showmarker","click",function(e)
			{
				var marker_ip = jQuery(this).attr('id');
				var marker_id = jQuery(this).attr('class').split(' ');
				createMarkers(marker_ip, marker_id[1]);
			});

			// admin colorpicker
			function create_colorpicker()
			{
				jQuery('input.colorpicker').wpColorPicker();	
			}
			create_colorpicker();
			
			// reset
			jQuery('.wrap.multimediamonster-cookie-law-authorization input#reset').click(function() 
			{
				return confirm(mmm_cla_js_variables_array.confirm_reset);
			});
			// switch tabs
			jQuery("body").delegate(".multimediamonster-cookie-law-authorization .nav-tab","click",function(e)
			{
				var selected_tab_class 						= 	jQuery(this).attr('class');
				// the button class
				jQuery(".nav-tab").each(function(index, element) 
				{
					jQuery(this).removeClass('nav-tab-active');
				});
				jQuery(this).addClass('nav-tab-active');
				// the content class
				jQuery(".nav-tab-content").each(function(index, element) 
				{
					var this_tab_class 						= 	jQuery(this).attr('class');
					if (selected_tab_class.search('active') < 0)
					{
						// remove active class and add active class to the selected
						jQuery(this).removeClass('nav-tab-active-content');
					}
					if (selected_tab_class.replace('nav-tab', 'nav-tab-content') == this_tab_class)
					{
						jQuery(this).addClass('nav-tab-active-content');
					}
				});
			});
			// slide
			jQuery("body").delegate("a.slide","click",function(e)
			{
				var selected_slide_class 					= 	jQuery(this).attr('class');
				new_selected_slide_class					= 	selected_slide_class.replace('slide', 'container');
				new_selected_slide_class					= 	new_selected_slide_class.replace(/ /g, '.');
				
				var slide_display 							= 	jQuery("."+new_selected_slide_class).css("display");
				if (slide_display == 'none')
				{
					jQuery("."+new_selected_slide_class).stop(true,true).slideDown('slow');
					jQuery(this).text(mmm_cla_js_variables_array.slide_up);
				}
				else
				{
					jQuery("."+new_selected_slide_class).stop(true,false).slideUp('slow');
					jQuery(this).text(mmm_cla_js_variables_array.slide_down);
				}
			});
			// ajax delete actions
			jQuery("body").delegate("a.ajax.delete","click",function(e)
			{
				e.preventDefault();
				var id 										= 	jQuery(this).attr('id');
				var answer 									= 	confirm(mmm_cla_js_variables_array.confirm_delete_authorized);
				var the_parent_tr							= 	jQuery(this).parent().parent().parent().parent();
				
				var hidden_action							= 	jQuery('input[name="action"').val();
				var hidden_todo								= 	jQuery('input[name="todo"').val();
				var hidden_nonce							= 	jQuery('input[name="nonce_'+mmm_cla_js_variables_array.plugin_id_long+'"').val();
				var hidden_referer							= 	jQuery('input[name="_wp_http_referer"').val();
				if(answer)
				{
					var todo								= 	'&nonce_' + mmm_cla_js_variables_array.plugin_id_long + '=' + hidden_nonce + '&_wp_http_referer=' + hidden_referer + '&todo=' + hidden_todo + '&handled_by=ajax&action=' + hidden_action;
					if (hidden_todo == 'delete-authorized')
					{
						todo								+= 	'&delete_ip_with_id[]=' + id;
					}
					jQuery.ajax({
						   type								:	"POST",
						   url								:	window.ajaxurl,
						   data								:	todo,
						   success							:	function (data) 
																{
																	//jQuery('.hidden_ajax').html();
																	//jQuery('.hidden_ajax').append(data);
																	//jQuery('.hidden_ajax').append(todo);
																	var other_trs 				= 	the_parent_tr.parent().children('tr.records');
																	var other_trs_total 		= 	other_trs.length-1;
																	the_parent_tr.remove();
																	var other_trs_counter 		= 	1;
																	other_trs.each(function(index, element) 
																	{
																		if (index)
																		{
																			if(other_trs_counter & 1)
																			{
																				jQuery(this).addClass('alternate');
																			}
																			else
																			{
																				jQuery(this).removeClass('alternate');
																			}
																			other_trs_counter++;
																		}
																	});
																	// google maps
																	jQuery('.googlemaps.linked'+id).remove(); 
																	var other_google_trs 				= 	jQuery('.googlemaps');
																	var other_google_trs_counter 		= 	1;
																	other_google_trs.each(function(index, element) 
																	{
																		if(other_google_trs_counter & 1)
																		{
																			jQuery(this).addClass('alternate');
																		}
																		else
																		{
																			jQuery(this).removeClass('alternate');
																		}
																		other_google_trs_counter++;
																	});
																}
					});
				}
			});
			function find_in_object(obj, to_find, show)
			{
				var to_return 				= 	'';
				var type 					= 	typeof(obj);
				if (type == 'object')
				{
					for (var key in obj)
					{
						if (to_find == key)
						{
							to_return 		= 	obj[key];
						}
						else if (show == 'all')
						{
							to_return 		= 	obj[key];
							var subtype 	= 	typeof(to_return);
							if (subtype == 'object')
							{
								jQuery('.hidden_ajax').append('<b>'+key+' = OBJECT ---></b><br />');
								find_in_object(to_return, to_find, show);
							}
							jQuery('.hidden_ajax').append('<b>'+key+'</b>:'+to_return+'<br />');
						}
					}
				}
				return (to_return);
			}
			
			// duplicate
			jQuery("body").delegate("a.ajax.duplicate","click",function(e)
			{
				var max_elements							= 	10;
				var new_selected_duplicate_class			= 	jQuery(this).attr('title').replace(/ /g, '.');
				var nr_off_elements 						= 	jQuery("div.duplicate").length;
				
				if (nr_off_elements >= max_elements)
				{
					alert (mmm_cla_js_variables_array.max_level_elements);
				}
				else if (nr_off_elements < max_elements)
				{
					var nr_new_element 						= 	nr_off_elements+1;
					var duplicate_to						= 	new_selected_duplicate_class.replace('1', nr_off_elements);
					
					// create new element and change the class
					var new_class							= 	jQuery("div."+duplicate_to).attr('class').replace(nr_off_elements, nr_new_element);
					var new_element 						= 	jQuery("div."+new_selected_duplicate_class).clone().attr('class', new_class);
					// replace the html, classes, id's, names and fors
					new_element.find('.levels1, b, label, input, textarea').each(function ()
					{
						if (jQuery(this).html().search('1') >= 0)
						{
							jQuery(this).html(jQuery(this).html().replace(/1/g, nr_new_element));
						}
						if (jQuery(this).attr('class') && jQuery(this).attr('class').search('1') >= 0)
						{
							jQuery(this).attr('class', jQuery(this).attr('class').replace(/1/g, nr_new_element));
						}
						if (jQuery(this).attr('for') && jQuery(this).attr('for').search('1') >= 0)
						{
							jQuery(this).attr('for', jQuery(this).attr('for').replace(/1/g, nr_new_element));
						}
						if (jQuery(this).attr('name') && jQuery(this).attr('name').search('1') >= 0)
						{
							jQuery(this).attr('name', jQuery(this).attr('name').replace(/1/g, nr_new_element));
						}
						if (jQuery(this).attr('id') && jQuery(this).attr('id').search('1') >= 0)
						{
							jQuery(this).attr('id', jQuery(this).attr('id').replace(/1/g, nr_new_element));
						}
					});
					new_element.find('input[type="text"]').each(function ()
					{
						jQuery(this).attr('value', '');
					});
					new_element.find('textarea').each(function ()
					{
						var the_textarea 					=	jQuery(this);
						var the_textarea_name 				= 	the_textarea.attr('name');
						var the_textarea_id 				= 	the_textarea.attr('id');
						var the_textarea_tabs_container		= 	jQuery(this).parent().parent();
						var the_textarea_input_container	= 	the_textarea_tabs_container.parent();
						the_textarea_tabs_container.remove();
							
						// SET EDITOR TO NEW TEXTAREA			
						e.preventDefault();
						var hidden_action					=	jQuery('input[name="action"').val();
						var hidden_todo						= 	jQuery('input[name="todo"').val();
						var hidden_nonce					= 	jQuery('input[name="nonce_'+mmm_cla_js_variables_array.plugin_id_long+'"').val();
						var hidden_referer					=	jQuery('input[name="_wp_http_referer"').val();
						var todo							= 	'&nonce_' + mmm_cla_js_variables_array.plugin_id_long + '=' + hidden_nonce + '&_wp_http_referer=' + hidden_referer + '&textarea_id='+the_textarea_id + '&textarea_name=' + the_textarea_name + '&todo=tiny_mce&handled_by=ajax&action=' + hidden_action;
						jQuery.ajax({
							type							:	"POST",
							url								:	window.ajaxurl,
							data							:	todo,
							success							:	function (data) 
																{
																	the_textarea_input_container.append(data);
																	
																	// duplicate the tinymceinfo
																	var get_tinymce_info_from			=	'';
																	var textarea_counter 				= 	1;
																	jQuery('.'+new_selected_duplicate_class).find('textarea').each(function ()
																	{
																		if (textarea_counter == 1)
																		{
																			get_tinymce_info_from 		= 	jQuery(this).attr('id');
																		}
																		textarea_counter++;
																	});
																	//var the_prev_init_all 				= tinyMCEPreInit['mceInit'][get_tinymce_info_from];
																	//find_in_object(the_prev_init_all, '', 'all')
																	
																	// this is need for the tabs to work
																	var the_prev_quicktags 				= 	tinyMCEPreInit['qtInit'][get_tinymce_info_from];
																	settings =
																	{
																		id 								:	the_textarea_id,
																		buttons							: 	find_in_object(the_prev_quicktags, 'buttons')
																	}
																	quicktags(settings);
																	QTags._buttonsInit();
																	
																	var the_prev_init 					= 	tinyMCEPreInit['mceInit'][get_tinymce_info_from];
																	tinymce.init({
																		selector						: 	the_textarea_id,
																		theme							:	find_in_object(the_prev_init, 'theme'),
																		skin							:	find_in_object(the_prev_init, 'skin'),
																		language						:	find_in_object(the_prev_init, 'language'),
																		formats							:	find_in_object(the_prev_init, 'formats'),
																		relative_urls					:	find_in_object(the_prev_init, 'relative_urls'),
																		remove_script_host				:	find_in_object(the_prev_init, 'remove_script_host'),
																		convert_urls					:	find_in_object(the_prev_init, 'convert_urls'),
																		browser_spellcheck				:	find_in_object(the_prev_init, 'browser_spellcheck'),
																		fix_list_elements				:	find_in_object(the_prev_init, 'fix_list_elements'),
																		entities						:	find_in_object(the_prev_init, 'entities'),
																		entity_encoding					:	find_in_object(the_prev_init, 'entity_encoding'),																
																		keep_styles						:	find_in_object(the_prev_init, 'keep_styles'),
																		paste_webkit_styles				:	find_in_object(the_prev_init, 'paste_webkit_styles'),
																		preview_styles					:	find_in_object(the_prev_init, 'preview_styles'),
																		wpeditimage_disable_captions	:	find_in_object(the_prev_init, 'wpeditimage_disable_captions'),
																		wpeditimage_html5_captions		:	find_in_object(the_prev_init, 'wpeditimage_html5_captions'),
																		plugins							:	find_in_object(the_prev_init, 'plugins'),
																		content_css						:	find_in_object(the_prev_init, 'content_css'),
																		selector						:	"#" + the_textarea_id,
																		resize							:	find_in_object(the_prev_init, 'resize'),
																		menubar							:	find_in_object(the_prev_init, 'menubar'),
																		wpautop							:	find_in_object(the_prev_init, 'wpautop'),
																		indent							:	find_in_object(the_prev_init, 'indent'),																
																		toolbar1						:	find_in_object(the_prev_init, 'toolbar1'),
																		toolbar2						:	find_in_object(the_prev_init, 'toolbar2'),
																		toolbar3						:	find_in_object(the_prev_init, 'toolbar3'),
																		toolbar4						:	find_in_object(the_prev_init, 'toolbar4'),
																		tabfocus_elements				:	find_in_object(the_prev_init, 'tabfocus_elements'),
																		body_class						:	the_textarea_id,
																	});
										
																	// this is needed for the editor to initiate
																	//tinyMCE.execCommand('mceAddControl', true, the_textarea_id );
																	tinyMCE.execCommand('mceAddEditor', true, the_textarea_id);
																}
						});
						// END SET EDITOR TO NEW TEXTAREA
					});
					// remove previous remove links
					jQuery('a.remove').each(function ()
					{
						jQuery(this).remove();
					});
					// add remove link
					new_element.find('a.slide').each(function ()
					{
						jQuery(this).after('<a href="javascript:void(0);" class="remove levels'+nr_new_element+'">'+mmm_cla_js_variables_array.remove+'</a>');
					});
					new_element.insertAfter("div."+duplicate_to);
				}
			});
			// remove an added level
			jQuery("body").delegate("a.remove","click",function(e)
			{
				var to_remove 							= 	jQuery('.'+jQuery(this).attr('class').replace('remove ', 'levels.')+'.duplicate');
				to_remove.find('textarea').each(function ()
				{
					var textAreaID 						=	jQuery(this).attr('id');
					tinyMCE.execCommand('mceRemoveEditor', true, textAreaID);
				});
				
				to_remove.remove();
				// add remove link
				var min_elements						= 	3;
				var nr_off_elements 					= 	jQuery('a.slide').length;
				if (nr_off_elements > min_elements)
				{
					jQuery('a.slide.levels'+nr_off_elements).after('<a href="javascript:void(0);" class="remove levels'+nr_off_elements+'">'+mmm_cla_js_variables_array.remove+'</a>');
				}
			});
		});