<?php
/*
Extension Name: Buttons
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
	// Buttons
		array(
			'crum_chartjs' => array(
				'name'        => esc_html__( 'Chart JS module', 'seosight' ),
				'icon'        => 'kc-icon-pie',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_chartjs.tpl',
				'assets'      =>
					array(
						'scripts' =>
							array(
								'chart-js' => '', // Leave empty to call built-in assets
							),
					),
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'chart_type',
							'label'       => esc_html__( 'Chart type', 'seosight' ),
							'type'        => 'radio_image',
							'description' => '',
							'options'     => array(
								'doughnut'  => $images_path . 'doughnut-chart.png',
								'pie'       => $images_path . 'pie-chart.png',
								'polarArea' => $images_path . 'polar-area-chart.png',
								'line'      => $images_path . 'line-chart.png',
								/*'radar'     => $images_path . 'radar-chart.png',*/
								'bar'       => $images_path . 'bar-chart.png',
							)
						),
						array(
							'name'        => 'hide_labels',
							'label'       => esc_html__( 'Hide Labels ?', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Hide chart legend labels', 'seosight' )
						),
						array(
							'type'    => 'group',
							'label'   => esc_html__( 'Chart options', 'seosight' ),
							'name'    => 'options',
							'options' => array( 'add_text' => esc_html__( 'Add new data', 'seosight' ) ),
							'params'  => array(
								array(
									'type'        => 'text',
									'label'       => esc_html__( 'Label', 'seosight' ),
									'name'        => 'label',
									'description' => esc_html__( 'Enter text used as title of the bar.', 'seosight' ),
									'admin_label' => true,
								),
								array(
									'type'        => 'crum-number',
									'label'       => esc_html__( 'Value', 'seosight' ),
									'name'        => 'value',
									'description' => esc_html__( 'Enter targeted value', 'seosight' ),
									'admin_label' => true,
									'options'     => array(
										'min' => 1,
										'max' => 100,
									),
									'value'       => '80'
								),
								array(
									'type'        => 'color_picker',
									'label'       => esc_html__( 'Color', 'seosight' ),
									'name'        => 'prob_color',
									'description' => esc_html__( 'Customized color.', 'seosight' ),
								),
							),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Wrapper class name', 'seosight' ),
							'name'        => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'seosight' ),
						)
					),
					'styling' => array(
						esc_html__( 'Text', 'seosight' ) => array(
							array(
								'property' => 'color',
								'label'    => 'Color',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'font-family',
								'label'    => 'Font Family',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'font-size',
								'label'    => 'Font Size',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'font-weight',
								'label'    => 'Font Weight',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'line-height',
								'label'    => 'Line Height',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'text-transform',
								'label'    => 'Text Transform',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
						),
					),
					'animate' => array(
						array(
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				)
			),
		)
	);
}