<?php 
//  Add Meta Box
add_action( 'add_meta_boxes', 'pc_add_meta_box' );
// Save meta box value
add_action( 'save_post', 'pc_save' );
// Display contributors
add_filter( 'the_content', 'pc_display');

 ?>