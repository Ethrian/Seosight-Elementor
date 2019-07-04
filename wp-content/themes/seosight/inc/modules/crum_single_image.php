<?php
/*
Extension Name: Image module
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
			'crum_single_image' => array(
				'name'             => esc_html__( 'Single image', 'seosight' ),
				'title'            => esc_html__( 'Single image', 'seosight' ),
				'icon'             => 'kc-icon-image',
				'category'         => esc_html__( 'Medias', 'seosight' ),
				'admin_view'       => 'image',
				'live_editor'      => $live_tmpl . 'crum_single_image.tpl',
				'preview_editable' => true,
				'params'           => array(
					'general' => array(
						array(
							'name'        => 'image_source',
							'label'       => esc_html__( 'Image Source', 'seosight' ),
							'type'        => 'select',
							'options'     => array(
								'media_library'  => esc_html__( 'Media library', 'seosight' ),
								'external_link'  => esc_html__( 'External link', 'seosight' ),
								'featured_image' => esc_html__( 'Featured Image', 'seosight' ),
							),
							'description' => esc_html__( 'Select image source.', 'seosight' )
						),
						array(
							'name'        => 'image',
							'label'       => esc_html__( 'Upload Image', 'seosight' ),
							'type'        => 'attach_image',
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'image_source',
								'show_when' => 'media_library'
							)
						),
						array(
							'name'        => 'image_external_link',
							'label'       => esc_html__( 'Link', 'seosight' ),
							'type'        => 'text',
							'relation'    => array(
								'parent'    => 'image_source',
								'show_when' => 'external_link'
							),
							'description' => esc_html__( 'Enter external link.', 'seosight' )
						),
						array(
							'name'        => 'image_size',
							'label'       => esc_html__( 'Size', 'seosight' ),
							'type'        => 'text',
							'relation'    => array(
								'parent'    => 'image_source',
								'show_when' => array( 'media_library', 'featured_image' )
							),
							'description' => esc_html__( 'Set the image size: "thumbnail", "medium", "large", "full" or "400x200"', 'seosight' ),
							'value'       => 'full'
						),
						array(
							'name'        => 'image_size_el',
							'label'       => esc_html__( 'Size', 'seosight' ),
							'type'        => 'text',
							'relation'    => array(
								'parent'    => 'image_source',
								'show_when' => 'external_link'
							),
							'description' => esc_html__( 'Enter the image size in pixels. Example: 200x100 (Width x Height).', 'seosight' )
						),
						array(
							'name'        => 'alt',
							'label'       => esc_html__( 'Alt', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'Enter the image alt property.', 'seosight' )
						),
						array(
							'name'        => 'caption',
							'label'       => esc_html__( 'Caption', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'Enter the image caption text.', 'seosight' )
						),
						array(
							'type'        => 'radio',
							'name'        => 'align',
							'label'       => esc_html__( 'Align', 'seosight' ),
							'description' => esc_html__( 'The horizontal alignment of elements', 'seosight' ),
							'options'     => array(
								'alignleft'   => esc_html__( 'Left', 'seosight' ),
								'aligncenter' => esc_html__( 'Centered', 'seosight' ),
								'alignright'  => esc_html__( 'Right', 'seosight' ),
							),
							'value'       => 'aligncenter'
						),
						array(
							'name'        => 'on_click_action',
							'label'       => esc_html__( 'On click event', 'seosight' ),
							'type'        => 'select',
							'options'     => array(
								''                 => esc_html__( 'None', 'seosight' ),
								'op_large_image'   => esc_html__( 'Link to large image', 'seosight' ),
								'lightbox'         => esc_html__( 'Open Image In Lightbox', 'seosight' ),
								'open_custom_link' => esc_html__( 'Open Custom Link', 'seosight' )
							),
							'description' => esc_html__( 'Select the click event when users click on the image.', 'seosight' )
						),
						array(
							'name'        => 'custom_link',
							'label'       => esc_html__( 'Custom Link', 'seosight' ),
							'type'        => 'link',
							'value'       => '#',
							'relation'    => array(
								'parent'    => 'on_click_action',
								'show_when' => 'open_custom_link'
							),
							'description' => esc_html__( 'The URL which image assigned to. You can select page/post or other post type', 'seosight' )
						),
						array(
							'name'        => 'class',
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
									'screens'                                 => "any,1024,999,767,479",
									esc_html__( 'Element style', 'seosight' ) => array(
										array(
											'property' => 'box-shadow',
											'label'    => 'Box Shadow',
											'selector' => 'img'
										),
										array( 'property' => 'border', 'label' => 'Border', 'selector' => 'img' ),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => 'img'
										),
										array( 'property' => 'width', 'label' => 'Width', 'selector' => 'img' ),
										array( 'property' => 'height', 'label' => 'Height', 'selector' => 'img' ),
										array(
											'property' => 'max-width',
											'label'    => 'Max Width',
											'selector' => 'img'
										),
										array( 'property' => 'margin', 'label' => 'Margin', 'selector' => 'img' ),
										array( 'property' => 'padding', 'label' => 'Padding', 'selector' => 'img' )
									),
									esc_html__( 'Text style', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.wp-caption-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.wp-caption-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.wp-caption-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.wp-caption-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.wp-caption-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.wp-caption-text'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.wp-caption-text'
										),
									),
									esc_html__( 'Box', 'seosight' )        => array(
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
											'selector' => 'img'
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