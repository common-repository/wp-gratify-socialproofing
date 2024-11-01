<?php
function wp_grv_sp_all_content_function(){
?>
<div id="wp_grv_all_rv_page_container"> 
	<!-- div shows loader icon -->
	<div class="se-pre-con"></div>
	<!-- Ends -->
	<!-- delete loading icon -->
	<div class="wp_grv_delete_loader">
		<img class="wp_grv_delete_loader_success" src="<?php echo plugins_url('/wp-gratify/assets/css/admin/wp-grv-loader/wp-grv-delete-success-icon.gif'); ?>">
		<img class="wp_grv_delete_loader_icon" src="<?php echo plugins_url('/wp-gratify/assets/css/admin/wp-grv-loader/wp-grv-delete-loader-icon.gif'); ?>">
	</div>
	<!-- delete loding icon ends -->
	<div>
		<!-- all review page notification bar (admin bar) -->
		<div id="wp_grv_ajax_notification_load" class="wp_grv_header_notification_bar">
			<a class="wp_grv_settings_icon_hover" style="color: #ffff;" href="<?php echo admin_url( '/admin.php?page=wp-grv-sp-settings-menu' ); ?>"><i class="fa fa-cog" style="margin-left: 15px;"></i></a></span>&nbsp;&nbsp;&nbsp; 
		</div>
		<!-- Ends notification bar -->
		<div class="wp_grv_header_width"><h2><b><?php _e( 'All', 'wp-gratify-lang' ) ?></b></h2></div>
	</div>
	<div id="wp_grv_sp_rv_ajax_reload">
	<?php	
		global $wpdb;
		$comment_tbl = $wpdb->prefix . 'comments';
		$all_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_sp'");
		$enable_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_sp' AND comment_approved='true'");	
	?>
		<div id="rv_all_list">
			<form action="" method="POST">
			<input class="wp_grv_btn" type="button" onclick="window.location.href='<?php echo admin_url('/admin.php?page=wp-grv-sp-add-new-menu'); ?>'" name="add_new_btn" id="rv_add_new_btn" value="<?php echo _e( 'Add New', 'wp-gratify-lang' ); ?>" /><br/>
			<h4><b> <?php echo _e( 'All', 'wp-gratify-lang' ); ?> (<?php echo $all_review_num; ?>) | <?php echo _e( 'Published', 'wp-gratify-lang' ); ?> (<span id="wp_grv_rv_enable_count"><?php echo $enable_review_num; ?></span>)</b></h4>
			<select class="wp_grv_rv_bulk_actions wp_grv_select_field" name="bulk_actions">
			<option><?php echo _e( 'Bulk Actions', 'wp-gratify-lang' ); ?></option>	
			<option value="delete"> <?php echo _e( 'Delete', 'wp-gratify-lang' ); ?> </option>
			</select> 
			<input type="button" name="action_submit"  class="wp_grv_btn_sub wp_grv_rv_action_submit" value="<?php echo _e( 'Apply', 'wp-gratify-lang' ); ?>" />
			</form>
			<!--
			    div for loading
			--> 
			<div class="wp_grv_loader" style="display: none;"></div>
			<!-- for scrolling icon -->
				<div class="wp_grv_scroll_icon_border">
					<h3>Scroll &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right wp_grv_scroll_arrow_icon"></i></h3>
				</div>
			<!-- scrolling icon div ends -->	
			<div id="rv_schema_tab"> 
			    <form>
				    <div class="wp_grv_tbl">	
				    <table id="wp_grv_sp_all_rv_tbl"> 
				    	<thead>
				    		<tr>
						    		<th><input type="checkbox" value="on"  name="all_sel" class="rv_all_sel rv_select_check_box"></th>
						    		<th><?php echo _e( 'Title', 'wp-gratify-lang' );    ?></th>
						    		<th><?php echo _e( 'Approval', 'wp-gratify-lang' ); ?></th>
						    		<th><?php echo _e( 'Date', 'wp-gratify-lang' ); 	?></th>
							</tr>
					    </thead>
					<tbody>
				    <?php
			    	global $wpdb;
					$comment_tbl = $wpdb->prefix . 'comments';
					$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_sp' ORDER BY comment_ID DESC",ARRAY_A);
					foreach ($comment_tbl_data as $value_comment_tbl_data){
					$rv_id_fetch = $value_comment_tbl_data['comment_ID'];
					$rv_date_fetch = $value_comment_tbl_data['comment_date'];
					$rv_approved = $value_comment_tbl_data['comment_approved'];
					$key = "comment_extras";
					$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
					foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
						$rv_title = $comment_meta_data_fetch_value['review_title'];
					}
				    	?>
				    	<tr class="wp_grv_rv_tbl_row">		
			    	        <td><input type="checkbox" name="all_sel" class="rv_all_sel" value="<?php echo $rv_id_fetch; ?>"><br/></td>
				    		<td class="wp_grv_all_rv_title"><?php echo _e( $rv_title, 'wp-gratify-lang' ); ?><br/>
								<div class="wp_grv_rv_edit_delete">
									<a title="Review Edit" id="wp_grv_edit_count" data_edit_id="<?php echo $rv_id_fetch; ?>"  href="<?php echo admin_url('/admin.php?page=wp-grv-sp-add-new-menu&edit_id='.$rv_id_fetch ); ?>" style="text-decoration: none;" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
									<a title="Review Delete" id="wp_grv_rv_delete" data_id="<?php echo $rv_id_fetch; ?>" href="#" style="text-decoration: none;" ><i class="fa fa-trash-o"></i></a>
								</div><br/>
							</td>
				    		<td><label class="rv_switch"><input type="checkbox" value="<?php echo $rv_id_fetch; ?>" name="aproval_sel" class="rv_approval_sel" <?php if($rv_approved == 'true'){echo 'checked';} ?>/><span class="rv_slider rv_round"></span></label><br/></td>
				    		<td><?php echo _e( $rv_date_fetch, 'wp-gratify-lang' ); ?><br/></td>
			    	    </tr>
					   <?php
					  }
					  ?>	
				    	</tbody>
				    	<tfoot>
			    	 		<tr>
						    		<th><input type="checkbox" value="on"  name="all_sel" class="rv_all_sel rv_select_check_box"></th>
						    		<th><?php echo _e( 'Title', 'wp-gratify-lang' );    ?></th>
						    		<th><?php echo _e( 'Approval', 'wp-gratify-lang' ); ?></th>
						    		<th><?php echo _e( 'Date', 'wp-gratify-lang' ); 	?></th>
						    </tr>
				    	</tfoot>	
				    </table>
					</div><!-- wp_grv_tbl div ends -->
				    <div id="wp_grv_bulk_action_block">
					    <select class="wp_grv_rv_bulk_actions_footer wp_grv_select_field" name="bulk_actions">
				   		<option><?php echo _e( 'Bulk Actions', 'wp-gratify-lang' ); ?></option>	
				   		<option value="delete"><?php echo _e( 'Delete', 'wp-gratify-lang' ); ?></option>
					    </select> 
					    <input type="button" name="action_submit" class="wp_grv_btn_sub wp_grv_rv_action_submit_footer" value="<?php echo _e( 'Apply', 'wp-gratify-lang' ); ?>" />
					</div>
				</form>
		</div>
	</div> <!-- wp_grv_rv_ajax_reload div ends -->
</div>
<?php
}			
