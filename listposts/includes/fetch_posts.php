<?php
function listposts_fetch_posts($post_types, $alert_message)
{
    /* Update meta entry for each post selected */
    foreach ($post_types as $post_id) {
        update_post_meta($post_id, 'alert_message', $alert_message);
    }
    //redirect to main page after updation           
    wp_redirect(admin_url('admin.php?page=listposts_plugin&&success=true'));
    
}

/*
 * Displays List of posts available with post types
 */
function display_posts($fetched_data, $message)
{
if(!isset($fetched_data) && empty($fetched_data)){
	
	
	echo '<p class="error">No Posts found. Please add some posts in wordpress site.</p>';
	return false;
	}
if(!isset($message) && empty($message)){
	echo '<p class="error">Error1 message was not added. Please add message text first.</p>';
	return false;
	}
	

if(isset($fetched_data) && !empty($fetched_data)){	
echo '<div class="wrap lp_postsbar"> 
<h1 class="wp-heading-inline">Select Posts</h1>';
echo '<p>Select Posts to display alert message on front end.</p>';
    echo '<hr class="wp-header-end">';
    
    
?>
 <form action="<?php echo esc_attr('admin-post.php');?>" method="post">
  <table id="posts" class="posts wp-list-table widefat fixed striped settings_page_listposts_plugin" width="100%">
  <thead>
  <th id="cb" class="manage-column column-cb check-column"></th> 
  <th>Post</th>
  <th>Post Type</th>
  <th>Date</th>
  </thead>
  <tbody>
  <?php
    foreach ($fetched_data as $keys => $item) {
        echo '<tr id="' . $item['ID'] . '">
  <td><input type="checkbox" name="s_posts[]" value="' . $item['ID'] . '" /></td> 
  <td><a href="' . $item['post_link'] . '"> ' . $item['post'] . ' </a></td>
  <td>' . ucwords($item['post_type']) . '</td>
  <td>' . $item['post_date'] . '</td>
  </tr>';
    }
?>
    
 </tbody>
  </table>
    <input type="hidden" name="message_text" value="<?php  echo $message;?>" /> 
    <input type="hidden" name="action" value="update_action" />  
    <div class="btn-row"><input type="submit" value="Save Changes" class="btn-save"></div>
</form>
  <?php
}
}

// Method to update the post meta data
function  admin_update_action(){
    // Catch, verify and update the meta data
    if (!empty($_POST['action']) && $_POST['action'] == "update_action") {
        $alert_message = $_POST['message_text'];
        listposts_fetch_posts($_POST['s_posts'], $alert_message);
    }
}
?>