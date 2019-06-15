<?php
//function to display first page by clicking on admin menu "Alert messages"
function listposts_lists_page(){
	
	
	if( "true" == $_GET['success'] ){
   lp_admin_notice__success();
}
	
 $listTable = new List_Table(); 
 echo '<div class="wrap">
<h1 class="wp-heading-inline">Alert Messages</h1>';  
 echo ' <a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=add-new-message" class="page-title-action">Add New</a>';
 echo '<hr class="wp-header-end"> ';
  $listTable->prepare_items(); 
  $listTable->display(); 
  echo '</div>'; 
}

function _generate_BootstrapAlertBox($message_text){
	
$html = ' 
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Alert Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>'.$message_text.'</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
';

	return $html;

	} 
add_action( 'wp_footer', '_trigger_BootstrapAlertBox' );
function _trigger_BootstrapAlertBox() {
    $page_object = get_queried_object();
  
    $post_meta = get_post_meta(get_queried_object_id(),'alert_message',true);
	if(isset($post_meta) && !empty($post_meta)){
		//echo do_shortcode( '[show_alert message_text="'. $post_meta . '"]' );
	printf(_generate_BootstrapAlertBox($post_meta));
 
echo ' <script>
jQuery(document).ready(function( $ ){ 
setTimeout(function(){$("#myModal").modal("toggle"); // $("#myModal").show(); $("#myModal").addClass("in");
}, 1000); 
   
});
</script>';
}
 
 
 

} 
 ?>