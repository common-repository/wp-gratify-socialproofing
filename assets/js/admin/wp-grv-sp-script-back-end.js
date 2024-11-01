/*
 * wp_grv backend general script
 *
*/
jQuery( document ).ready(
	function(){
		/* function to give preview for social proofing background color */
		jQuery( "#wp_grv_social_proofing_form_block #fa-eye" ).click(
			function(){
				jQuery( "#wp_grv_sp_bg_block" ).slideToggle( "slow" );
				var wp_grv_sp_default_img_url = jQuery("#wp_grv_sp_usr_img").val();
                jQuery('#wp_grv_img').attr('src', wp_grv_sp_default_img_url);
			}
		);
		jQuery( "#wp_grv_sp_social_proofing_bg_color" ).click(
			function(){
				var wp_grv_sp_default_img_url = jQuery("#wp_grv_sp_usr_img").val();
                jQuery('#wp_grv_img').attr('src', wp_grv_sp_default_img_url);
			}
		);		
		jQuery( "#wp_grv_sp_social_proofing_bg_color" ).change(
			function (){
				var wp_grv_bg_color_fetch = jQuery( "#wp_grv_sp_social_proofing_bg_color" ).val();
				jQuery( "#wp_grv_sp_bg_block" ).attr( 'style', 'background-color:' + wp_grv_bg_color_fetch + ' !important' );
				jQuery( "#wp_grv_sp_bg_block" ).show();
			}
		);
		/* function to give preview of social proofing font size */

		jQuery( "#wp_grv_sp_social_proofing_text_size_name" ).on(
			"keydown",
			function() {
				setTimeout(
					function($elem){
						var wp_grv_font_size_name = $elem.val() + 'px';
						jQuery( "#wp_grv_txt_block" ).attr( 'style','font-size:' + wp_grv_font_size_name + ' !important' );
					},
					0,
					jQuery( this )
				);
			}
		);

		jQuery( "#wp_grv_sp_social_proofing_text_size_contents" ).on(
			"keydown",
			function() {
				setTimeout(
					function($elem){
						var wp_grv_font_size_contents = $elem.val() + 'px';
						jQuery( "#wp_grv_review_block" ).attr( 'style','font-size:' + wp_grv_font_size_contents + ' !important' );
					},
					0,
					jQuery( this )
				);
			}
		);

		/*
		* page loader style
		*
		*/
		jQuery( window ).load(
			function() {
				// Animate loader off screen
				jQuery( ".se-pre-con" ).fadeOut( "slow" );;
			}
		);
		/*
		* all sp table style
		*
		*/
		jQuery( ".wp_grv_rv_tbl_row" ).live(
			"mouseover",
			function() {
				jQuery( this ).find( ".wp_grv_rv_edit_delete" ).css( "display", "block" );
			}
		);
		jQuery( ".wp_grv_rv_tbl_row" ).live(
			"mouseout",
			function() {
				jQuery( this ).find( ".wp_grv_rv_edit_delete" ).css( "display", "none" );
			}
		);
		/*
		* table pagenation
		*
		*/
		jQuery( '#wp_grv_sp_all_rv_tbl' ).DataTable(
			{
				"pagingType": "full_numbers"
			}
		);

		jQuery( '.rv_select_check_box' ).click(
			function () {
				jQuery( '.rv_all_sel' ).prop( 'checked', this.checked );
			}
		);
		/*
		* function use to reset  for image upload field using reset button
		*
		*/
		jQuery( "#wp_grv_sp_usr_img_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#wp_grv_sp_usr_img' ).val( "" );
				jQuery( '#wp_grv_sp_usr_img_shows' ).removeAttr( 'src' );
			}
		);
		// Social Proofing intake page.
		jQuery( "#rv_add_upload_usr_img_reset_button" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_add_usr_img' ).val( "" );
				jQuery( '#rv_upload_img_show' ).removeAttr( 'src' );
				//jQuery( '#rv_upload_img_show' ).css( 'display', 'none' );
			}
		);
	}
);
