<?php	
 function add_new_message_page() {   
 
// Excluded CPTs. You can expand the list.
$exclude_cpts = array(
    'attachment'
);
// Builtin types needed.
$builtin = array(
    'post',
    'page',
   // 'attachment'
);
// All CPTs.
$cpts = get_post_types( array(
    'public'   => true,
    '_builtin' => false
) );
// remove Excluded CPTs from All CPTs.
foreach($exclude_cpts as $exclude_cpt)
    unset($cpts[$exclude_cpt]);
// Merge Builtin types and 'important' CPTs to resulting array to use as argument.
$post_types = array_merge($builtin, $cpts);


?> 
 
  
<div class="container">
<div class="lp_sidebar">
<h2>Add Alert Message</h2>
<p>Add text message to display in selected posts on front end.</p>
 <form method='POST' action=''>
 
 <input type='hidden' name='action' value='fetch_posts'/>
 <?php wp_nonce_field( 'submitform', 'submitform_nonce' ); ?>
<table class="form-table">
        <tr valign="top">
        
        <td><label for="msg_textarea">Message</label><textarea required="required" id="msg_textarea" class="message" name="msg_textarea" value="<?php echo isset($_POST['msg_textarea']) ? $_POST['msg_textarea'] : ''; ?>" placeholder="Alert Message..."><?php echo isset($_POST['msg_textarea']) ? $_POST['msg_textarea'] : ''; ?></textarea></td>
        </tr>
         
 <?php    

foreach ( $post_types  as $post_type ) {
	$checked = isset($_POST['posttypes']) && in_array($post_type,$_POST['posttypes']) ? 'checked="checked"'  : '';
	echo ' <tr valign="top">
        <td><label for="'.$post_type.'" > <input  type="checkbox" class="selectposttype" name="posttypes[]" value="'.$post_type.'" '.$checked .' />'.ucwords($post_type).'</label></td>
       
        </tr>';
	 
} 
 
?>    <tr><td><input type="submit" value="Filter Posts" class="btn-save"/></td></tr>
    </table>

 </form>
   
</div>

</div> 
  <?php
  
//fetch form values
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "fetch_posts") {
  
   $fetched_data = listsposts_process_data($_POST['posttypes']);
   
   display_posts( $fetched_data, $_POST['msg_textarea']); 
} 
}
 ?>