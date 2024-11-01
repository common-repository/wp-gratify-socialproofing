<?php
/*
 * function to create tabs in settings page
 * return void
*/ 
function wp_grv_sp_settings_function(){	
?>
<div id="wp_grv_settings_page_container">
    <!-- div shows loader icon -->
      <div class="se-pre-con"></div>
    <!-- Ends -->
    <!-- Settings notification bar (admin bar) -->
    <div id="wp_grv_ajax_notification_load" class="wp_grv_header_notification_bar">
        <a class="wp_grv_settings_icon_hover" style="color: #ffff;" href="<?php echo admin_url( '/admin.php?page=wp-grv-sp-settings-menu' ); ?>"><i class="fa fa-cog" style="margin-left: 15px;"></i></a></span>&nbsp;&nbsp;&nbsp;
    </div>
    <!-- notification bar ends -->
    <!-- settings menue bar -->
    <div id="tabs" class="wp_grv_menu_settings_tab">
      <ul>
        <li id="wp_grv_social_proofing_tab"><a href="#rv_social_proofing_tab" title="Social Proofing settings"><i class="fa fa-id-card-o"></i><span>&nbsp;<?php echo _e( 'Social Proofing', 'wp-gratify-lang' ); ?></span></a></li>
      </ul> 
      <!--
        div for loading
       --> 
      <div class="wp_grv_loader" id="wp_grv_loader" style="display: none;"></div>
      <!-- end loading -->
      <!-- review social proofing settings --> 
       <div id="rv_social_proofing_tab">
       <?php
        $social_proofing_fetch_sett = get_option('wp_grv_sp_social_proofing_settings');
       ?>     	
        <h2 class="wp_grv_social_proofing_txt wp_grv_head_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo _e( 'Social Proofing Settings', 'wp-gratify-lang' ); ?></h2>
        <br><br>
       	<form>
          <table id="wp_grv_social_proofing_form_block">
            <tr>      
                  <th>
                    <br/><label class="wp_grv_label wp_grv_required"><?php echo _e( 'Default User Image:', 'wp-gratify-lang' ); ?></label>
                  </th>
                  <td>
                    <br/><input type="hidden" value="<?php echo $social_proofing_fetch_sett['user_image']; ?>" id="wp_grv_sp_usr_img_url" name="usr_img_url" />
                    <input id="wp_grv_sp_usr_img" type="text" class="wp_grv_field" disabled name="user_image" value="<?php echo $social_proofing_fetch_sett['user_image']; ?>" /> 
                    <button id="wp_grv_sp_upload_usr_img_button" class="wp_grv_btn" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;
                    <button id="wp_grv_sp_usr_img_reset_btn" class="wp_grv_btn" title="Reset"><i class="fa fa-history"></i></button>
                    <img id="wp_grv_sp_usr_img_shows" src="<?php echo $social_proofing_fetch_sett['user_image']; ?>" style="width:70px; margin-top: 4px; <?php if($social_proofing_fetch_sett['user_image'] === ''){ echo 'display: none;'; } else{ echo 'display: block;'; } ?>" >
                  </td>
            </tr>
            <tr>
            		<th><br/><label class="wp_grv_label"><?php echo _e( 'Font size for name(in px):', 'wp-gratify-lang' ); ?></label></th>
                            <td><br/><input type="number" name="social_proofing_text_size_name" id="wp_grv_sp_social_proofing_text_size_name" class="wp_grv_select_field" placeholder="18px(default)" value="<?php if(isset($social_proofing_fetch_sett['social_proofing_text_size_name'])){ echo $social_proofing_fetch_sett['social_proofing_text_size_name'];} else echo "18"; ?>">
            </tr>
            <tr>
            		<th><br/><label class="wp_grv_label"><?php echo _e( 'Font size for review(in px):', 'wp-gratify-lang' ); ?></label></th>
                            <td><br/><input type="number" name="social_proofing_text_size_contents" id="wp_grv_sp_social_proofing_text_size_contents" class="wp_grv_select_field" placeholder=15px(default) value="<?php if(isset($social_proofing_fetch_sett['social_proofing_text_size_contents'])){ echo $social_proofing_fetch_sett['social_proofing_text_size_contents'];} else echo "15"; ?>">
            </tr>
            <tr>
            		<th><br/><label class="wp_grv_label"><?php echo _e( 'Background Color:', 'wp-gratify-lang' ); ?></label></th>
                            <td><br/><input type="color" name="social_proofing_bg_color" id="wp_grv_sp_social_proofing_bg_color" value="<?php if(isset($social_proofing_fetch_sett['social_proofing_bg_color'])){ echo $social_proofing_fetch_sett['social_proofing_bg_color'];} else echo "#ffffff"; ?>">&nbsp&nbsp&nbsp<i class="fa fa-eye" id="fa-eye"></i>

            <div id="wp_grv_sp_bg_block" style = 'background-color:<?php if(isset($social_proofing_fetch_sett['social_proofing_bg_color'])){ echo $social_proofing_fetch_sett['social_proofing_bg_color'];} else echo "#ffffff"; ?>;'>
            	<div class='wp_grv_img_block'> <img id='wp_grv_img' alt='user-image'></div>
            	<div class='wp_grv_notification_block'><h2 id='wp_grv_txt_block' style= 'font-size:<?php if(isset($social_proofing_fetch_sett['social_proofing_text_size_name'])){ echo $social_proofing_fetch_sett['social_proofing_text_size_name'].'px';} else echo "18px"; ?>;'>Name</h2><p id='wp_grv_notification' data-notify-text/>
            	<div class='wp_grv_content_block'><p id='wp_grv_review_block' style= 'font-size:<?php if(isset($social_proofing_fetch_sett['social_proofing_text_size_contents'])){ echo $social_proofing_fetch_sett['social_proofing_text_size_contents'].'px';} else echo "15px"; ?>;'>Content Text...</p><p id='wp_grv_notification'   data-notify-text/></div></div></div></div>
            </tr>
           	<tr>
          		 <th><br/><label class="wp_grv_label"><?php echo _e( 'Position:', 'wp-gratify-lang' ); ?></label></th>
          		 <td><br/>
          			<select id="rv_sp_position_sel" class="wp_grv_select_field" name="social_proofing_position_sel">
                           		<option name="bottom_left" value="bottom left" <?php if($social_proofing_fetch_sett['social_proofing_position_sel'] === 'bottom left'){ echo 'selected';}?> >
          					<?php echo _e( 'Bottom Left', 'wp-gratify-lang' ); ?>
          				</option>
          				<option name="bottom right" value="bottom right" <?php if($social_proofing_fetch_sett['social_proofing_position_sel'] === 'bottom right'){ echo 'selected';}?> >
          					<?php echo _e( 'Bottom Right', 'wp-gratify-lang' ); ?>
          				</option>
          			</select>
          		</td>
          	</tr>
            <tr>
                <th><br/><label class="wp_grv_label"><?php echo _e( 'Mobile Disable:', 'wp-gratify-lang' ); ?> </label></th><td><br/><label class="wp_grv_mobile_settings"><input type="checkbox" name="social_proofing_mobile_enable" id="wp_grv_sp_mobile_enable" value="true" <?php if($social_proofing_fetch_sett['social_proofing_mobile_enable'] === "true"){ echo 'checked'; } ?> /><span class="grv_rv_mobile_slider grv_rv_mobile_round"></span></label></td>
            </tr>
            <tr>      
             		<th><br/><label class="wp_grv_label wp_grv_required"><?php echo _e( 'Time delay(in sec):', 'wp-gratify-lang' ); ?> </label></th><td><br/><input type="number" name="social_proofing_time_invl" class="wp_grv_field" maxlength="100" id="wp_grv_sp_social_proofing_time_invl" value="<?php echo $social_proofing_fetch_sett['social_proofing_time_invl']/1000; ?>" autocomplete="off" required /></td>
            </tr>
            <tr>    
             		<td colspan="2"><button name="save_changes_social_proofing" class="wp_grv_btn_sub" id="wp_grv_sp_social_proofing_sub"><i class="fa fa-floppy-o"></i>&nbsp; <?php echo _e( 'Save Changes', 'wp-gratify-lang' );?></button></td>
            </tr> 
          </table>     
       	</form><!-- social proofing form ends -->
       </div><!-- rv_social_proofing_tab div ends --> 
    </div><!--Tabs div ends.-->
</div><!-- wp_grv_settings_page_container div ends -->
<?php 
}
