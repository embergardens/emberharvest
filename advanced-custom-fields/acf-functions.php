<?php
/**
 * ACF Functions
 *
 * @package emberharvest
 */

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

// ADD ACF OPTIONS PAGE.
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'      => 'Site Options',
			'menu_title'      => 'Options',
			'menu_slug'       => 'site-options',
			'capability'      => 'edit_posts',
			'redirect'        => true,
			'position'        => '1',
			'show_in_graphql' => true,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'      => 'Global Options',
			'menu_title'      => 'Global',
			'parent_slug'     => 'site-options',
			'show_in_graphql' => true,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'      => 'Navigation Options',
			'menu_title'      => 'Navigation',
			'parent_slug'     => 'site-options',
			'show_in_graphql' => true,
		)
	);

}

/*
 * Create new WYSIWYG toolbar option in Advanced Custom Fields.
 *
 * @see https://www.advancedcustomfields.com/resources/customize-the-wysiwyg-toolbars/
 */
function harvest_simple_toolbar($toolbars) {

	$toolbars['Simple'] = array();
	$toolbars['Simple'][1] = array('bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'bullist', 'numlist');

	$toolbars['Very Simple'] = array();
	$toolbars['Very Simple'][1] = array('bold', 'italic', 'underline');

	$toolbars['Widget'] = array();
	$toolbars['Widget'][1] = array('bold', 'italic', 'link', 'unlink');

	// return $toolbars - IMPORTANT!
	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'harvest_simple_toolbar');

// Return value and label to select, radio and checkboxes
// function locations_select_return_array( $value, $field, $root, $id ) {
// 	if ( $field['key'] == 'locations__state' ) {
// 		return $field['choices'][$value];
// 	}
// 	return $value;
// }
// add_filter( 'graphql_acf_field_value', 'locations_select_return_array', 10, 4 );
