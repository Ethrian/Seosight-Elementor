<?php
/*
Extension Name: Call To Action
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
			'crum_call_to_action' => array(
				'name'          => esc_html__( 'Call To Action', 'seosight' ),
				'title'         => esc_html__( 'Title, subtitle and button link', 'seosight' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-call-to-action-v2',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Display call to action styles.', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'seosight' ),
							'name'        => 'layout',
							'admin_label' => false,
							'options'     => array(
								'standard' => $images_path . 'call-to-action-2.png',
								'center'   => $images_path . 'call-to-action-1.png',
							),
							'value'       => 'standard'
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Title', 'seosight' ),
							'name'        => 'title',
							'admin_label' => true,
							'value'       => 'Tell Us About Your Project',
							'description' => esc_html__( 'Enter title for form.', 'seosight' )
						),
						array(
							'type'  => 'textarea',
							'name'  => 'desc',
							'label' => esc_html__( 'Description', 'seosight' ),
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Show Button', 'seosight' ),
							'name'        => 'show_link',
							'description' => esc_html__( 'Display button in form.', 'seosight' ),
							'value'       => 'yes'
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
							'name'     => 'btn_color',
							'label'    => esc_html__( 'Color', 'seosight' ),
							'type'     => 'select', // or 'short-select'
							'options'  => seosight_button_colors(),
							'relation' => array(
								'parent'    => 'link',
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
								'parent'    => 'link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'outlined',
							'label'       => esc_html__( 'Outlined button', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Button with border and transparent background', 'seosight' ),
							'relation'    => array(
								'parent'    => 'link',
								'show_when' => 'yes'
							)
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
									'screens'                             => "any,1024,999,767,479",
									esc_html__( 'Title', 'seosight' )     => array(
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
									esc_html__( 'Sub Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.heading-text'
										),
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