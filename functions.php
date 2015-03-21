<?php
    // Custom "Hotspot" Post Type
    add_action( 'init', 'register_cpt_hotspot' );
    function register_cpt_hotspot() {
        $labels = array( 
            'name' => _x( 'Hotspots', 'hotspot' ),
            'singular_name' => _x( 'Hotspot', 'hotspot' ),
            'add_new' => _x( 'Add New', 'hotspot' ),
            'add_new_item' => _x( 'Add New Hotspot', 'hotspot' ),
            'edit_item' => _x( 'Edit Hotspot', 'hotspot' ),
            'new_item' => _x( 'New Hotspot', 'hotspot' ),
            'view_item' => _x( 'View Hotspot', 'hotspot' ),
            'search_items' => _x( 'Search Hotspots', 'hotspot' ),
            'not_found' => _x( 'No hotspots found', 'hotspot' ),
            'not_found_in_trash' => _x( 'No hotspots found in Trash', 'hotspot' ),
            'parent_item_colon' => _x( 'Parent hotspot:', 'hotspot' ),
            'menu_name' => _x( 'Hotspots', 'hotspot' ),
        );
        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => 'All hotspots and programs for The Mayors Fund',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'taxonomies' => array( 'priorities' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => 'hotspots', 'with_front' => false ),
            'capability_type' => 'page'
        );
        register_post_type( 'hotspot', $args );
    }

    function remove_menus(){
        //remove_menu_page( 'index.php' );                  //Dashboard
        remove_menu_page( 'edit.php' );                   //Posts
        remove_menu_page( 'upload.php' );                 //Media
        //remove_menu_page( 'edit.php?post_type=page' );    //Pages
        remove_menu_page( 'edit-comments.php' );          //Comments
        remove_menu_page( 'themes.php' );                 //Appearance
        //remove_menu_page( 'plugins.php' );                //Plugins
        //remove_menu_page( 'users.php' );                  //Users
        remove_menu_page( 'tools.php' );                  //Tools
        //remove_menu_page( 'options-general.php' );        //Settings
    }
    add_action( 'admin_menu', 'remove_menus' );