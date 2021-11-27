<?php
/**
 * Custom Post Type - Locations
 *
 * @package emberharvest
 */

function emberharvest_locations() {
	$labels = array(
		'name'               => __( 'Locations', 'emberharvest' ),
		'singular_name'      => __( 'Location', 'emberharvest' ),
		'add_new'            => __( 'Add New', 'emberharvest' ),
		'add_new_item'       => __( 'Add New Location', 'emberharvest' ),
		'edit'               => __( 'Edit', 'emberharvest' ),
		'edit_item'          => __( 'Edit Location', 'emberharvest' ),
		'new_item'           => __( 'New Location', 'emberharvest' ),
		'view'               => __( 'View Location', 'emberharvest' ),
		'view_item'          => __( 'View Location', 'emberharvest' ),
		'search_items'       => __( 'Search Locations', 'emberharvest' ),
		'not_found'          => __( 'No Locations found', 'emberharvest' ),
		'not_found_in_trash' => __( 'No Locations found in Trash', 'emberharvest' ),
		'parent'             => __( 'Parent Location', 'emberharvest' ),
	);
	$args  = array(
		'label'               => __( 'Location', 'emberharvest' ),
		'description'         => __( 'Location', 'emberharvest' ),
		'labels'              => $labels,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'menu_position'       => 1,
		'menu_icon'           => 'dashicons-location-alt',
		'hierarchical'        => true,
		'query_var'           => true,
		'capability_type'     => 'page',
		'supports'            => array( 'title', 'page-attributes', 'thumbnail' ),
		'has_archive'         => true,
		'rewrite'             => array(
			'slug'       => 'locations',
			'with_front' => false,
		),
		'taxonomies'          => array(),
		'can_export'          => true,
		'show_in_graphql'     => true,
		'graphql_single_name' => 'location',
		'graphql_plural_name' => 'locations',
	);
	register_post_type( 'location', $args );

}
add_action( 'init', 'emberharvest_locations' );
