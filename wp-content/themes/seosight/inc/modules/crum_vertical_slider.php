<?php
/*
Extension Name: Vertical slider
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

$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_vertical_slider' => array(
				'name'         => esc_html__( 'Vertical slider', 'seosight' ),
				'title'        => esc_html__( 'Vertical slider', 'seosight' ),
				'icon'         => 'kc-crum-icon kc-crum-icon-vertical-slider',
				'category'     => esc_html__( 'Content', 'seosight' ),
				'nested'       => true,
				'accept_child' => 'kc_row_inner',
				'description'  => esc_html__( 'Slider with blocks scrolled vertically', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_vertical_slider.tpl',
				'params'       => array(
					array(
						'name'    => 'effect',
						'label'   => esc_html__( 'Slide effect', 'seosight' ),
						'type'    => 'select',
						'value'   => 'slide',
						'options' => array(
							'slide'     => esc_html__( 'Slide', 'seosight' ),
							'fade'      => esc_html__( 'Fade', 'seosight' ),
							'cube'      => esc_html__( 'Cube', 'seosight' ),
							'coverflow' => esc_html__( 'Coverflow', 'seosight' ),
							'flip'      => esc_html__( 'Flip', 'seosight' ),
						),
					),
					array(
						'name'        => 'loop',
						'label'       => esc_html__( 'Loop slides', 'seosight' ),
						'type'        => 'toggle',
						'description' => esc_html__( 'Enable continuous loop mode', 'seosight' ),
						'value'       => 'no',
					),
					array(
						'name'        => 'autoscroll',
						'label'       => esc_html__( 'Autoslide', 'seosight' ),
						'type'        => 'toggle',
						'description' => esc_html__( 'Automatic auto scroll slides', 'seosight' ),
						'value'       => 'no',
					),
					array(
						'name'     => 'time',
						'label'    => esc_html__( 'Delay between scroll', 'seosight' ),
						'type'     => 'number_slider',
						'options'  => array(
							'min'        => 1,
							'max'        => 30,
							'unit'       => 'sec',
							'show_input' => true
						),
						'value'    => '5',
						'relation' => array(
							'parent'    => 'autoscroll',
							'show_when' => 'yes'
						)
					),
					array(
						'name'        => 'el_class',
						'label'       => esc_html__( 'Extra class', 'seosight' ),
						'type'        => 'text',
						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
					),
				)
			),
		)
	);
}