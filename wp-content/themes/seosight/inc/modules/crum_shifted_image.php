<?php
/*
Extension Name: Shifted Image module
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
			'crum_shifted_image' => array(
				'name'          => esc_html__( 'Shifted image', 'seosight' ),
				'category'      => esc_html__( 'Content', 'seosight' ),
				'wrapper_class' => 'clearfix',
				'icon'          => 'kc-crum-icon kc-crum-icon-shifted-image',
				'params'        => array(
					'general' => array(
						array(
							'name'        => 'image',
							'label'       => esc_html__( 'Upload Image', 'seosight' ),
							'type'        => 'attach_image',
							'admin_label' => false,

						),
						array(
							'name'        => 'title',
							'label'       => esc_html__( 'Title', 'seosight' ),
							'type'        => 'text',
							'admin_label' => true,
							'description' => esc_html__( 'Enter title (Note: It is located above the content).', 'seosight' )
						),
						array(
							'type'        => 'editor',
							'name'        => 'desc',
							'label'       => esc_html__( 'Text', 'seosight' ),
							'admin_label' => false,
						),
						array(
							'type'        => 'radio',
							'name'        => 'direction',
							'label'       => esc_html__( 'Content align', 'seosight' ),
							'description' => esc_html__( 'The horizontal alignment of elements', 'seosight' ),
							'options'     => array(
								'leftimage'  => esc_html__( 'Image on Left', 'seosight' ),
								'rightimage' => esc_html__( 'Image on Right', 'seosight' ),
							),
							'value'       => 'leftimage'
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
									'screens'                         => "any,1024,999,767,479",
									esc_html__( 'Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.heading-title'
										),
									),
									esc_html__( 'Text', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.product-description-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.product-description-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.product-description-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.product-description-text'
										),
									),
									esc_html__( 'Image', 'seosight' ) => array(
										array(
											'property' => 'box-shadow',
											'label'    => 'Box Shadow',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'max-width',
											'label'    => 'Max Width',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.product-description-thumb img'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.product-description-thumb img'
										)
									),
									esc_html__( 'Box', 'seosight' )   => array(
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.product-description-border'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.product-description-border'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.product-description-border'
										),
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