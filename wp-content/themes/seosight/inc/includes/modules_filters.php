<?php
/*
Extension Name: Filters that run on specific shortcode values.
Extension Preview: -
Description:
Version: 1.0
Author: Crumina
Author URI: https://wpcode.pro/
*/


if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

// Live editor template for row shortcode.

add_filter( 'kc_add_map', 'crumina_custom_live_shortcode_filter', 0 /*priority index*/, 2 /*number of params*/ );

function crumina_custom_live_shortcode_filter( $atts, $base ) {

	$live_tmpl = get_template_directory() . '/kingcomposer/live_editor/';
	if ( $base == 'kc_row' ) {
		$atts['live_editor'] = $live_tmpl . 'crum_row.php';
	}

	return $atts; // required

}

add_filter( 'shortcode_kc_row', 'crumina_row_animation_filter', 99 );

// This filter will run before wp_header

function crumina_row_animation_filter( $atts ) {
	if ( ! empty( $atts['row_animation'] ) ) {
		wp_enqueue_script( 'scrollmagic-velocity' );
	}
}
