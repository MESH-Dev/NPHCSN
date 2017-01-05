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
    remove_menu_page('themes.php'); // Appearance
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

//Hide wp-admin bar
//add_filter('show_admin_bar', '__return_false');


//Redirect non-logged in to homepage
add_action( 'init', 'blockusers_init' );
function blockusers_init() {
if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
    wp_redirect( home_url() );
    exit;
    }
}
 
//allow redirection, even if my theme starts to send output to the browser
add_action('init', 'do_output_buffer');
function do_output_buffer() {
       ob_start();
}

function my_project_updated_send_email( $post_id, $update ) {

    $post_type = get_post_type($post_id);

    $id = get_current_user_id();

    global $post;
    
    //$user_info = get_userdata($id);

    //is the post type a discussion post?
    if ($post_type == 'discussions'){//Then do this stuff
    // If this is just a revision, don't send the email.
    if ( wp_is_post_revision( $post_id ) )
        return;

    $post_title = get_the_title( $post_id );
    $post_url = get_permalink( $post_id );
    $subject = 'A Discussion has been updated';

    $message = "A Discussion has been updated on your website:\n\n";
    $message .= $post_title . ": " . $post_url;

    $user_co = get_user_meta($id, 'company_name', true  );
    $user_job = get_user_meta($id, 'job_title', true  );

    add_post_meta($post_id, 'company_name', $user_co, false);
    add_user_meta($post_id, 'job_title', $user_job, false  );

    // Send email to admin.
    wp_mail( 'shaun@meshfresh.com', $subject, $message ); //hard code or pull janelle
    }
}
add_action( 'save_post', 'my_project_updated_send_email', 10, 3 );

//Redirect users to login screen when not logged in

// add_action('admin_init', 'redirect_login');

// function redirect_login(){
//     if(!is_user_logged_in() && is_page('member_resources')) {
//         wp_redirect('http://localhost:8888');
//         exit;
//     }
// }

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

