<?php
/*
Plugin Name: List Custom Posts
Plugin URI: https://github.com/esarqasmi/wordpress_plugin
description: A plugin to List down all selected posts with custom alert message box
Version: 1.0
Author: Esar ul haq Qasmi
Author URI: https://github.com/esarqasmi/wordpress_plugin
License: GPL2
*/ 
global $wpdb; 

/**

* Enqueue scripts and styles

*/

function listposts_scripts()
{
    wp_enqueue_style('frontend-layout', plugin_dir_url(__FILE__) . 'assets/front/css/style.css');
    //  wp_enqueue_style( 'frontend-layout', plugin_dir_url( __FILE__ ).'css/msg-style.css' ); 
    wp_enqueue_script('validate-application', plugin_dir_url(__FILE__) . 'js/custom.js', '', '', true);
    
    
    wp_enqueue_style('ibenic-bootstrap-css', "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css");
    wp_enqueue_script('ibenic-bootstrap-js', "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", array(
        'jquery'
    ), '1.0.0');
    wp_enqueue_script('bootstrap-js', "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js", array(
        'jquery'
    ), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'listposts_scripts');



/* Runs when plugin is activated */
register_activation_hook(__FILE__, 'listposts_plugin_install');
/* Runs on plugin deactivation*/
register_deactivation_hook(__FILE__, 'listposts_plugin_remove');



/**

* Register and enqueue a hopurfireind coaches stylesheet in the WordPress admin.

*/
function wp_listposts_enqueue_custom_admin_style()
{
    
    wp_enqueue_style('admin-layout', plugin_dir_url(__FILE__) . 'assets/admin/css/style.css');
   wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' . 'css/bootstrap.min.css');
    
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
    
}

add_action('admin_enqueue_scripts', 'wp_listposts_enqueue_custom_admin_style');
//admin side options   

function listposts_register_lists_page()
{
    add_options_page('Set Message in Selected Posts', 'Alert Messages', 'manage_options', 'listposts_plugin', 'listposts_lists_page'); //listposts_option_page
    add_options_page('Set Message in Selected Posts', '', 'manage_options', 'add-new-message', 'add_new_message_page');
    add_options_page('Selected Posts', '', 'manage_options', 'fetch-posts', 'display_posts');
}
add_action('admin_menu', 'listposts_register_lists_page'); 


/*********includes**********/
include "includes/actions.php";
include "includes/List_Table.php"; 
include "includes/lists_page.php";
include "includes/fetch_posts.php";
include "includes/add_message.php";
include "includes/activation.php";

add_action('admin_post_nopriv_fetch_posts', 'listposts_fetch_posts');
add_action('admin_post_fetch_posts', 'listposts_fetch_posts');


add_action('admin_post_update_action', 'admin_update_action');