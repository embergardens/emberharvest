<?php
/**
 * ACF Functions
 *
 * @package emberharvest
 */

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
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
