<?php
/*
 * Autopopulate Gravity Forms into select field
 *
 * @see https://github.com/DannyvanHolten/acf-gravityforms-add-on/blob/ec793debf47fc40f8c3dadfd5d1d999cfd0b594a/resources/FieldForV4.php
 */

//namespace ACFGravityformsField;

use GFFormsModel;

function acf_load_gravity_form_choices( $field ) {

    // reset choices
    $field['choices'] = array();
	$forms = array();

	if (class_exists('GFFormsModel')) {
		$forms = GFFormsModel::get_forms();
	}

	foreach ($forms as $form) {
		$field['choices'][$form->id] = $form->title;
	}

    // return the field
    return $field;

}

add_filter('acf/load_field/name=gravity_form_select', 'acf_load_gravity_form_choices');
