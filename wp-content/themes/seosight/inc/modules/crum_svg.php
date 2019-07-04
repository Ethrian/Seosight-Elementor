<?php
/*
Extension Name: Animated SVG
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
			'crum_svg' => array(
				'name'        => 'Animated SVG',
				'description' => esc_html__( 'Display animated svg image', 'seosight' ),
				'icon'        => 'kc-icon-creative-button',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_svg.tpl',
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'image',
							'label'       => esc_html__( 'Upload Image', 'seosight' ),
							'type'        => 'attach_image',
							'admin_label' => false,
						),
						array(
							'name'        => 'animation',
							'label'       => esc_html__( 'Enable stroke animation', 'seosight' ),
							'type'        => 'toggle',
							'value'       => 'yes',
							'description' => esc_html__( 'Animation of svg line strokes', 'seosight' )
						),
						array(
							'name'        => 'class',
							'label'       => esc_html__( 'Extra class name', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' )
						),

					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									"screens"                               => "any,1024,999,767,479",
									esc_html__( 'Main params', 'seosight' ) => array(
										array(
											'property' => 'width',
											'label'    => 'Width',
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
										),
										array(
											'property' => 'background',
											'label'    => 'Background',
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
										),
									),
								),
							),
						),
					),
					'animate' => array(
						array(
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				),
			),
		)
	);
}