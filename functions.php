<?php
//enqueue scripts and styles *use production assets. Dev assets are located in assets/css and assets/js
function loadup_scripts() {
	wp_enqueue_script( 'theme-js', get_template_directory_uri().'/assets/js/NPHCSN.js?ver=4.1.2', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 275, '', true); // Medium Thumbnail
add_image_size('small', 140, '', true); // Small Thumbnail
add_image_size('three-col-square', 220, 220, true);
add_image_size('page-banner', 1600, 400, true);




//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Main Navigation',
        'footer_nav' => 'Footer Navigation',


    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );

//disable code editors
add_theme_support('html5');
add_theme_support('automatic-feed-links');

//Security and header clean-ups
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'wp_generator'); // remove WP version from header
remove_action( 'wp_head','wp_shortlink_wp_head');


//CLEAN UP FUNCTIONS ----------------------------------------

// admin part cleanups //
add_action('admin_menu', 'delete_menu_items'); // deleting menu items from admin area
add_action('admin_menu','remove_dashboard_widgets'); // remove some dashboard widgets
add_action('login_head', 'my_custom_login_logo'); //Add custom logo to admin


//Clean up Dashboard
function remove_dashboard_widgets(){

    //remove_meta_box('dashboard_right_now','dashboard','core'); // right now overview box
    //remove_meta_box('dashboard_incoming_links','dashboard','core'); // incoming links box
    //remove_meta_box('dashboard_quick_press','dashboard','core'); // quick press box
    //remove_meta_box('dashboard_plugins','dashboard','core'); // new plugins box
    //remove_meta_box('dashboard_recent_drafts','dashboard','core'); // recent drafts box
    //remove_meta_box('dashboard_recent_comments','dashboard','core'); // recent comments box
    //remove_meta_box('dashboard_primary','dashboard','core'); // wordpress development blog box
    //remove_meta_box('dashboard_secondary','dashboard','core'); // other wordpress news box
}

// Remove menus froms the admin area
function delete_menu_items() {

    /*** Remove menu http://codex.wordpress.org/Function_Reference/remove_menu_page
    syntaxe : remove_menu_page( $menu_slug )  **/
    //remove_menu_page('index.php'); // Dashboard
    remove_menu_page('edit.php'); // Posts
    //remove_menu_page('upload.php'); // Media
    //remove_menu_page('link-manager.php'); // Links
    //remove_menu_page('edit.php?post_type=page'); // Pages
    //remove_menu_page('edit-comments.php'); // Comments
    //remove_menu_page('themes.php'); // Appearance
    //remove_menu_page('plugins.php'); // Plugins
    //remove_menu_page('users.php'); // Users
    //remove_menu_page('tools.php'); // Tools
    //remove_menu_page('options-general.php'); // Settings
}


//Custon wp-admin logo
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a {
          background-size: 227px 85px !important;
          margin-bottom: 20px !important;
          background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
    </style>';
}

// Register Custom Post Type
function custom_post_type_resources() {

    $labels = array(
        'name'                => _x( 'Resources', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Resource', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Resources', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Resource', 'text_domain' ),
        'all_items'           => __( 'All Resources', 'text_domain' ),
        'view_item'           => __( 'View Resource', 'text_domain' ),
        'add_new_item'        => __( 'Add New Resource', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Resource', 'text_domain' ),
        'update_item'         => __( 'Update Resource', 'text_domain' ),
        'search_items'        => __( 'Search Resources', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'resources', 'text_domain' ),
        'description'         => __( ' ', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'resources', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_resources', 0 );

// Register Custom Taxonomy
function custom_taxonomy_location() {

    $labels = array(
        'name'                       => _x( 'Locations', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Locations', 'text_domain' ),
        'all_items'                  => __( 'All Locations', 'text_domain' ),
        'parent_item'                => __( 'Parent Location', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Location:', 'text_domain' ),
        'new_item_name'              => __( 'New Location Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Location', 'text_domain' ),
        'edit_item'                  => __( 'Edit Location', 'text_domain' ),
        'update_item'                => __( 'Update Location', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'search_items'               => __( 'Search Locations', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Location', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Location', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'location', array( 'resources' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy_location', 0 );


?>
