<?php
/*
Extension Name: Text with dropcap Letter
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

$live_tmpl = get_template_directory() . '/kingcomposer/live_editor/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_dropcaps' => array(
				'name'        => esc_html__( 'Dropcaps', 'seosight' ),
				'title'       => 'Dropcaps Settings',
				'icon'        => 'kc-icon-dropcaps',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_dropcaps.tpl',
				'description' => esc_html__( 'Display dropcaps styles.', 'seosight' ),
				'params'      => array(
					'general' => array(
						array(
							'type'        => 'editor',
							'name'        => 'desc',
							'label'       => esc_html__( 'Text Paragraph', 'seosight' ),
							'admin_label' => true,
						),
						array(
							'name'    => 'style',
							'label'   => esc_html__( 'Base dropcap style', 'seosight' ),
							'type'    => 'radio',
							'options' => array(
								'squared'    => esc_html__( 'Square', 'seosight' ),
								'dark-round' => esc_html__( 'Rounded', 'seosight' ),
								'primary'    => esc_html__( 'Simple', 'seosight' ),
							),
							'value'   => 'squared',
						),
						array(
							'name'        => 'custom_class',
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
									'screens'  => "any,1024,999,767,479",
									'Dropcaps' => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.dropcaps-text'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.dropcaps-text'
										)
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