<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
if (!function_exists('seosight_modify_es_widget_scripts')){
	function seosight_modify_es_widget_scripts(){

		wp_dequeue_style('es-widget-css');
		wp_dequeue_script( 'es-widget' );
		wp_dequeue_script( 'es-widget-page' );

		wp_enqueue_script( 'seosight-widget-page', get_template_directory_uri() . '/js/es-widget-page.js', array(), false, true );
		$es_select_params = array(
			'es_error_title'    => _x( 'Error', 'widget-page-enhanced-select', 'seosight' ),
			'es_success_title'    => _x( 'Success', 'widget-page-enhanced-select', 'seosight' ),
			'es_email_notice'    => _x( 'Please enter email address', 'widget-page-enhanced-select', 'seosight' ),
			'es_incorrect_email' => _x( 'Please provide a valid email address', 'widget-page-enhanced-select', 'seosight' ),
			'es_load_more'       => _x( 'loading...', 'widget-page-enhanced-select', 'seosight' ),
			'es_ajax_error'      => _x( 'Cannot create XMLHTTP instance', 'widget-page-enhanced-select', 'seosight' ),
			'es_success_message' => _x( 'Successfully Subscribed.', 'widget-page-enhanced-select', 'seosight' ),
			'es_success_notice'  => _x( 'Your subscription was successful! Within a few minutes, kindly check the mail in your mailbox and confirm your subscription. If you can\'t see the mail in your mailbox, please check your spam folder.', 'widget-page-enhanced-select', 'seosight' ),
			'es_email_exists'    => _x( 'Email Address already exists!', 'widget-page-enhanced-select', 'seosight' ),
			'es_error'           => _x( 'Oops.. Unexpected error occurred.', 'widget-page-enhanced-select', 'seosight' ),
			'es_invalid_email'   => _x( 'Invalid email address', 'widget-page-enhanced-select', 'seosight' ),
			'es_try_later'       => _x( 'Please try after some time', 'widget-page-enhanced-select', 'seosight' ),
			'es_problem_request' => _x( 'There was a problem with the request', 'widget-page-enhanced-select', 'seosight' )
		);
		wp_localize_script( 'seosight-widget-page', 'es_widget_page_notices', $es_select_params );

	}
}
//add_action('wp_enqueue_scripts','seosight_modify_es_widget_scripts');