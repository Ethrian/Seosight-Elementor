<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {
	wp_enqueue_script(
		'fw-form-helpers',
		get_template_directory_uri() . '/js/fw-form-helpers.js',
		array( 'jquery' ),
		'1.1',
		true
	);
	wp_localize_script( 'fw-form-helpers', 'fwAjaxUrl', admin_url( 'admin-ajax.php', 'relative' ) );
}