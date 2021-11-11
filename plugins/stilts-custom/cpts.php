<?php
  // Custom Post Types


  /*
   *  Custom Post Types (wp slug):
   *    #Resources (resources)
   *    #Events (events)
   *    #Toolkits (toolkits)
   *    #Press (press)
   * 
   * 
   *  Custom Taxonomies:
   *    Resource Type (resource-type)
   */



  #Resources
  function create_RESOURCES_posttype(){

    $labels = array(
      'name'                  => 'Resources',
      'singular_name'         => 'Resource',
      'add_new'               => 'Add New Resource',
      'add_new_item'          => 'Add New Resource',
      'edit_item'             => 'Edit Resource',
      'new_item'              => 'New Resource',
      'view_item'             => 'View Resource',
      'view_items'            => 'View Resources',
      'search_items'          => 'Search Resources',
      'not_found'             => 'No Resources Found',
      'not_found_in_trash'    => 'No Resources Found in Trash',
      'all_items'             => 'All Resources',
      'archives'              => 'Resource Archives',
      'attributes'            => 'Resource Attributes',
      'insert_into_item'      => 'Insert into Resource',
      'uploaded_to_this_item' => 'Uploaded to this Resource',
      'item_published'        => 'Resource Published',
      'item_published_privately' => 'Resource published privately',
      'item_reverted_to_draft'   => 'Resource reverted to draft',
      'item_updated'          => 'Update Resource'
    );

    $args = array(
      'labels'              => $labels,
      'description'         => 'Resources',
      'public'              => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'show_ui'             => true,
      'show_in_nav_menus'   => true,
      'show_in_menu'        => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 6, //After 'Posts'
      'menu_icon'			      => 'dashicons-admin-page',
      'hierarchical'        => false,
      'supports'            => array( 
                                'title', 
                                'thumbnail', 
                                'custom-fields'),
      'can_export'          => true,
      'capability_type'     => 'post',
      'taxonomies'          => array( 'resource-types', 'resource-audiences' ),
      'has_archive'         => false,
      'rewrite'             => array('slug' => 'resources'),
      'query_var'           => true,
      'show_in_rest'        => true
    );

    register_post_type('resources', $args);
  }


 
  function create_RESOURCE_TYPES_taxonomy() {
  
    $labels = array(
      'name' => _x( 'Resource Types', 'taxonomy general name' ),
      'singular_name' => _x( 'Resource Type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Resource Types' ),
      'popular_items' => __( 'Popular Resource Types' ),
      'all_items' => __( 'All Resource Types' ),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __( 'Edit Resource Type' ), 
      'update_item' => __( 'Update Resource Type' ),
      'add_new_item' => __( 'Add New Resource Type' ),
      'new_item_name' => __( 'New Resource Type Name' ),
      'separate_items_with_commas' => __( 'Separate Resource Types with commas' ),
      'add_or_remove_items' => __( 'Add or remove Resource Types' ),
      'choose_from_most_used' => __( 'Choose from the most used Resource Types' ),
      'menu_name' => __( 'Resource Types' ),
    ); 
  
    register_taxonomy('resource-types','resources',array(
      'hierarchical' => false,
      'labels' => $labels,
      'show_ui' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'resource-types' ),
    ));
  }

  function create_RESOURCE_AUDIENCES_taxonomy() {
  
    $labels = array(
      'name' => _x( 'Resource Audiences', 'taxonomy general name' ),
      'singular_name' => _x( 'Resource Audience', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Resource Audiences' ),
      'popular_items' => __( 'Popular Resource Audiences' ),
      'all_items' => __( 'All Resource Audiences' ),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __( 'Edit Resource Audience' ), 
      'update_item' => __( 'Update Resource Audience' ),
      'add_new_item' => __( 'Add New Resource Audience' ),
      'new_item_name' => __( 'New Resource Audience Name' ),
      'separate_items_with_commas' => __( 'Separate Resource Audiences with commas' ),
      'add_or_remove_items' => __( 'Add or remove Resource Audiences' ),
      'choose_from_most_used' => __( 'Choose from the most used Resource Audiences' ),
      'menu_name' => __( 'Resource Audiences' ),
    ); 
  
    register_taxonomy('resource-audiences','resources',array(
      'hierarchical' => false,
      'labels' => $labels,
      'show_ui' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'resource-audiences' ),
    ));
  }

  function cpts_rewrite_flush() {
    create_RESOURCES_posttype();
    flush_rewrite_rules();
  }

  function stilts_create_custom_post_types(){
    create_RESOURCES_posttype();
    flush_rewrite_rules();
  }

  add_action('init', 'stilts_create_custom_post_types');
  add_action( 'init', 'create_RESOURCE_TYPES_taxonomy', 0 );
  add_action( 'init', 'create_RESOURCE_AUDIENCES_taxonomy', 0 );

  register_activation_hook( __FILE__, 'cpts_rewrite_flush' );

?>