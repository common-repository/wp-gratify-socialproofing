jQuery( document ).ready(
	function(){

		/*
		* ajax function for social proofing
		*
		*/
		wp_grv_rv_sp_social_proofing();
		function wp_grv_rv_sp_social_proofing(){
			var ajaxurl  = wp_grv_sp_social_proofing_ajax_script.wp_grv_sp_social_proofing_ajaxurl;
			var api_data = {
				'action':'wp_grv_sp_social_proofing_function', // function name
			};
			jQuery.post(
				ajaxurl,
				api_data,
				function(response) {
					var wp_grv_get_json_data                         = jQuery.parseJSON( response );
					var wp_grv_rv_delay_time                         = wp_grv_get_json_data.wp_grv_social_proofing_time_invl;
					var wp_grv_sp_social_proofing_bg_color           = wp_grv_get_json_data.wp_grv_sp_social_proofing_bg_color;
					var wp_grv_sp_social_proofing_text_size_name     = wp_grv_get_json_data.wp_grv_sp_social_proofing_text_size_name;
					var wp_grv_sp_social_proofing_text_size_contents = wp_grv_get_json_data.wp_grv_sp_social_proofing_text_size_contents;
					var wp_grv_sp_social_proofing_position_sel       = wp_grv_get_json_data.wp_grv_sp_social_proofing_position_sel;
					var wp_grv_sp_mobile_enable                      = wp_grv_get_json_data.wp_grv_sp_mobile_enable;
					if (wp_grv_sp_mobile_enable === 'true') {
						var current_screen_width = jQuery( window ).width();
						if (current_screen_width < 640) {
							var flag = '1';
						}
					}
					if (flag != 1) {
						var wp_grv_rv_delay_time_add = (+4000) + (+wp_grv_rv_delay_time);
						var wp_grv_rv                = wp_grv_get_json_data.wp_grv_rv_title;
						if ( ! wp_grv_rv) {
							var wp_grv_rv_count = 0;
						} else {
							var wp_grv_rv_count = wp_grv_rv.length;
						}
						var i;
						var wp_grv_rv_title;
						var wp_grv_rv_usr_img;
						var wp_grv_rv_date;
						var wp_grv_rv_content;
						var wp_grv_social_proofing_fun_repeat_delay = (+wp_grv_rv_delay_time_add) * (+wp_grv_rv_count);
						for (i = 0; i < wp_grv_rv_count; i++) {
							(function (i) {
								setTimeout(
									function () {
										wp_grv_rv_title   = wp_grv_get_json_data.wp_grv_rv_title[i];
										wp_grv_rv_usr_img = wp_grv_get_json_data.wp_grv_rv_usr_img[i];
										wp_grv_rv_date    = wp_grv_get_json_data.wp_grv_rv_date[i];
										wp_grv_rv_content = wp_grv_get_json_data.wp_grv_rv_content[i];
										jQuery.notify.addStyle(
											'wp_grv_social_proofing1',
											{

												html:"<div id='wp_grv_notification' style = 'background-color:" + wp_grv_sp_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "'></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_sp_social_proofing_text_size_name + ";'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style= 'font-size:" + wp_grv_sp_social_proofing_text_size_contents + ";' data-notify-text/></div></div>",

											}
										);
										jQuery.notify(
											wp_grv_rv_content,
											{
												style: 'wp_grv_social_proofing1',
												autoHideDelay: 4000,
												elementPosition: wp_grv_sp_social_proofing_position_sel,
												position: wp_grv_sp_social_proofing_position_sel,
												showAnimation: 'slideDown',
												showDuration: 800,
												hideAnimation: 'slideUp',
												hideDuration: 700,
											}
										);
									},
									wp_grv_rv_delay_time_add * i
								);
							})( i );
						}//loop ends
						setInterval(
							function(){
								for (i = 0; i < wp_grv_rv_count; i++) {
									(function (i) {
										setTimeout(
											function () {
												wp_grv_rv_title   = wp_grv_get_json_data.wp_grv_rv_title[i];
												wp_grv_rv_usr_img = wp_grv_get_json_data.wp_grv_rv_usr_img[i];
												wp_grv_rv_date    = wp_grv_get_json_data.wp_grv_rv_date[i];
												wp_grv_rv_content = wp_grv_get_json_data.wp_grv_rv_content[i];
												jQuery.notify.addStyle(
													'wp_grv_social_proofing1',
													{

														html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_sp_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "'></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_sp_social_proofing_text_size_name + ";'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style= 'font-size:" + wp_grv_sp_social_proofing_text_size_contents + ";' data-notify-text/></div></div>",

													}
												);
												jQuery.notify(
													wp_grv_rv_content,
													{
														style: 'wp_grv_social_proofing1',
														autoHideDelay: 4000,
														elementPosition: wp_grv_sp_social_proofing_position_sel,
														position: wp_grv_sp_social_proofing_position_sel,
														showAnimation: 'slideDown',
														showDuration: 800,
														hideAnimation: 'slideUp',
														hideDuration: 700,
													}
												);
											},
											wp_grv_rv_delay_time_add * i
										);
									})( i );
								}//loop ends
							},
							wp_grv_social_proofing_fun_repeat_delay
						);
					}//mobile disable/enable if condition ends
				}
			);

		}// function ends
	}
);
