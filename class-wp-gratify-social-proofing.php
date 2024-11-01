<?php
/*
Plugin Name: WP Gratify-Socialproofing
Plugin URI: https://wpgratify.com
Description: WP Gratify-Socialproofing is a plugin to highlight specific contents in a website.
Version: 1.0.0
Author: Midnay
Author URI: https://midnay.com
Textdomain: wp-gratify-sp-lang
License: GPLv2 or later
*/

/*
 * including sub php files
*/ 
include_once 'class-wp-gratify-social-proofing-meta-box.php';
register_activation_hook( __FILE__, 'mid_create_plugin_database_table' );
include_once 'pages/wp-gratify-all-list-page.php';
include_once 'pages/wp-gratify-settings-page.php';
include_once 'pages/wp-gratify-add-new-page.php';
include_once 'wp-grv-sp-tbl-operations/class-wp-grv-sp-settings-tbl-operation.php';
include_once 'wp-grv-sp-tbl-operations/class-wp-grv-sp-tbl-operation.php';
include_once 'wp-grv-sp-social-proofing/class-wp-grv-sp-social-proofing-ajax.php';
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
/*
 * function to enqueue frontend style and script
 * return void
*/ 

class Wp_Gratify_Social_Proofing
{
  //Add documentation link on the plugin page
  public static function wp_grv_sp_add_plugin_links($links, $file) {
    if ( $file == plugin_basename(dirname(__FILE__).'/class-wp-gratify-social-proofing.php') ) {
      $links[] = '<a href="https://wpgratify.com/wpgratify-sp-documentation/" target="_blank">' . esc_html__('Help', 'wp-gratify-sp-lang') . '</a>';
    }  
    return $links;
  }
  public static function social_proofing_plugin_enqueue_front_end() {
  	wp_enqueue_script( 'jquery' );
    wp_enqueue_style( 'wp-grv-sp-front-end-social-proofing-style', plugin_dir_url( __FILE__ ) . '/assets/css/wp-grv-sp-frond-end-social-proofing-style.css', false, '1.0.0');//Plugin frontend social proofing style. 
    wp_enqueue_style( 'wp-grv-sp-font-awesome',  '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0.0');
    global $post;
    $wp_grv_btn_check = get_post_meta( $post->ID, '_wp_grv_sp_social_proofing_meta_box_btn', true );
    if ( $wp_grv_btn_check != 'false' ){ 
    	wp_enqueue_script( 'wp-grv-sp-social_proofing_notify', plugin_dir_url( __FILE__ ) . '/assets/js/wp-grv-sp-notify.js', false, '1.0.0');
    	wp_enqueue_script( 'wp_grv_sp_social_proofing_ajax', plugin_dir_url( __FILE__ ) . '/assets/js/wp-grv-sp-social-proofing-ajax-script.js', false, '1.0.0');
    	wp_localize_script('wp_grv_sp_social_proofing_ajax','wp_grv_sp_social_proofing_ajax_script',array( 'wp_grv_sp_social_proofing_ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }
  }
  /*
   * function to enqueue backend style and script
   * return void
  */ 
  public static function social_proofing_plugin_enqueue_back_end() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-tabs');
    $screen = get_current_screen();
    wp_enqueue_style( 'wp-grv-sp-font-family', plugin_dir_url( __FILE__ ) . '/assets/font/css/wp_grv_sp_icon.css', false, '1.0.0');//gratify sp font for admin menu icon.
    wp_enqueue_style( 'wp-grv-sp-social-proofing-meta-box-style', plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-sp-social-proofing-meta-box-style.css', false, '1.0.0');//Backend style for social proofing meta box.
    wp_enqueue_style( 'wp-grv-sp-back-end-style', plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-sp-back-end-style.css', false, '1.0.0');//Backend General style.
    if ( ($screen->id === 'social-proof_page_wp-grv-sp-settings-menu')||($screen->id === 'social-proof_page_wp-grv-sp-add-new-menu')||($screen->id === 'toplevel_page_wp_grv_sp_slug') ){ 
        wp_enqueue_script( 'wp-grv-sp-back-end-script', plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-sp-script-back-end.js', false, '1.0.0');//Backend general script.
        wp_enqueue_script( 'wp-grv-sp-upload-image-script', plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-sp-upload-image-script.js', false, '1.0.0');//Script for upload image.
        wp_enqueue_script( 'wp-grv-ajax', plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-sp-backend-ajax-script.js', false, '1.0.0');//Backend General Ajax script.
        wp_localize_script('wp-grv-ajax','wp_grv_ajax_script',array( 'wp_grv_ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'wp-grv-sp-tbl-js', plugin_dir_url( __FILE__ ) . '/assets/external/js/wp_grv_sp_datatables.js', false, '1.0.0');//Table functional script.
        wp_enqueue_style( 'wp-grv-sp-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' , false, '1.0.0');//Script for font-owesome icons.
        wp_enqueue_style( 'wp-grv-sp-tbl-pagenation',plugin_dir_url( __FILE__ ) . '/assets/external/css/wp_grv_sp_datatables.min.css' , false, '1.0.0');//Style for backend tables.
        wp_enqueue_style( 'wp-grv-sp-settings-style', plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-sp-settings-style.css', false, '1.0.0');//Backend style for settings page.
        wp_enqueue_style( 'wp-grv-sp-all-review-style', plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-sp-all-list-style.css', false, '1.0.0');//Backend style for all list page.
        wp_enqueue_style( 'wp-grv-sp-add-review-style', plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-sp-add-new-style.css', false, '1.0.0');//Backend style for add new sp page.
        wp_enqueue_script( 'wp-grv-sp-loader-script',plugin_dir_url( __FILE__ ) . '/assets/external/js/wp_grv_sp_modernizr.js' , false, '1.0.0');//Backend loader effect.
        if ( $screen->id === 'social-proof_page_wp-grv-sp-settings-menu' ){ 
            wp_enqueue_style( 'wp-grv-sp-jquery-tab-style', plugin_dir_url( __FILE__ ) . '/assets/external/css/wp_grv_sp_jquery_ui.css', false, '1.0.0');
            wp_enqueue_script( 'wp-grv-sp-settings-script', plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-sp-settings-script.js', false, '1.0.0');
        }
    }    
  }
  /*
   * function to add admin menus
   * return void
  */
  public static function wp_grv_sp_add_admin_menu(){
    $wp_grv_user_role = wp_get_current_user();
    if ( in_array( 'administrator', (array) $wp_grv_user_role->roles ) ) {
        //The user has the "administrator" role
     	add_menu_page(__('All'), __('Social Proof'), 'manage_options', 'wp_grv_sp_slug', 'wp_grv_sp_all_content_function', 'dashicons-wpGratifySocialProofing', 6);
      add_submenu_page('wp_grv_sp_slug',"Contents","All","manage_options","wp_grv_sp_slug");
     	add_submenu_page('wp_grv_sp_slug',"add new page","Add New","manage_options","wp-grv-sp-add-new-menu","wp_grv_sp_add_new_page_function");
     	add_submenu_page('wp_grv_sp_slug',"settings page","Settings","manage_options","wp-grv-sp-settings-menu","wp_grv_sp_settings_function");
    }  
  } 
  /*
   * function for redirect setup page when install the plugin
   *
  */ 

  public static function wp_grv_sp_plugin_activate() {
  add_option('wp_grv_sp_plugin_do_activation_redirect', true);
  }

  public static function wp_grv_sp_plugin_redirect() {
      if (get_option('wp_grv_sp_plugin_do_activation_redirect', false)) {
          delete_option('wp_grv_sp_plugin_do_activation_redirect');
  		$wp_grv_activate_multi = filter_input(INPUT_GET,'activate-multi');
          if(!isset($wp_grv_activate_multi))
          {
              wp_redirect(admin_url('/admin.php?page=wp-grv-sp-settings-menu'));
          }
      }
  }

  /*
   * function for update notice for backend
   *
  */ 

  public static function wp_grv_sp_update_admin_notice_success() {
    $screen = get_current_screen();
    if ($screen->id === 'social-proof_page_wp-grv-sp-settings-menu'){ 
        ?>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp2" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp3" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp4" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp5" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp6" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp7" style="display: none">
            <p><?php _e( 'Settings successfully saved', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <!-- for add sp notification -->
        <div class="notice notice-success is-dismissible wp_grv_sp_update_successfull_msg_wp_add_rv_update" style="display: none">
            <p><?php _e( 'successfully update', 'wp-gratify-sp-lang' ); ?></p>
        </div>
        <?php
    }    
  }

  //allow redirection, even if wordpress starts to send output to the browser

  public static function wp_grv_sp_do_output_buffer() {
          ob_start();
  }
  public static function wp_grv_sp_init(){
    add_action( 'admin_enqueue_scripts', __CLASS__.'::social_proofing_plugin_enqueue_back_end' );//For admin scripts.
    add_filter('plugin_row_meta',  __CLASS__.'::wp_grv_sp_add_plugin_links', 10, 2);
    add_action( 'wp_enqueue_scripts', __CLASS__.'::social_proofing_plugin_enqueue_front_end' );//For front end scripts.
    add_action('admin_menu', __CLASS__.'::wp_grv_sp_add_admin_menu');
    register_activation_hook(__FILE__, __CLASS__.'::wp_grv_sp_plugin_activate');
    add_action('admin_init', __CLASS__.'::wp_grv_sp_plugin_redirect');
    add_action( 'admin_notices', __CLASS__.'::wp_grv_sp_update_admin_notice_success' );
    add_action('init', __CLASS__.'::wp_grv_sp_do_output_buffer');
  }
}
Wp_Gratify_Social_Proofing::wp_grv_sp_init();
