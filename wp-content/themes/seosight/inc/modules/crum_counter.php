<?php
/*
Extension Name: Animated counters
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
			'crum_counter' => array(
				'name'        => esc_html__( 'Counter Box', 'seosight' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-counter-box',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_counter.tpl',
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'layout',
							'label'       => esc_html__( 'Select layout', 'seosight' ),
							'type'        => 'radio_image',
							'options'     => array(
								'default' => $images_path . 'counter-on.png',
								'modern'  => $images_path . 'counter-top.png',
							),
							'value'       => 'default',
							'description' => esc_html__( 'Select format of module', 'seosight' ),
						),
						array(
							'type'        => 'toggle',
							'name'        => 'icon_show',
							'label'       => esc_html__( 'Display Icon', 'seosight' ),
							'description' => esc_html__( 'Display icon in box counter', 'seosight' )
						),
						array(
							'type'        => 'icon_picker',
							'label'       => esc_html__( 'Select Icon', 'seosight' ),
							'value'       => 'et-puzzle',
							'description' => esc_html__( 'Choose an icon to display', 'seosight' ),
							'name'        => 'icon',
							'relation'    => array(
								'parent'    => 'icon_show',
								'show_when' => array( 'yes' )
							)
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Targeted number', 'seosight' ),
							'name'        => 'number',
							'description' => esc_html__( 'The targeted number to count up to (From zero).', 'seosight' ),
							'admin_label' => true,
							'value'       => '100'
						),
						array(
							'type'        => 'text',
							'name'        => 'units',
							'label'       => esc_html__( 'Units', 'seosight' ),
							'description' => esc_html__( 'Type unit near counter numbers ( % , + , etc. )', 'seosight' )
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Label', 'seosight' ),
							'name'        => 'label',
							'description' => esc_html__( 'The text description of the counter.', 'seosight' ),
							'admin_label' => true,
							'value'       => 'Percent number'
						),
						array(
							'type'        => 'toggle',
							'name'        => 'line_show',
							'label'       => esc_html__( 'Title underline', 'seosight' ),
							'description' => esc_html__( 'Underline Title Text', 'seosight' )
						),
						array(
							'name'        => 'wrap_class',
							'label'       => esc_html__( 'Extra class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
						)
					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                             => "any,1024,999,767,479",
									esc_html__( 'Text', 'seosight' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.counter-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.counter-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.counter-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.counter-title'
										),
									),
									esc_html__( 'Number', 'seosight' )    => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.counter-numbers'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.counter-numbers'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.counter-numbers'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.counter-numbers'
										),
									),
									esc_html__( 'Icon', 'seosight' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color Icon ',
											'selector' => '.element-icon i'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Size Icon',
											'selector' => '.element-icon i'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.element-icon'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.element-icon'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.element-icon'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.element-icon'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.element-icon'
										),
									),
									esc_html__( 'Delimiter', 'seosight' ) => array(
										array(
											'property' => 'background-color',
											'label'    => 'Color',
											'selector' => '.counter-line *'
										),
									),
									esc_html__( 'Box Style', 'seosight' ) => array(
										array( 'property' => 'text-align', 'label' => 'Text Align' ),
										array( 'property' => 'padding', 'label' => 'Padding' ),
										array( 'property' => 'margin', 'label' => 'Margin' ),
									)
								)
							)
						)
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