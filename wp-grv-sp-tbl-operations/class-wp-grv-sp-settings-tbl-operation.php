<?php
 /*
  * function for insert social proofing data to database
  * return void
 */
class Wp_Grv_Sp_Settings_Tbl_Operation {

	public static function wp_grv_sp_social_proofing_insert_settings() {
		$wp_grv_sp_usr_img                            = filter_input(INPUT_POST,'wp_grv_sp_usr_img');
		$wp_grv_sc_pr_tm_invl                         = filter_input(INPUT_POST,'wp_grv_sc_pr_tm_invl');
		$wp_grv_sp_social_proofing_bg_color           = filter_input(INPUT_POST,'wp_grv_sp_social_proofing_bg_color');
		$wp_grv_sp_social_proofing_text_size_name     = filter_input(INPUT_POST, 'wp_grv_sp_social_proofing_text_size_name');
		$wp_grv_sp_social_proofing_text_size_contents = filter_input(INPUT_POST, 'wp_grv_sp_social_proofing_text_size_contents');
		$wp_grv_sp_social_proofing_position_sel       = filter_input(INPUT_POST,'wp_grv_sp_social_proofing_position_sel');
		$wp_grv_sp_mobile_enable                      = filter_input(INPUT_POST,'wp_grv_sp_mobile_enable');
		$social_proofing_settings_dat                 = array(
			'social_proofing_time_invl'          => $wp_grv_sc_pr_tm_invl,
			'user_image'                         => $wp_grv_sp_usr_img,
			'social_proofing_bg_color'           => $wp_grv_sp_social_proofing_bg_color,
			'social_proofing_text_size_name'     => $wp_grv_sp_social_proofing_text_size_name,
			'social_proofing_text_size_contents' => $wp_grv_sp_social_proofing_text_size_contents,
			'social_proofing_position_sel'       => $wp_grv_sp_social_proofing_position_sel,
			'social_proofing_mobile_enable'      => $wp_grv_sp_mobile_enable,

		);
		update_option( 'wp_grv_sp_social_proofing_settings', $social_proofing_settings_dat );
		exit();
	}
	public static function wp_grv_sp_ins_settings_init() {
		add_action( 'wp_ajax_wp_grv_sp_social_proofing_insert_settings', __CLASS__ . '::wp_grv_sp_social_proofing_insert_settings' );
		add_action( 'wp_ajax_nopriv_wp_grv_sp_social_proofing_insert_settings', __CLASS__ . '::wp_grv_sp_social_proofing_insert_settings' );
	}
}
Wp_Grv_Sp_Settings_Tbl_Operation::wp_grv_sp_ins_settings_init();