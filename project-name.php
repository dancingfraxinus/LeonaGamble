<?php

//Rename Project => Paintings 
add_action( 'init', 'rename_project_cpt' );

function rename_project_cpt(){

register_post_type( 'project',
	array(
	'labels' => array(
	'name'          => __( 'Paintings', 'divi' ), 
	'singular_name' => __( 'Painting', 'divi' ), 
	'menu_name'		=> __( 'Paintings', 'divi'),
	'description'	=> __( 'Painting Description'),	
	'add_new_item'  => __( 'Add new Painting', 'divi' ), 	
	'new_item_name' => __( 'New Painting Name' ),	
	'all_items'		=> __( 'All Paintings', 'divi'),
	'edit_items'	=> __( 'Edit Paintings', 'divi'),
	'delete_items'  => __( 'Delete Paintings'),	
	'view_item'     => __( 'View Painting', 'divi' ),	
    'search_items'  => __( 'Search Paintings', 'Divi' ),		
	),
	'has_archive'  => true,	
	'hierarchical' => true,
	'menu_icon'    => 'dashicons-art ',
	'show_in_rest' => true, 
	'menu_position' => 6, 	
	'query_var'    	=> true,   
	'show_ui'      => true,   
	'public'       => true,  
	'publicly_queryable'       => true,	
	'rewrite'      => array( 'slug' => 'Gallery', 'with_front' => false ),
  	'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields', 'page-attributes'),    
			)	  
				);	
/* register_taxonomy( 'project_category', 
	array( 'project' ),
   array(
	'labels' => array(
	'name'          => __( '', 'divi' ), 
	'singular_name' => __( '', 'divi' ), 
	'search_items' => __( '', 'Divi' ),
	'add_new_item' =>__('', 'Divi'),
	'new_item_name' => __( '' ),	
	'edit_item'	=> __( '', 'divi'),
	'update_item' => __( '' ),	
	'all_items' => __( '', 'Divi' ),
	'parent' => __( '' ), 
  
		), 
	'has_archive'  			 => true,   
	'show_admin_column' 	 => true,   
	'hierarchical' 			 => true,   
	'query_var'    			 => true,   
	'show_ui'      			 => true,   
	'public'      			 => true,  
	'publicly_queryable'     => true,    
	'rewrite' 		=> array('slug' => '', 'with_front' => false ),
	'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),   
			)
	); */

/* register_taxonomy( 'project_tag', 
	array( 'project' ), 
	array(
	  	'labels' => array(
	  	'name' 			=> __( '', 'Divi' ),
    	'singular_name' => __( '', 'Divi' ),
		'search_items' 	=> __( '', 'Divi' ),
		'add_new_item'          => __( '', 'divi' ),
		'new_item_name' => __( '' ),	
		'edit_item'	=> __( '', 'divi'),	
		'all_items' 	=> __( '', 'Divi' ),		
	  ),
		'has_archive'           => true,
    	'show_admin_column' 	=> true, 
		'query_var'   		 	=> true,   
		'show_ui'      			=> true,   
		'public'       			=> true,  
		'publicly_queryable'    => true, 
		'rewrite' 		=> array('slug' => '', 'with_front' => false ),
		'supports'     => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
		) 
				 );	*/
					}

//Post Editor
add_filter( 'enter_title_here', function( $title ) {
    $screen = get_current_screen();

    if  ( '' == $screen->post_type ) {
        $title = '';
    }
    return $title;
} );

//Help Tab in Guest Posts 
add_action('admin_head', function() {
    $screen = get_current_screen();

    if ( 'project' != $screen->post_type )
        return;
	
    $args = [
        'id'      => '',
        'title'   => '',
        'content' => '',
    ];

    $screen->add_help_tab( $args );
});

// PAINTINGS ADMIN COLUMNS
add_filter( 'manage_edit-project_columns', 'df_project_columns' );

function df_project_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
        'featured_image' => __('Image', 'df'),
        'title' => __('Title', 'df'),
		'categories' => __('Categories', 'df'),
		'tags'  => __('Tags', 'df'),
	);

	return $columns;
}
 

// Use when needed: 
flush_rewrite_rules();

?>