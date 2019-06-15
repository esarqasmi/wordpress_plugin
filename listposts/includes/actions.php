<?php 
function lp_admin_notice__success() {
	$class = 'notice notice-success is-dismissible';
	$message = __( 'Saved Successfully!', 'pp-text-domain' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}
//add_action( 'admin_notices', 'pp_admin_notice__success' ); 
function lp_admin_notice__update() {
	$class = 'notice notice-success is-dismissible';
	$message = __( 'Updated Successfully!', 'pp-text-domain' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}


function lp_admin_notice__error() {
	$class = 'notice notice-error is-dismissible';
	$message = __( 'Price Package! An error has occurred. Please try again adding with valid values.', 'pp-text-domain' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}


function listsposts_process_data($posted_data){
	//$posted_data = unserialize($posted_data); 
	$posttypes = (isset($posted_data)) ? $posted_data : '';
 
	 
	if(empty($posttypes)) {return false;}

    // Query Arguments
    $args = array(
        'post_type' => $posttypes, 
        'post_status' => array('publish'),
        'posts_per_page' => 40,
        'nopaging' => true,
        'order' => 'DESC',
        'orderby' => 'date', 
    );
	 
    // The Query
$ajaxposts = new WP_Query( $args );
$posts_data = array(); 

    // The Query
    if ( $ajaxposts->have_posts() ) {
        while ( $ajaxposts->have_posts() ) {
            $ajaxposts->the_post();
           // $response .= get_template_part('products');
		   $query_data = array(
		   'ID' => get_the_ID(),
		   'post' => get_the_title(),
		   'post_edit_link' =>get_edit_post_link(),
		   'post_type' =>get_post_type(),
		   'post_date' =>get_the_date(), 
		    
		   );
		   
		   if(!empty($query_data)){ 
		   $posts_data[] = $query_data;
			   } 
        }
    }  
    return $posts_data;

    exit; 

	}

 
 ?>