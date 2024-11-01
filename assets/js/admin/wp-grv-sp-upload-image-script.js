jQuery( document ).ready(
	function(){
		jQuery( "#tabs" ).tabs();
		var mediaUploader_sp;
		var mediaUploader;
		/*
		* for sp intake tab upload add user image button fuction
		*
		*/
		jQuery( '#rv_add_upload_usr_img_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader) {
					mediaUploader.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader.on(
					'select',
					function() {
						var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_add_usr_img' ).val( attachment.url );
						// jQuery('#rv_usr_img_url').val(attachment.url);
						// jQuery('#rv_upload_img_show').html('<img src="'+attachment.url+'" style="width:70px;  border-radius: 50%;" >');
						jQuery( '#rv_upload_img_show' ).attr( 'src', attachment.url );
					}
				);
				// Open the uploader dialog
				mediaUploader.open();
			}
		);

		/*
		* for sp tab upload default user image button fuction
		*
		*/
		jQuery( '#wp_grv_sp_upload_usr_img_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_sp) {
					mediaUploader_sp.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_sp = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_sp.on(
					'select',
					function() {
						var attachment_cmp = mediaUploader_sp.state().get( 'selection' ).first().toJSON();
						jQuery( '#wp_grv_sp_usr_img' ).val( attachment_cmp.url );
						jQuery( '#wp_grv_sp_usr_img_url' ).val( attachment_cmp.url );
						jQuery( '#wp_grv_sp_usr_img_shows' ).attr( 'src', attachment_cmp.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_sp.open();
			}
		);
	}
);
