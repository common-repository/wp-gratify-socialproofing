<?php
/*
 * function for adding new review or update review
 * return void
*/ 
function wp_grv_sp_add_new_page_function(){
  $rv_id            = filter_input(INPUT_GET,'edit_id');
  if(isset($rv_id )){ // Checking update button.
      global $wpdb;
      
      $comment_tbl      = $wpdb->prefix . 'comments';
      $comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_ID = $rv_id ",ARRAY_A);
      foreach ($comment_tbl_data as $value_comment_tbl_data){
        $rv_content               = $value_comment_tbl_data['comment_content'];
        $rv_date_fetch            = $value_comment_tbl_data['comment_date'];
        $rv_approved              = $value_comment_tbl_data['comment_approved'];
        $key                      = "comment_extras";
        $comment_meta_data_fetch  = get_comment_meta( $rv_id, $key );
        foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
          $rv_title                   = $comment_meta_data_fetch_value['review_title'];
          $rv_user_image_fetch        = $comment_meta_data_fetch_value['review_user_image'];
        }
      }
  }
	$wp_grv_add_rv_sub   = filter_input(INPUT_POST,'add_rv_sub');
	if(isset($wp_grv_add_rv_sub)){ // Checking submit button
      	$add_rv_content     = filter_input(INPUT_POST,'add_content');
      	$dt                 = new DateTime();
      	$add_rv_date	      = $dt->format('Y-m-d H:i:s');
		$wp_grv_approval_sel  = filter_input(INPUT_POST,'aproval_sel'); 
  		  $add_approve_stat   = isset($wp_grv_approval_sel) ? $wp_grv_approval_sel : 'disable';
  		  $rv_type		        = "wp_grv_sp";
  		  $comment_table_data = array(
    			'comment_content'        => $add_rv_content,
    			'comment_date'		       => $add_rv_date,
    			'comment_approved'	     => $add_approve_stat,
    			'comment_type'		       => $rv_type
  			);
    		$id = wp_insert_comment($comment_table_data);
    		$comment_id = $id;
        //checking upload image exisist or not
        if(filter_input(INPUT_POST,'add_user_image') === ""){
          $social_proofing_fetch_sett = get_option('wp_grv_sp_social_proofing_settings');
          $wp_grv_user_image = $social_proofing_fetch_sett['user_image'];   
        }
        else{
          $wp_grv_user_image = filter_input(INPUT_POST,'add_user_image');
        }
    		$comment_meta_table_data = array(
    			'review_title'                   => filter_input(INPUT_POST,'add_title'),
    			'review_user_image'              => $wp_grv_user_image
    		);
        update_comment_meta( $comment_id, "comment_extras", $comment_meta_table_data );
        $url = admin_url('/admin.php?page=wp-grv-sp-add-new-menu&edit_id='.$comment_id );
        echo $url;
        wp_safe_redirect( $url );
        exit();
	}
?>
  <!-- div shows loader icon -->
  <div class="se-pre-con"></div>
  <!-- Ends -->
  <div id="rv_add_new_page_container">
    <!-- Add new review page notification bar (admin bar) -->
    <div id="wp_grv_ajax_notification_load" class="wp_grv_header_notification_bar">
        <a class="wp_grv_settings_icon_hover" style="color: #ffff;" href="<?php echo admin_url( '/admin.php?page=wp-grv-sp-settings-menu' ); ?>"><i class="fa fa-cog" style="margin-left: 15px;"></i></a></span>&nbsp;&nbsp;&nbsp; 
    </div>
    <!-- Ends notification bar -->
  	<div class="wp_grv_header_width"><h2><?php _e( 'Add New', 'wp-gratify-lang' )?></h2></div>
    <input type="button" class="wp_grv_btn" <?php if(isset($rv_id)){ echo 'style = "display: block;"'; } else{ echo 'style = "display: none;"'; } ?> onclick="window.location.href='<?php echo admin_url('/admin.php?page=wp-grv-sp-add-new-menu'); ?>'" name="add_new_btn" id="rv_add_new_btn" value="<?php _e( 'Add New', 'wp-gratify-lang' )?>" /><br/>
    <br/>
  	<form id="rv_add_new_form" action="" method="POST">
        <!-- form title section -->
      	  <label class="wp_grv_add_rv_label wp_grv_required"><?php _e( 'Title :', 'wp-gratify-lang' )?></label>
      	  <input class="wp_grv_field" type="text" name="add_title" maxlength="100" id="wp_grv_add_title" autocomplete="off" required <?php if(isset($rv_id )){ echo 'value = "'.$rv_title.'"'; } ?> /><br/>
        <!-- form content section -->
          <label class="wp_grv_add_rv_label wp_grv_required"><?php _e( 'Content :', 'wp-gratify-lang' )?></label>
      	  <textarea class="wp_grv_field" id="wp_grv_add_content" maxlength="500" rows="5" cols="50" name="add_content" required ><?php if(isset($rv_id)){ echo $rv_content; } ?></textarea><br/>
        <!-- form usrimage section -->  
      	 <label class="wp_grv_add_rv_label"><?php _e( 'User Image :', 'wp-gratify-lang' )?></label>
      	  <input id="rv_add_usr_img" class="wp_grv_field" type="text" name="add_user_image" autocomplete="off" <?php if(isset($rv_id)){ echo 'value = "'.$rv_user_image_fetch.'"'; } ?> />&nbsp;<button class="wp_grv_btn" id="rv_add_upload_usr_img_button"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="rv_add_upload_usr_img_reset_button"><i class="fa fa-history"></i></button>
          <div id="add_rv_img_upload_div"><img id="rv_upload_img_show" <?php if(isset($rv_id)){ echo 'src="'.$rv_user_image_fetch.'"'; } ?> style="width:70px; " ></div>
        <!-- form enable/disable button section --> 
          <label class="wp_grv_add_rv_label"><?php _e( 'Content Disable / Enable :', 'wp-gratify-lang' )?></label>
          <label class="wp_grv_add_rv_switch rv_switch_add_new_review"><input type="checkbox" name="aproval_sel" class="rv_approval_sel" value="true" <?php if(isset($rv_id)){ if ($rv_approved == "true"){ echo 'checked'; } } ?>  /><span class="wp_grv_add_rv_slider wp_grv_add_rv_round"></span></label><br/><br/>
        <!-- save button section -->
          <input type="hidden" name="rv_id" value="<?php if(isset($rv_id)){ echo $rv_id; } ?>" id="wp_grv_single_rv_id" />
          <button name="update_rv_sub" class="wp_grv_btn_sub" id="wp_grv_update" <?php if(isset($rv_id)){ echo 'style = "display: block;"'; } else{ echo 'style = "display: none;"';  } ?>><i class="fa fa-floppy-o"></i>&nbsp; <?php _e( 'Save', 'wp-gratify-lang' ) ?></button>
          <button name="add_rv_sub" class="wp_grv_btn_sub" id="rv_add_sub" <?php if(isset($rv_id)){ echo 'style = "display: none;"'; } ?>><i class="fa fa-floppy-o"></i>&nbsp; <?php _e( 'Save', 'wp-gratify-lang' ) ?></button>
    </form>
  </div>
<?php
}
