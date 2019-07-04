<?php
/*
Extension Name: Animated pie chart
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
			'crum_pie_chart' => array(
				'name'          => esc_html__( 'Pie Chart', 'seosight' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-piechart',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'wrapper_class' => 'clearfix',
				'live_editor'   => $live_tmpl . 'crum_pie_chart.tpl',
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'number_slider',
							'label'       => esc_html__( 'Percent number', 'seosight' ),
							'name'        => 'percent',
							'description' => esc_html__( 'Drag slider to select the percentage number displayed.', 'seosight' ),
							'admin_label' => true,
							'value'       => '50',
							'options'     => array(
								'unit'       => '%',
								'show_input' => true
							)
						),
						array(
							'name'        => 'icon_option',
							'label'       => esc_html__( 'Use Icon ?', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Display an icon instead the number', 'seosight' ),
						),
						array(
							'name'        => 'icon',
							'label'       => esc_html__( 'Select Icon', 'seosight' ),
							'type'        => 'icon_picker',
							'value'       => 'et-layers',
							'description' => esc_html__( 'Choose an icon to display', 'seosight' ),
							'relation'    => array(
								'parent'    => 'icon_option',
								'show_when' => 'yes'
							)
						),
						array(
							'type'  => 'text',
							'label' => esc_html__( 'Title', 'seosight' ),
							'name'  => 'title',
						),
						array(
							'type'  => 'textarea',
							'label' => esc_html__( 'Description', 'seosight' ),
							'name'  => 'description',
						),
						array(
							'name'        => 'link',
							'label'       => esc_html__( 'Link', 'seosight' ),
							'type'        => 'link',
							'value'       => '|Read More|_self',
							'description' => esc_html__( 'Additional link after description', 'seosight' ),
						),

						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Wrapper class name', 'seosight' ),
							'name'        => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'seosight' ),
						),
					),
					'styling' => array(
						array(
							'type'        => 'color_picker',
							'label'       => esc_html__( 'Circle Color start', 'seosight' ),
							'name'        => 'startcolor',
							'description' => esc_html__( 'Color of the circle bar gradient', 'seosight' ),
							'value'       => '#3b8d8c'
						),
						array(
							'type'        => 'color_picker',
							'label'       => esc_html__( 'Circle Color finish', 'seosight' ),
							'name'        => 'endcolor',
							'description' => esc_html__( 'Color of the circle bar gradient', 'seosight' ),
							'value'       => '#4cc3c1'
						),
						array(
							'type'    => 'css',
							'name'    => 'custom_css',
							'options' => array(
								array(
									'screens'                         => "any,1024,999,767,479",
									esc_html__( 'Value', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pie-chart .content'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pie-chart .content'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pie-chart .content'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pie-chart .content'
										),
									),
									esc_html__( 'Icon', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color Icon ',
											'selector' => '.pie-chart .icon'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Size Icon',
											'selector' => '.pie-chart .icon'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.pie-chart .icon'
										),
									),
									esc_html__( 'Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pie-chart-content-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pie-chart-content-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pie-chart-content-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pie-chart-content-title'
										),

									),
									esc_html__( 'Text', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pie-chart-content-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pie-chart-content-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pie-chart-content-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pie-chart-content-text'
										),
									),
								)
							),
						),
					),
				)
			),
		)
	);
}