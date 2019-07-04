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
	// Buttons
		array(
			'crum_icon' => array(
				'name'        => 'Icon',
				'description' => esc_html__( 'Display single icon', 'seosight' ),
				'icon'        => 'kc-icon-icon',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_icon.tpl',
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'icon',
							'label'       => esc_html__( 'Select Icon', 'seosight' ),
							'value'       => 'et-layers',
							'description' => esc_html__( 'Choose an icon to display', 'seosight' ),
							'type'        => 'icon_picker',
							'admin_label' => true,
						),
						array(
							'name'        => 'title',
							'label'       => esc_html__( 'Title', 'seosight' ),
							'type'        => 'text',
							'admin_label' => true,
							'description' => esc_html__( 'Enter title (Note: It is located after icon).', 'seosight' )
						),
						array(
							'name'        => 'use_link',
							'label'       => 'Add Link ?',
							'type'        => 'toggle',
							'description' => esc_html__( 'Add a link for icon.', 'seosight' )
						),
						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Link', 'seosight' ),
							'name'        => 'link',
							'description' => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'seosight' ),
							'relation'    => array(
								'parent'    => 'use_link',
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
									"screens"                         => "any,1024,999,767,479",
									esc_html__( 'Icon', 'seosight' )  => array(
										array( 'property' => 'color', 'label' => 'Color', 'selector' => '.icon i' ),
										array(
											'property' => 'color',
											'label'    => 'Hover Color',
											'selector' => '+:hover .icon i'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.icon i'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.icon i'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Alignment',
											'selector' => '.icon'
										),
										array( 'property' => 'width', 'label' => 'Width', 'selector' => '.icon' ),
										array( 'property' => 'height', 'label' => 'Height', 'selector' => '.icon' ),
										array(
											'property' => 'padding',
											'label'    => 'Icon Padding',
											'selector' => '.icon'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background',
											'selector' => '.icon'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border radius',
											'selector' => '.icon'
										)
									),
									esc_html__( 'Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.module-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.module-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.module-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.module-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.module-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.module-title'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Alignment',
											'selector' => '.module-title'
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