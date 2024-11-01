jQuery(document).ready(function(){
  /*
   * ajax function for update single sp
   *
  */ 
    jQuery("#wp_grv_update").click(function(){ 
      event.preventDefault();
    	var wp_grv_single_rv_id                 = jQuery('#wp_grv_single_rv_id').val();
  		var wp_grv_add_title                    = jQuery('#wp_grv_add_title').val();
  		var wp_grv_add_content                  = jQuery('#wp_grv_add_content').val();
      if(wp_grv_add_title == ''){
        jQuery("#wp_grv_add_title").focus();
        return false;
      }else{
        jQuery("#wp_grv_add_title").focusout();
      }
      if(wp_grv_add_content == ''){
        jQuery("#wp_grv_add_content").focus();
        return false;
      }else{
        jQuery("#wp_grv_add_content").focusout();
      }
  		var wp_grv_add_usr_img                  = jQuery('#rv_add_usr_img').val();
  		var wp_grv_approval_sel                 = jQuery(".rv_approval_sel").prop("checked");
      jQuery('.se-pre-con').css('display', 'block');// loader icon visible
  		var ajaxurl                             = wp_grv_ajax_script.wp_grv_ajaxurl;
  		var wp_grv_sp_update_details_data       = {
  			'action'                    : 'wp_grv_sp_single_update', //function name
  			'wp_grv_single_rv_id'       : wp_grv_single_rv_id,
  			'wp_grv_add_title'          : wp_grv_add_title,
  			'wp_grv_add_content'        : wp_grv_add_content,
  			'wp_grv_add_usr_img'        : wp_grv_add_usr_img,
  			'wp_grv_approval_sel'       : wp_grv_approval_sel,
  		};
  		jQuery.post(ajaxurl, wp_grv_sp_update_details_data, function(response) {
  			jQuery('.wp_grv_sp_update_successfull_msg_wp_add_rv_update').css('display', 'block');
        jQuery('.se-pre-con').css('display', 'none');// loader icon hide.
        jQuery('.wp_grv_sp_update_successfull_msg_wp_add_rv_update').fadeOut(10000);
        jQuery(window).scrollTop(0);
  		});
	});	 	

  /*
   * ajax function for bulk action in all list section
   *
  */
  jQuery(".wp_grv_rv_action_submit").live("click", function(){
      var wp_grv_rv_bulk_action = jQuery('.wp_grv_rv_bulk_actions').val();
      if( wp_grv_rv_bulk_action === 'delete'){
        var wp_grv_delete_confirm = confirm("Are you sure?");
        if(wp_grv_delete_confirm === true){
          //jQuery('.wp_grv_loader').css('display', 'block');
        	 	jQuery('.rv_all_sel').each(function() {
        	 		var wp_grv_rv_sel = jQuery(this).prop("checked");
        	 		var wp_grv_rv_sel_val = jQuery(this).val();
        	 		//alert(wp_grv_rv_sel);
        	 		if( wp_grv_rv_sel === true && wp_grv_rv_sel_val != 'on' ){ // checkbox condition checking.on value is default value of all checking check box.
                    jQuery('.wp_grv_delete_loader_icon').css('display', 'block');// loader icon visible
                  	var ajaxurl          = wp_grv_ajax_script.wp_grv_ajaxurl;
      	            var rv_delete_data   = {
          			    	'action':'wp_grv_sp_delete_fun', //function name
          			    	'wp_grv_delete_id' : wp_grv_rv_sel_val,
      	             };
      	            jQuery.post(ajaxurl, rv_delete_data, function(response) {
                      //jQuery('.wp_grv_loader').css('display', 'none');
                      jQuery('.wp_grv_delete_loader_icon').css('display', 'none');// loader icon hide.
                      jQuery('.wp_grv_delete_loader_success').css('display', 'block');// success icon visible.
                      setTimeout(function() { jQuery('.wp_grv_delete_loader_success').css('display', 'none'); }, 1000);// loader icon hide.
        		       		jQuery('#wp_grv_sp_rv_ajax_reload').html(response);
        					    jQuery('#wp_grv_sp_all_rv_tbl').DataTable( {
                				"pagingType": "full_numbers"
                			});
                      jQuery( '.rv_select_check_box' ).click(
                        function () {
                          jQuery( '.rv_all_sel' ).prop( 'checked', this.checked );
                        }
                      );
      				      });
              }
          	});
        }//wp_grv_delete_confirm if ends.
      }
      else{
        alert('Please select Bulk action.');
      }
  });
  //footer bulk action.
  jQuery(".wp_grv_rv_action_submit_footer").live("click", function(){
      var wp_grv_rv_bulk_action = jQuery('.wp_grv_rv_bulk_actions_footer').val();
      if( wp_grv_rv_bulk_action === 'delete'){
        var wp_grv_delete_confirm = confirm("Are you sure?");
        if(wp_grv_delete_confirm === true){
          //jQuery('.wp_grv_loader').css('display', 'block');
            jQuery('.rv_all_sel').each(function() {
              var wp_grv_rv_sel = jQuery(this).prop("checked");
              var wp_grv_rv_sel_val = jQuery(this).val();
              //alert(wp_grv_rv_sel);
              if( wp_grv_rv_sel === true && wp_grv_rv_sel_val != 'on' ){ // checkbox condition checking.on value is default value of all checking check box.
                    jQuery('.wp_grv_delete_loader_icon').css('display', 'block');// loader icon visible
                    var ajaxurl          = wp_grv_ajax_script.wp_grv_ajaxurl;
                    var rv_delete_data   = {
                      'action':'wp_grv_sp_delete_fun', //function name
                      'wp_grv_delete_id' : wp_grv_rv_sel_val,
                    };
                    jQuery.post(ajaxurl, rv_delete_data, function(response) {
                      //jQuery('.wp_grv_loader').css('display', 'none');
                      jQuery('.wp_grv_delete_loader_icon').css('display', 'none');// loader icon hide.
                      jQuery('.wp_grv_delete_loader_success').css('display', 'block');// success icon visible.
                      setTimeout(function() { jQuery('.wp_grv_delete_loader_success').css('display', 'none'); }, 1000);// loader icon hide.
                      jQuery('#wp_grv_sp_rv_ajax_reload').html(response);
                      jQuery('#wp_grv_sp_all_rv_tbl').DataTable( {
                        "pagingType": "full_numbers"
                      });
                    });
              }
            });
        }// wp_grv_delete_confirm if ends.
      }
      else{
        alert('Please select Bulk action.');
      }
  });
  /*
   * ajax function for individual sp delete in all list section
   *
  */
  jQuery("#wp_grv_rv_delete").live("click", function(){
  	event.preventDefault();
    var wp_grv_delete_confirm = confirm("Are you sure?");
    if(wp_grv_delete_confirm === true){
        jQuery('.wp_grv_delete_loader_icon').css('display', 'block');// loader icon visible
        var wp_grv_delete_id = jQuery(this).attr("data_id");
        var ajaxurl          = wp_grv_ajax_script.wp_grv_ajaxurl;
    	  var rv_delete_data   = {
    			'action':'wp_grv_sp_delete_fun', //function name
    			'wp_grv_delete_id' : wp_grv_delete_id,
    	  };
      	jQuery.post(ajaxurl, rv_delete_data, function(response) {
          jQuery('.wp_grv_delete_loader_icon').css('display', 'none');// loader icon hide.
          jQuery('.wp_grv_delete_loader_success').css('display', 'block');// success icon visible.
          setTimeout(function() { jQuery('.wp_grv_delete_loader_success').css('display', 'none'); }, 1000);// loader icon hide.
      		jQuery('#wp_grv_sp_rv_ajax_reload').html(response);
          jQuery('#wp_grv_sp_all_rv_tbl').DataTable( {
              "pagingType": "full_numbers"
            });	
      	});
  }
  });
  /*
   * ajax function for sp enable in all list section
   *
  */
  jQuery(".rv_approval_sel").live("click", function(){
    var wp_grv_approve_id = jQuery(this).val();
    var wp_grv_approve    = jQuery(this).prop("checked");
    var ajaxurl           = wp_grv_ajax_script.wp_grv_ajaxurl;
	var rv_approval_data  = {
			'action':'wp_grv_sp_approval_update_insert_db', //function name
			'wp_grv_approve_id' : wp_grv_approve_id,
			'wp_grv_approve'    : wp_grv_approve,
	};
	jQuery.post(ajaxurl, rv_approval_data, function(response) {
		jQuery('#wp_grv_rv_enable_count').text(response);
	});
  });
  /*
   * ajax function for social_proofing insertion
   *
  */ 
    jQuery("#wp_grv_sp_social_proofing_sub").click(function(){
        event.preventDefault();
    		var wp_grv_sp_usr_img         = jQuery('#wp_grv_sp_usr_img_url').val();
    		var wp_grv_sc_pr_tm_invl_sec  = jQuery('#wp_grv_sp_social_proofing_time_invl').val();
        	var wp_grv_sc_pr_tm_invl      = wp_grv_sc_pr_tm_invl_sec * 1000;
		var wp_grv_sp_social_proofing_bg_color         	= jQuery('#wp_grv_sp_social_proofing_bg_color').val();
		var wp_grv_sp_social_proofing_text_size_name   	= jQuery('#wp_grv_sp_social_proofing_text_size_name').val();
		var wp_grv_sp_social_proofing_text_size_contents   = jQuery('#wp_grv_sp_social_proofing_text_size_contents').val();
		var wp_grv_sp_social_proofing_position_sel         = jQuery('#rv_sp_position_sel').val();
		var wp_grv_sp_mobile_enable                        = jQuery("#wp_grv_sp_mobile_enable").prop("checked");


        /* Validation */
        if(wp_grv_sp_usr_img === ''){
          jQuery('#wp_grv_sp_usr_img').css('border', 'solid 1px #f10707');
        }
        else{
          jQuery('#wp_grv_sp_usr_img').css('border', 'none');
        }
        if(wp_grv_sc_pr_tm_invl === ''){
          jQuery('#wp_grv_sp_social_proofing_time_invl').css('border', 'solid 1px #f10707');
        }
        else{
          jQuery('#wp_grv_sp_social_proofing_time_invl').css('border', 'none');
        }
        if(wp_grv_sp_usr_img ==='' || wp_grv_sc_pr_tm_invl ===''){
          return false;
        }
        else{   
              jQuery('#wp_grv_loader').css('display', 'block');
              jQuery('#rv_social_proofing_tab').css('opacity', '0.3');
          		var ajaxurl              = wp_grv_ajax_script.wp_grv_ajaxurl;
          		var sc_p_data            = {
          			'action'               		 	    :'wp_grv_sp_social_proofing_insert_settings', //function name
          			'wp_grv_sp_usr_img'    		 	    : wp_grv_sp_usr_img,
          			'wp_grv_sc_pr_tm_invl' 		 	    : wp_grv_sc_pr_tm_invl,
				'wp_grv_sp_social_proofing_bg_color'	    : wp_grv_sp_social_proofing_bg_color,
				'wp_grv_sp_social_proofing_text_size_name'     : wp_grv_sp_social_proofing_text_size_name,
				'wp_grv_sp_social_proofing_text_size_contents' : wp_grv_sp_social_proofing_text_size_contents,
				'wp_grv_sp_social_proofing_position_sel'       : wp_grv_sp_social_proofing_position_sel,
				'wp_grv_sp_mobile_enable'                   : wp_grv_sp_mobile_enable

          		};
        		jQuery.post(ajaxurl, sc_p_data, function(response) {
              jQuery('#wp_grv_loader').css('display', 'none');
               jQuery('#rv_social_proofing_tab').css('opacity', '1.0');
               jQuery(window).scrollTop(0);
        			jQuery('.wp_grv_update_successfull_msg_wp6').css('display', 'block');
              jQuery('.wp_grv_update_successfull_msg_wp6').fadeOut(10000);
        		});
        }    
    });      
        
});
