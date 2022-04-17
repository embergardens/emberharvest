<?php
/**
 * Backend functions & cleanup.
 *
 * @package emberharvest
 **/

add_theme_support( 'post-thumbnails' );

// REMOVE MENUS FROM ADMIN.
function remove_menus() {
	// remove_menu_page( 'index.php' ); // Dashboard.
	remove_menu_page( "jetpack" ); // Jetpack.
	remove_menu_page( "edit-comments.php" ); // Comments.
}
add_action("admin_menu", "remove_menus");

function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

// REORDER MENUS IN ADMIN.
function headless_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) return true;

	return array(
		'index.php',
		'edit.php?post_type=page', // Pages.
		'edit.php?post_type=location', // Locations.
		'edit.php', // Posts.
		'separator1', // First separator.

		'upload.php', // Media.
		'admin.php?page=acf-options-global',
		'themes.php', // Appearance.
		'plugins.php', // Plugins.
		'users.php', // Users.
		'separator2', // Second separator.

		'tools.php', // Tools.
		'options-general.php', // Settings.
		'separator-last', // Last separator.
	);
}
add_filter( 'custom_menu_order', 'headless_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'headless_custom_menu_order', 10, 1 );

// DISABLE RSS FEED.
function headless_disable_feed() {
	wp_die(__( 'No feed available, please visit our <a href="' . get_bloginfo("url") . '">homepage</a>!' ) );
}

add_action( 'do_feed', 'headless_disable_feed', 1 );
add_action( 'do_feed_rdf', 'headless_disable_feed', 1 );
add_action( 'do_feed_rss', 'headless_disable_feed', 1 );
add_action( 'do_feed_rss2', 'headless_disable_feed', 1 );
add_action( 'do_feed_atom', 'headless_disable_feed', 1 );
add_action( 'do_feed_rss2_comments', 'headless_disable_feed', 1 );
add_action( 'do_feed_atom_comments', 'headless_disable_feed', 1 );

// INCLUDE ACF FUNCTIONS
require get_template_directory() . '/advanced-custom-fields/acf-functions.php';
require get_template_directory() . '/advanced-custom-fields/gravity-forms-acf.php';

// INCLUDE POST TYPES
require get_template_directory() . '/post-types/locations.php';

/**
 * Register navigation menus uses wp_nav_menu in multiple places.
 */
function emberharvest_menus() {

	$locations = array(
		'primary'    => __( 'Primary Navigation', 'emberharvest' ),
		'social'     => __( 'Social Menu', 'emberharvest' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'emberharvest_menus' );

add_filter( 'graphql_response_headers_to_send', function( $headers ) {
	return array_merge( $headers, [
		'Access-Control-Allow-Origin'  => '*',
		'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
		'Access-Control-Allow-Credentials' => 'true'
	] );
} );
