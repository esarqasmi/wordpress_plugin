<?php 
// Display Post Contributors
function pc_display( $content ) { 
	global $post; $html = '';
	$html .= "<div class='wrapper-container'> <h4>Contributors</h4>";
	$contributors = get_post_meta( $post->ID, '_wp_contributor', true );
	
	if($contributors == '') return $content;
			
	$contributors = explode( ",", $contributors );
	
	$html .= "<ul class='contrib-list'> <div class = 'row'>";
	$html .= "<div class = 'contributor'>";

	foreach ( $contributors as $contributor ) {
		$contributor_info = get_userdata( $contributor );
		$html .= "<li class='img-wrapper'><a class = '' href='".get_author_posts_url( $contributor_info->ID )."'>". get_avatar( $contributor, 40 )."<p class = 'author-name'>".esc_html( $contributor_info->nickname ) . "</p> </a></li>";
		$html .= "<hr/>";
	}
	
	$html .= "</div></div></ul>";
	$html .= "</div><div style='clear:both;'></div>";
	return $content.$html;
}
?>