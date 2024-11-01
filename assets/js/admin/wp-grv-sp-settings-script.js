/*
 * function  to set style for settings page
 * return void
 */
jQuery( document ).ready(
	function(){

		// for social proofing
		// display headings
		jQuery( ".wp_grv_social_proofing_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
		jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "block" );
		// ends heading style
		jQuery( "#wp_grv_social_proofing_tab span" ).css( "float", "right" );
		jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "163px" );
		setTimeout(
			function() {
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "block" );
			},
			300
		);
	}
);
