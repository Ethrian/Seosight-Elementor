<?php
/*
Extension Name: Icon with text
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
			'crum_promo_block' => array(
				'name'          => esc_html__( 'Promo Block', 'seosight' ),
				'description'   => esc_html__( 'Colored Block with image and text', 'seosight' ),
				'icon'          => 'kc-icon-box',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'name'  => 'image',
							'label' => esc_html__( 'Image', 'seosight' ),
							'type'  => 'attach_image',
						),
						array(
							'name'        => 'image_hover',
							'label'       => esc_html__( 'Image on hover', 'seosight' ),
							'type'        => 'attach_image',
							'description' => esc_html__( 'Use only if you want to show different image on block hover', 'seosight' )
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Title', 'seosight' ),
							'name'        => 'title',
							'admin_label' => true,
							'value'       => 'Tell Us About Your Project',
							'description' => esc_html__( 'Enter title for block.', 'seosight' )
						),
						array(
							'type'  => 'textarea',
							'name'  => 'desc',
							'label' => esc_html__( 'Description', 'seosight' ),
						),

						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Button URL (Link)', 'seosight' ),
							'name'        => 'link',
							'description' => esc_html__( 'Add link to button.', 'seosight' ),
							'relation'    => array(
								'parent'    => 'show_link',
								'show_when' => 'yes'
							)
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Show Button', 'seosight' ),
							'name'        => 'link_button',
							'description' => esc_html__( 'Display link as button.', 'seosight' ),
							'value'       => 'yes'
						),
						array(
							'name'     => 'btn_color',
							'label'    => esc_html__( 'Color', 'seosight' ),
							'type'     => 'select', // or 'short-select'
							'options'  => seosight_button_colors(),
							'relation' => array(
								'parent'    => 'link_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'btn_size',
							'type'     => 'radio',
							'value'    => 'medium',
							'label'    => esc_html__( 'Button size', 'seosight' ),
							'options'  => array(
								'small'  => esc_html__( 'Small', 'seosight' ),
								'medium' => esc_html__( 'Medium', 'seosight' ),
								'large'  => esc_html__( 'Large', 'seosight' ),
							),
							'inline'   => true,
							'relation' => array(
								'parent'    => 'link_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'outlined',
							'label'       => esc_html__( 'Outlined button', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Button with border and transparent background', 'seosight' ),
							'relation'    => array(
								'parent'    => 'link_button',
								'show_when' => 'yes'
							)
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Custom class', 'seosight' ),
							'name'        => 'custom_class',
							'description' => esc_html__( 'Enter extra custom class', 'seosight' )
						)
					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens' => "any,1024,999,767,479",

									esc_html__( 'Title', 'seosight' )     => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.servises-title'
										),
										array(
											'property' => 'color',
											'label'    => 'Color on Hover',
											'selector' => '+:hover .servises-title, +:hover .promo-link'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.servises-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.servises-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.servises-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.servises-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.servises-title'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.servises-title'
										),
									),
									esc_html__( 'Text', 'seosight' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.servises-text, .promo-link'
										),
										array(
											'property' => 'color',
											'label'    => 'Color on Hover',
											'selector' => '+:hover .servises-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.servises-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.servises-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.servises-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.servises-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.servises-text'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.servises-text'
										),
									),
									esc_html__( 'Image', 'seosight' )     => array(
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.servises-item__thumb img'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.servises-item__thumb img'
										),
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.servises-item__thumb'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.servises-item__thumb'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.servises-item__thumb, .servises-item__thumb img'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.servises-item__thumb'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.servises-item__thumb'
										),

									),
									esc_html__( 'Box style', 'seosight' ) => array(
										array( 'property' => 'background-color', 'label' => 'Background Color' ),
										array(
											'property' => 'background-color',
											'label'    => 'Color on hover',
											'selector' => '+:hover'
										),
										array( 'property' => 'text-align', 'label' => 'Text Align' ),
										array( 'property' => 'margin', 'label' => 'Margin', ),
										array( 'property' => 'padding', 'label' => 'Padding', ),
									),
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