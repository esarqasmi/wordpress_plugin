<?php 

// Save values of meta box
function pc_save( $post_id ) {

	if ( !isset( $_POST['pc_inner_custom_box_nonce'] ) )
		return $post_id;

	$nonce = $_POST['pc_inner_custom_box_nonce'];
	
	if ( !wp_verify_nonce( $nonce, 'pc_inner_custom_box' ) )
		return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

	$wp_contributor = sanitize_meta('_wp_contributor', $_POST['wp_contributor'], 'post' );
	
	if( isset( $wp_contributor ) && $wp_contributor != '' ) {
		update_post_meta( $post_id, '_wp_contributor', implode( ",", $wp_contributor) );
	}
	else {
		update_post_meta( $post_id, '_wp_contributor', '' );
	}
}

?>