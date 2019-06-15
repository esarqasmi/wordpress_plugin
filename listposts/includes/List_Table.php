<?php
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_Table extends WP_List_Table { 
function get_columns(){ 
$columns = array(
    'cb'        => '<input type="checkbox" />',
    'message' => 'Message',
    'post'    => 'Post',
    'post_type'      => 'Post Type',
    'post_date'      => 'Date'
  );
  return $columns;
}
function get_data(){ 
$args = array(
   'post_type' => 'any',
   'posts_per_page' => -1,
   'meta_query' => array(
        array(
           'key' => 'alert_message',
           'compare' => 'EXISTS'
        ),
   )
);
$ajaxposts = new WP_Query($args); 
$posts_data = array(); 
  // The Query
    if ( $ajaxposts->have_posts() ) {
        while ( $ajaxposts->have_posts() ) {
            $ajaxposts->the_post(); 
		   $query_data = array(
		   'ID' => get_the_ID(),
		   'post' => get_the_title(),
		   'post_edit_link' =>get_edit_post_link(),
		   'post_type' =>get_post_type(),
		   'post_date' =>get_the_date(), 
		   'message' =>get_post_meta(get_the_ID(),'alert_message', true), 
		    
		   );
		   
		   if(!empty($query_data)){ 
		   $posts_data[] = $query_data;
			   } 
		 
        }
    }  

 return $posts_data;
	}
function prepare_items($data=NULL) { 

if(empty($data)){
 $data= $this->get_data();	
}


  $columns = $this->get_columns();
  $hidden = array();
  $sortable =$this->get_sortable_columns();
  $this->_column_headers = array($columns, $hidden, $sortable);
  usort( $data  , array( &$this, 'usort_reorder' ) ); 
  $this->items = $data; 
  //$this->process_bulk_action();
   
  
}

function column_default( $item, $column_name ) {
  switch( $column_name ) {  
    case 'post': 
    case 'post_edit_link':
    case 'post_type':
    case 'post_date':
    case 'message':
      return $item[ $column_name ];
    default:
      return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
  }
}
	function usort_reorder( $a, $b ) {
  // If no sort, default to title
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'post';
  // If no order, default to asc
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  // Determine sort order
  $result = strcmp( $a[$orderby], $b[$orderby] );
  // Send final sort direction to usort
  return ( $order === 'asc' ) ? $result : -$result;
}
 function get_sortable_columns() {
  $sortable_columns = array(
    'message'   => array('message',false),
    'post'  => array('post',true),
    'post_edit_link' => array('post_edit_link',false),
    'post_type'   => array('post_type',false),
    'post_date'   => array('post_date',false),
  );
  return $sortable_columns;
}
function column_post($item) {
  $actions = array(
            'edit'      => sprintf('<a href="'.$item['post_edit_link'].'">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&post=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );

  return sprintf('%1$s %2$s', $item['post'], $this->row_actions($actions) );
}

function get_bulk_actions() {
  $actions = array(
   //'add_message'    => 'Add Message',
    'delete'    => 'Delete'
  );
  return $actions;
}
function column_cb($item) {
         return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );     
    }
	
  public function process_bulk_action() {
 
        // security check!
        if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

            $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
            $action = 'bulk-' . $this->_args['plural'];

            if ( ! wp_verify_nonce( $nonce, $action ) )
                wp_die( 'Nope! Security check failed!' );

        }

        $action = $this->current_action();
 
        switch ( $action ) {

            case 'delete':
                wp_die( 'Delete something' );
                break;

            case 'add_message':
			
                wp_die( 'Save something' );
                break;

            default:
                // do nothing or something else
                return;
                break;
        }

        return;
    }
 
	
	
	
}
 ?>