// Register Custom Post Type - Member Resources
function custom_post_type_discussion() {

    $labels = array(
        'name'                => _x( 'Discussions', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Discussion', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Discussions', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Discussion', 'text_domain' ),
        'all_items'           => __( 'All Discussions', 'text_domain' ),
        'view_item'           => __( 'View Discussions', 'text_domain' ),
        'add_new_item'        => __( 'Add New Discussions', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Discussion', 'text_domain' ),
        'update_item'         => __( 'Update Discussion', 'text_domain' ),
        'search_items'        => __( 'Search Discussions', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'discussions', 'text_domain' ),
        'description'         => __( ' ', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array('comments','title','editor' ),
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
    register_post_type( 'discussions', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_discussion', 0 );


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
    register_taxonomy( 'member_topic', array( 'member_resources', 'discussions' ), $args );

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
 if ($post_slug == '' && $post_slug_ct == " " ): //All posts? No filter
      $args = array(
      'post_type' => 'member_resources',
      'posts_per_page' => -1,
      'post_status' => 'publish'
      
      );
elseif ($post_slug != '' && $post_slug_ct != ''): //Using the filter - both filters have been used
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
 elseif ($post_slug != '' && $post_slug_ct == ''  ): //Using the filter - Topic filter used
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
elseif ($post_slug_ct != '' && $post_slug == ''  ): //Using the filter - Content filter used
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
                $curated = get_field('curated', $post->ID); 

                $date = get_the_date('m.d.y');
                $directory = get_bloginfo('template_directory');

                if ($curated == 'true'){
                        //$directory = bloginfo('template_directory');
                        $target ='<img src="'. $directory .'/assets/img/curated.png">';

                }else{
                        $target="";
                    } 

                $member_topics= get_the_terms($post->ID, 'member_topic');
                //var_dump($member_topics);
                $content_types= get_the_terms($post->ID, 'content_type');

                $short_title = get_the_title('', '', false);
                $shortened_title = substr($short_title, 0, 73);
                $length  =  strlen($short_title);
                
                if ($length >= 73){
                    $overflow = "overflow";

                }else{
                    $overflow="";
                }

                foreach ($member_topics as $member_topic){
                    $mt = $member_topic->name;
                    $ms = $member_topic->slug;
                    //var_dump($mt);
                    //$mt_filter .= $member_topic->slug . ' ';
                }
                foreach ($content_types as $content_type){
                    $ct = $content_type->name;
                    $cs = $content_type->slug;
                    //$ct_filter .= $content_type->slug . ' ';
                }

          //endif; 
          echo '<div class="member-resource-item '. $ms . ' ' . $cs . '">
                    <div class="row">
                        <div class="one columns alpha the-date">' . $date .'</div>
                            <div class="seven columns the-title ' . $overflow .'">
                                <a href="' . $mr_link .'">
                                    <div class="orange_text"> '. $shortened_title . '</div>
                                </a>
                            </div>
                        <div class="two columns">
                            <div class="m-topic">' . $mt . '</div>
                        </div>
                        <div class="two columns omega">
                            <div class="c-type">.' . $ct . '</div>
                        </div>
                    </div>
                </div>';
         endwhile; 
       else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
        
        echo '<article class="post-error">
                <h3 class="404">
                  Your search did not produce any results!</br>
                
                  Please use a different search term, or try something more specific.
                </h3>
              </article>';
       endif; // OK, I think that takes care of both scenarios (having posts or not having any posts) 
       die();//if this isn't included, you will get funky characters at the end of your query results.
}

//AJAX Discussion

add_action('wp_ajax_get_discussions', 'get_discussions');  
add_action('wp_ajax_nopriv_get_discussions', 'get_discussions'); 

function get_discussions(){
  $post_slug = $_POST['discussionListing'];
  //$post_slug_ct = $_POST['contentType'];
  $query = $_POST['query']; //*
  //var_dump($post_slug);
  //$query = $_POST('query');
 
if ($query == ''): //if the search filter is used

 //Make the search exlusive to entries or clicking the filter
 if ($post_slug == '' ): //All posts? No filter
      $args = array(
      'post_type' => 'discussions',
      'posts_per_page' => -1,
      'post_status' => 'publish'
      
      );

 elseif ($post_slug != ''  ): //Using the filter - Topic filter used
      $args = array(
      'post_type' => 'discussions',
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
 endif; //end sub if


else:  //If the search is used
      $args = array(
      'post_type' => 'discussions',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      's' => $query
      //
          
         // ),
        //),
      );
endif;
        // the query
      
        $the_query_d = new WP_Query( $args ); 
        //var_dump($args);
        $count = $the_query_d->found_posts;
        

       if ( $the_query_d->have_posts() ) : 
      // Do we have any posts in the databse that match our query?
      // In the case of the home page, this will call for the most recent posts 
      
        //echo '<div class="container '.$profile_class .'" id="project-gallery">';
         while ( $the_query_d->have_posts() ) : $the_query_d->the_post(); //We set up $the_query on line 144
        // If we have some posts to show, start a loop that will display each one the same way
        
        
         //if (have_rows ('project_gallery')): //Setup the panels between the top/bottom panels
               //Setup variables
               
                $the_title = get_the_title();
                $dt_link = get_the_permalink();
                
                $target = '';
                $curated = get_field('curated', $post->ID); 

                $date = get_the_date('m.d.y');
                $directory = get_bloginfo('template_directory');

                if ($curated == 'true'){
                        //$directory = bloginfo('template_directory');
                        $target ='<img src="'. $directory .'/assets/img/curated.png">';

                }else{
                        $target="";
                    } 

                $discussion_topics = get_the_terms($post->ID, 'member_topic');
                //var_dump($discussion_topics);
                //var_dump($member_topics);
                //$content_types= get_the_terms($post->ID, 'content_type');

                $short_title = get_the_title('', '', false);
                $shortened_title = substr($short_title, 0, 110);
                $length  =  strlen($short_title);
                
                if ($length >= 110){
                    $overflow = "overflow";

                }else{
                    $overflow="";
                }

                foreach ($discussion_topics as $discussion_topic){
                    $dt = $discussion_topic->name;
                    $ds = $discussion_topic->slug;
                    //var_dump($mt);
                    //$mt_filter .= $member_topic->slug . ' ';
                }
                foreach ($content_types as $content_type){
                    //$ct = $content_type->slug;
                    //$ct_filter .= $content_type->slug . ' ';
                }

          //endif; 
          echo '<div class="discussion-item '. $ds . ' ' . $ds . '">
                    <div class="row">
                        <div class="one columns alpha the-date">' . $date .'</div>
                            <div class="eight columns the-title ' . $overflow .'">
                                <a href="' . $dt_link .'">
                                    <div class="orange_text"> '. $shortened_title . '</div>
                                </a>
                            </div><!-- end the-title -->
                        <div class="three columns">
                            <div class="m-topic">' . $dt . '</div>
                        </div> <!--end three columns -->
                        </div>
                    </div>
                </div>';
         endwhile; 
       else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
        
        echo '<article class="post-error">
                <h3 class="404">
                  Your search did not produce any results!</br>
                
                  Please use a different search term, or try something more specific.
                </h3>
              </article>';
       endif; // OK, I think that takes care of both scenarios (having posts or not having any posts) 
       die();//if this isn't included, you will get funky characters at the end of your query results.
}

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

   <div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
        <div class="row">
            <div class="comment-column-meta">
            <div class="comment-author vcard">
         <?php //echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
 
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s, %2$s'), get_comment_date('m.d.y'),  get_comment_time()) ?></a>
                <?php edit_comment_link(__('(Edit)'),'  ','') ?>
            </div>
        </div>
            <div class="comment-column-content">
                <?php comment_text() ?> 
 
            <div class="reply">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        </div>
      </div>
     </div>

<?php
        }



?>
