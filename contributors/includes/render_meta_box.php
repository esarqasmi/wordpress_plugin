<?php 
function pc_add_meta_box() {
	add_meta_box('pc_meta_box','Contributors','pc_render_meta_box','post','side','core');
}

// Render Meta Box
function pc_render_meta_box( $post ) {
	wp_nonce_field( 'pc_inner_custom_box', 'pc_inner_custom_box_nonce' );
	$contributors = get_post_meta( $post->ID, '_wp_contributor', true );
	if( !empty($contributors) )
		$contributors = explode( ",", $contributors );
	else {
		$contributors = array();
	}
				
	$authors = get_users( 'orderby=nicename' );

	if( count( $authors ) > 0 ) {
		echo "<ul id='wp_contributor_list'>";
		foreach ( $authors as $author ) {
			if( in_array( $author->ID, $contributors ) )
				echo "<li> <input checked='checked' type='checkbox' name='wp_contributor[]' value='".$author->ID."' /> ". esc_html( $author->nickname) . "</li>";
			else
				echo "<li> <input type='checkbox' name='wp_contributor[]' value='".$author->ID."' /> ". esc_html( $author->nickname) . "</li>";
		}
		echo "</ul>";
	}
}

?>