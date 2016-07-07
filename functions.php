<?php
//enqueue scripts and styles *use production assets. Dev assets are located in assets/css and assets/js
function loadup_scripts() {
    wp_enqueue_script( 'theme-js', get_template_directory_uri().'/assets/js/NPHCSN.js?ver=4.1.2', array('jquery'), false, true );
     wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', false, true );
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

//Add ACF Options page
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
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

// Register Custom Post Type - Member Resources
function custom_post_type_member_resources() {

    $labels = array(
        'name'                => _x( 'Member Resources', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Member Resource', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Member Resources', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Member Resource', 'text_domain' ),
        'all_items'           => __( 'All Member Resources', 'text_domain' ),
        'view_item'           => __( 'View Member Resource', 'text_domain' ),
        'add_new_item'        => __( 'Add New Member Resource', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Member Resource', 'text_domain' ),
        'update_item'         => __( 'Update Member Resource', 'text_domain' ),
        'search_items'        => __( 'Search Member Resources', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'member_resources', 'text_domain' ),
        'description'         => __( ' ', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', ),
        //'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'member_resources', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_member_resources', 0 );


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

// Register Custom Taxonomy - Content Type
function content_type() {

    $labels = array(
        'name'                       => _x( 'Content Types', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Content Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Content Type', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Content Type', 'text_domain' ),
        'add_new_item'               => __( 'Add New Content Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Content Type', 'text_domain' ),
        'update_item'                => __( 'Update Content Type', 'text_domain' ),
        'view_item'                  => __( 'View Content Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Content Type', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Content Type', 'text_domain' ),
        'popular_items'              => __( 'Popular Content Type', 'text_domain' ),
        'search_items'               => __( 'Search Content Types', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
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
    register_taxonomy( 'content_type', array( 'member_resources' ), $args );

}
add_action( 'init', 'content_type', 0 );

// Register Custom Taxonomy - Member Topic
function member_topic() {

    $labels = array(
        'name'                       => _x( 'Member Topics', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Member Topic', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Member Topic', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Member Topic', 'text_domain' ),
        'add_new_item'               => __( 'Add New Member Topic', 'text_domain' ),
        'edit_item'                  => __( 'Edit Member Topic', 'text_domain' ),
        'update_item'                => __( 'Update Member Topic', 'text_domain' ),
        'view_item'                  => __( 'View Member Topic', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Member Topic', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Member Topic', 'text_domain' ),
        'popular_items'              => __( 'Popular Member Topic', 'text_domain' ),
        'search_items'               => __( 'Search Member Topics', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
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
    register_taxonomy( 'member_topic', array( 'member_resources' ), $args );

}
add_action( 'init', 'member_topic', 0 );

//Add ajax functionality to pages, all not just in admin
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
    ?>
    <script type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
    }


add_action('wp_ajax_get_member_resources', 'get_member_resources');  
add_action('wp_ajax_nopriv_get_member_resources', 'get_member_resources');  //_nopriv_ allows access for both signed in users, and not


function get_member_resources(){
  $post_slug = $_POST['memberResource'];
  $post_slug_ct = $_POST['contentType'];
  $query = $_POST['query']; //*
  //var_dump($post_slug);
  //$query = $_POST('query');
 
 //Make the search exlusive to entries or clicking the filter
 if ($post_slug == '*' && $post_slug_ct == "*"): //All posts?
      $args = array(
      'post_type' => 'member_resources',
      'posts_per_page' => -1,
      'post_status' => 'publish'
      
      );
elseif ($post_slug != '*' && $post_slug_ct != '*'): //Using the filter
      $args = array(
      'post_type' => 'member_resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
      'tax_query' => array(
        'relation'=>'AND',
        array(
          'taxonomy' => 'member_topic',
          'field'    => 'slug',
          'terms'    => $post_slug, 
          ),
        array(
          'taxonomy' => 'content_type',
          'field'    => 'slug',
          'terms'    => $post_slug_ct, 
          ),
        ),
      );
 elseif ($post_slug != '*' && $post_slug_ct == '*'): //Using the filter
      $args = array(
      'post_type' => 'member_resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
      'tax_query' => array(
        array(
          'taxonomy' => 'member_topic',
          'field'    => 'slug',
          'terms'    => $post_slug, 
          ),
        ),
      );
elseif ($post_slug_ct != '*' && $post_slug == '*'): //Using the filter
      $args = array(
      'post_type' => 'member_resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      //'s' => $query, //This is an 'and', so the query is effectively stopping here, if not commented out
      'tax_query' => array(
         array(
          'taxonomy' => 'content_type',
          'field'    => 'slug',
          'terms'    => $post_slug_ct, 
          ),
        ),
      );
else:  //If the search is used
      $args = array(
      'post_type' => 'member_resources',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      's' => $query
      //
          
         // ),
        //),
      );
endif;
        // the query
      
        $the_query = new WP_Query( $args ); 
        //var_dump($args);
        $count = $the_query->found_posts;
        

       if ( $the_query->have_posts() ) : 
      // Do we have any posts in the databse that match our query?
      // In the case of the home page, this will call for the most recent posts 
      
        //echo '<div class="container '.$profile_class .'" id="project-gallery">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); //We set up $the_query on line 144
        // If we have some posts to show, start a loop that will display each one the same way
        
        
         //if (have_rows ('project_gallery')): //Setup the panels between the top/bottom panels
               //Setup variables
               
                $the_title = get_the_title();
                $mr_link = get_field('mrf_link'); 
                
                $target = '';
                $external = get_field('link_type', $post->ID); 

                $date = get_the_date('m.d.y');

                if ($external == 'true'){
                        $target="_blank";
                }else{
                        $target="_self";
                    } 

                $member_topics= get_the_terms($post->ID, 'member_topic');
                //var_dump($member_topics);
                $content_types= get_the_terms($post->ID, 'content_type');

                $short_title = the_title('', '', false);
                $shortened_title = substr($short_title, 0, 73);
                
                if (strlen($short_title) >= 73){
                    $overflow = "overflow";

                }

                foreach ($member_topics as $member_topic){
                    $mt = $member_topic->slug;
                    //var_dump($mt);
                    //$mt_filter .= $member_topic->slug . ' ';
                }
                foreach ($content_types as $content_type){
                    $ct = $content_type->slug;
                    //$ct_filter .= $content_type->slug . ' ';
                }

          //endif; 
          echo '<div class="member-resource-item '. $mt . ' ' . $ct . '">
                    <div class="row">
                        <div class="one columns the-date">' . $date .'</div>
                            <div class="seven columns the-title ' . $overflow .'">
                                <a href="' . $mr_link .'" target='. $target .'>
                                    <div class="orange_text"> ' . $shortened_title . '</div>
                                </a>
                            </div>
                        <div class="two columns">
                            <div class="m-topic">' . $mt . '</div>
                        </div>
                        <div class="two columns">
                            <div class="c-type">' . $ct . '</div>
                        </div>
                    </div>
                </div>';
         endwhile; 
       else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
        
        echo '<article class="post-error">
                <h1 class="404">
                  Your search did not produce any results!
                </h1>
                <h2>
                  Please use a different search term, or try something more specific.
                </h2>
              </article>';
       endif; // OK, I think that takes care of both scenarios (having posts or not having any posts) 
       die();//if this isn't included, you will get funky characters at the end of your query results.
}


?>
