<?php
// add metabox for pages and posts.
class Wp_Gratify_Social_Proofing_Meta_Box {

	public static function wp_grv_sp_social_proofing_meta_box() {
		add_meta_box( 'wp_grv_sp_socialproofing_meta', __( 'WpGratify Social Proofing' ), __CLASS__ . '::wp_grv_sp_social_proofing_meta_box_callback', 'page', 'side', 'high' );
	}

	public static function wp_grv_sp_social_proofing_meta_box_callback() {
		global $post;
		wp_nonce_field( basename( __FILE__ ), 'wp_grv_sp_meta_event_fields' );
		$wp_grv_sp_btn_check     = get_post_meta( $post->ID, '_wp_grv_sp_social_proofing_meta_box_btn', true );
		$wp_grv_sp_btn_check_val = esc_textarea( $wp_grv_sp_btn_check );
		?>
			<label class="rv_switch"><input type="checkbox" name="_wp_grv_sp_social_proofing_meta_box_btn" value="true" 
			<?php
			if ( $wp_grv_sp_btn_check_val === 'true' ) {
				echo 'checked';
			} if ( $wp_grv_sp_btn_check_val === '' ) {
				echo 'checked';}
			?>
			 <label name="aproval_sel" class="rv_approval_sel" /><span class="rv_slider rv_round"></span></label>
		<?php
	}
	/*
	* Save the metabox data
	*/
	public static function wp_grv_sp_save_social_proofing_meta_box( $post_id, $post ) {
		// Return if the user doesn't have edit permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		$meta_box_button = filter_input( INPUT_POST,'_wp_grv_sp_social_proofing_meta_box_btn' );
		if ( isset($meta_box_button ) ) {
			  $meta_box_button = 'true';
		} else {
			  $meta_box_button = 'false';
		}
		// Verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times.
		$meta_event_fields = filter_input( INPUT_POST,'wp_grv_sp_meta_event_fields' );
		if ( isset($meta_event_fields ) ){
			if ( ! isset( $meta_box_button ) || ! wp_verify_nonce( $meta_event_fields, basename(__FILE__) ) ) {
		return $post_id;
	}

			// Now that we're authenticated, time to save the data.
			// This sanitizes the data from the field and saves it into an array $events_meta.
			$events_meta['_wp_grv_sp_social_proofing_meta_box_btn'] = esc_textarea( $meta_box_button );
			// Cycle through the $events_meta array.
			// Note, in this example we just have one item, but this is helpful if you have multiple.

			foreach ( $events_meta as $key => $value ) :
				// Don't store custom data twice
				if ( 'revision' === $post->post_type ) {
					return;
				}
				if ( get_post_meta( $post_id, $key, false ) ) {
					// If the custom field already has a value, update it.
					update_post_meta( $post_id, $key, $value );
				} else {
					// If the custom field doesn't have a value, add it.
					add_post_meta( $post_id, $key, $value );
				}
				if ( ! $value ) {
					// Delete the meta key if there's no value
					delete_post_meta( $post_id, $key );
				}
		endforeach;
		}
	}
	   // init
	public static function wp_grv_sp_mb_init() {
		add_action( 'add_meta_boxes', __CLASS__ . '::wp_grv_sp_social_proofing_meta_box' );
		add_action( 'save_post', __CLASS__ . '::wp_grv_sp_save_social_proofing_meta_box', 1, 2 );
	}
}
Wp_Gratify_Social_Proofing_Meta_Box::wp_grv_sp_mb_init();