<?php
/* Plugin Name:  Contributors
 * Plugin URI: https://github.com/esarqasmi/contributors
 * Description:  This plugin will add WordPress metabox functionality. Goal is to create a plugin so that we can display more than one author-name on a post.
 * Version:      1.0
 * Author:       Esar ul haq Qasmi 
 * Author URI: https://github.com/esarqasmi/
 * Requires at least: wp 4.0
 * @author Esar ul haq Qasmi
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function wp_contributors_enqueue_style()
{
    
    wp_enqueue_style('admin-layout', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' . 'css/bootstrap.min.css');
    
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
    
}

add_action('wp_enqueue_scripts', 'wp_contributors_enqueue_style');
/*********includes**********/
include "includes/actions.php";
include "includes/render_meta_box.php";  
include "includes/save_meta_box.php";  
include "includes/display_meta_box.php";  