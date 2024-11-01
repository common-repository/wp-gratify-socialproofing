<?php
/*
 * function for social proofing ajax function
 * return wp_grv_get_json_data
*/
class Wp_Grv_Sp_Social_Proofing_Ajax {
	public static function wp_grv_sp_social_proofing_function() {
		$social_proofing_fetch_sett = get_option( 'wp_grv_sp_social_proofing_settings' );
		global $post;
					// Fetch sp from comment table and comment meta table.
					global $wpdb;
					$comment_tbl      = $wpdb->prefix . 'comments';
					$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_sp' AND comment_approved='true' AND comment_content != '' ORDER BY comment_ID DESC", ARRAY_A );
		foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
			$rv_id_fetch   = $value_comment_tbl_data['comment_ID'];
			$rv_date_fetch = $value_comment_tbl_data['comment_date'];
			$rv_approved   = $value_comment_tbl_data['comment_approved'];
			// sp content length checking for social proofing
			if ( strlen( $value_comment_tbl_data['comment_content'] ) >= 100 ) {
				$rv_content = substr( $value_comment_tbl_data['comment_content'], 0, 100 ) . '..';
			} else {
				$rv_content = $value_comment_tbl_data['comment_content'];
			}
			$key                     = 'comment_extras';
			$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
			foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
				$rv_title          = $comment_meta_data_fetch_value['review_title'];
				$review_user_image = $comment_meta_data_fetch_value['review_user_image'];
			}

					$wp_grv_Obj->wp_grv_rv_title[]   = $rv_title;
					$wp_grv_Obj->wp_grv_rv_usr_img[] = $review_user_image;
					$wp_grv_Obj->wp_grv_rv_date[]    = $rv_date_fetch;
					$wp_grv_Obj->wp_grv_rv_content[] = $rv_content;
		}
		$wp_grv_Obj->wp_grv_sp_social_proofing_text_size_name       = $social_proofing_fetch_sett['social_proofing_text_size_name'] . 'px';
		$wp_grv_Obj->wp_grv_sp_social_proofing_text_size_contents 	= $social_proofing_fetch_sett['social_proofing_text_size_contents'] . 'px';
		$wp_grv_Obj->wp_grv_sp_social_proofing_bg_color             = $social_proofing_fetch_sett['social_proofing_bg_color'];
		$wp_grv_Obj->wp_grv_sp_social_proofing_position_sel    		= $social_proofing_fetch_sett['social_proofing_position_sel'];
		$wp_grv_Obj->wp_grv_sp_mobile_enable                        = $social_proofing_fetch_sett['social_proofing_mobile_enable'];
		$wp_grv_Obj->wp_grv_social_proofing_time_invl               = $social_proofing_fetch_sett['social_proofing_time_invl'];
		$wp_grv_Obj->wp_grv_social_proofing_page_id                 = $id;
		$wp_grv_get_json_data = json_encode( $wp_grv_Obj );
		echo( $wp_grv_get_json_data );
		exit();
	}
	public static function wp_grv_sp_ajax_init() {
		add_action( 'wp_ajax_wp_grv_sp_social_proofing_function', __CLASS__ . '::wp_grv_sp_social_proofing_function' );
		add_action( 'wp_ajax_nopriv_wp_grv_sp_social_proofing_function', __CLASS__ . '::wp_grv_sp_social_proofing_function' );
	}
}
Wp_Grv_Sp_Social_Proofing_Ajax::wp_grv_sp_ajax_init();