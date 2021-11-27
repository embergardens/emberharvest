<?php
/**
 * Backend functions & cleanup.
 *
 * @package emberharvest
 **/

add_theme_support( 'post-thumbnails' );

// ADD ACF OPTIONS PAGE.
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'Site Options',
			'menu_title' => 'Options',
			'menu_slug'  => 'site-options',
			'capability' => 'edit_posts',
			'redirect'   => true,
			'position'   => '1',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Global Options',
			'menu_title'  => 'Global',
			'parent_slug' => 'site-options',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Navigation Options',
			'menu_title'  => 'Navigation',
			'parent_slug' => 'site-options',
		)
	);

}

// REMOVE MENUS FROM ADMIN.
function remove_menus() {
	// remove_menu_page( 'index.php' ); // Dashboard.
	remove_menu_page( "jetpack" ); // Jetpack.
	remove_menu_page( "edit-comments.php" ); // Comments.
}
add_action("admin_menu", "remove_menus");

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

// Return `null` if an empty value is returned from ACF.
if (!function_exists("acf_nullify_empty")) {
	function acf_nullify_empty($value, $post_id, $field)
	{
		if (empty($value)) {
			return null;
		}
		return $value;
	}
}
add_filter( 'acf/format_value', 'acf_nullify_empty', 100, 3 );

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
