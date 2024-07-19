<?php

/**
 * Events post type and taxonomies.
 *
 * @package RebelliousDigitalEvents
 */

class RebelliousDigitalEventsCPT {

    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ), 0 );
    }

    /**
     * Register custom post type.
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x( 'Events', 'Post Type General Name', 'rd-events' ),
            'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'rd-events' ),
            'menu_name'             => __( 'Events', 'rd-events' ),
            'name_admin_bar'        => __( 'Event', 'rd-events' ),
            'archives'              => __( 'Event Archives', 'rd-events' ),
            'attributes'            => __( 'Event Attributes', 'rd-events' ),
            'parent_item_colon'     => __( 'Parent Event:', 'rd-events' ),
            'all_items'             => __( 'All Events', 'rd-events' ),
            'add_new_item'          => __( 'Add New Event', 'rd-events' ),
            'add_new'               => __( 'Add New', 'rd-events' ),
            'new_item'              => __( 'New Event', 'rd-events' ),
            'edit_item'             => __( 'Edit Event', 'rd-events' ),
            'update_item'           => __( 'Update Event', 'rd-events' ),
            'view_item'             => __( 'View Event', 'rd-events' ),
            'view_items'            => __( 'View Events', 'rd-events' ),
            'search_items'          => __( 'Search Events', 'rd-events' ),
            'not_found'             => __( 'Not found', 'rd-events' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'rd-events' ),
            'items_list'            => __( 'Events list', 'rd-events' ),
            'items_list_navigation' => __( 'Events list navigation', 'rd-events' ),
            'filter_items_list'     => __( 'Filter Events list', 'rd-events' ),
        );

        $args = array(
            'label'                 => __( 'Events', 'rd-events' ),
            'description'           => __( 'Events', 'rd-events' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'revisions', 'excerpt', 'thumbnail' ),
            'hierarchical'          => false,
            'menu_icon'             => 'dashicons-calendar',
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 10,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
            'rewrite'               => array( 'slug' => 'events' ),
        );
        register_post_type( 'events', $args );
    }
}

new RebelliousDigitalEventsCPT();