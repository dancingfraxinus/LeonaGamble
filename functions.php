<?php 
add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' ); 
include('login-editor.php');
//include('project-name.php');
include('white-label.php');

    
    
//Child Theme Stylesheet 
function my_enqueue_assets() { 

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' ); 
 wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );	
}

//*** ICON SUPPORT ***//

//Icon Pack Stylesheet 
function df_load_ico() {
 wp_enqueue_style( 'df_ico', get_stylesheet_directory_uri() . '/fonts/style.css' );
}
 
add_action( 'wp_enqueue_scripts', 'df_load_ico' );

//Dashcons Front-end
function my_theme_styles() {
wp_enqueue_style( 'dashicons' );
}

//SVG Support 
function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

//*** END ICON SUPPORT ***//

//Disable Auto-linked Images
function wpb_imagelink_setup() {
$image_set = get_option( 'image_default_link_type' );
if ($image_set !== 'none') {
update_option('image_default_link_type', 'none');
}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


//Thumbs in Admin Columns
function custom_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'featured_image' => 'Image',
        'title' => 'Title',
        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
        'date' => 'Date'
     );
    return $columns;
}
add_filter('manage_posts_columns' , 'custom_columns');

function custom_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'featured_image':
        the_post_thumbnail( 'thumbnail' );
        break;
    }
}
add_action( 'manage_posts_custom_column' , 'custom_columns_data', 10, 2 );


// Begin remove Divi Gallery Module image crop
function gallery_image_width( $size ) {
return 9999;
}
function gallery_image_height( $size ) {
return 9999;
}
add_filter( 'et_pb_gallery_image_width', 'gallery_image_width' );
add_filter( 'et_pb_gallery_image_height', 'gallery_image_height' );
// End remove Divi Gallery Module image crop

//Woo Commerce Stylesheet ON/OFF
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

//Use When Needed:
//remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error 
flush_rewrite_rules(); //Flush Rules