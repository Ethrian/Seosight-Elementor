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
			'crum_button' => array(
				'name'        => esc_html__( 'Button', 'seosight' ),
				'icon'        => 'kc-icon-button',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'live_editor' => $live_tmpl . 'crum_button.tpl',
				'params'      => array(
					'general' => array(
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Label', 'seosight' ),
							'description' => esc_html__( 'This is the text that appears on your button', 'seosight' ),
							'name'        => 'label',
							'value'       => 'Text Button',
							'admin_label' => true
						),
						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Link', 'seosight' ),
							'name'        => 'link',
							'description' => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'seosight' ),
						),
						array(
							'type'  => 'toggle',
							'name'  => 'show_icon',
							'label' => esc_html__( 'Show Icon?', 'seosight' ),
							'value' => 'no',

						),
						array(
							'type'        => 'icon_picker',
							'name'        => 'icon',
							'label'       => esc_html__( 'Icon', 'seosight' ),
							'value'       => 'fa-leaf',
							'description' => esc_html__( 'Select icon for button', 'seosight' ),
							'relation'    => array(
								'parent'    => 'show_icon',
								'show_when' => 'yes'
							)
						),
						array(
							'type'     => 'dropdown',
							'name'     => 'icon_position',
							'label'    => esc_html__( 'Icon position', 'seosight' ),
							'value'    => 'left',
							'options'  => array(
								'left'  => esc_html__( 'Left', 'seosight' ),
								'right' => esc_html__( 'Right', 'seosight' ),
							),
							'relation' => array(
								'parent'    => 'show_icon',
								'show_when' => 'yes'
							)
						),
						array(
							'type'        => 'radio',
							'name'        => 'align',
							'label'       => esc_html__( 'Horizontal align', 'seosight' ),
							'description' => esc_html__( 'The horizontal alignment of elements', 'seosight' ),
							'options'     => array(
								'none'         => esc_html__( 'Inline', 'seosight' ),
								'align-left'   => esc_html__( 'Left', 'seosight' ),
								'align-center' => esc_html__( 'Centered', 'seosight' ),
								'align-right'  => esc_html__( 'Right', 'seosight' ),
							),
							'value'       => 'none'
						),
						array(
							'name'        => 'onclick',
							'label'       => esc_html__( 'On Click', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'Content of on click attribute for element.', 'seosight' ),
						),
						array(
							'name'        => 'ex_class',
							'label'       => esc_html__( 'Button extra class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'Add class name for a tag.', 'seosight' )
						),
						array(
							'name'        => 'element_id',
							'label'       => esc_html__( 'Button ID attribute', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'Only latin charters must be used', 'seosight' )
						),
						array(
							'name'        => 'el_class',
							'label'       => esc_html__( 'Module additional class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
						)
					),
					'styling' => array(
						array(
							'name'    => 'color',
							'label'   => esc_html__( 'Color', 'seosight' ),
							'type'    => 'select', // or 'short-select'
							'attr'    => array( 'class' => 'colored-options' ),
							'options' => seosight_button_colors(),
							'value'   => 'primary'
						),
						array(
							'name'    => 'size',
							'type'    => 'radio',
							'value'   => 'medium',
							'label'   => esc_html__( 'Button size', 'seosight' ),
							'options' => array(
								'small'  => esc_html__( 'Small', 'seosight' ),
								'medium' => esc_html__( 'Medium', 'seosight' ),
								'large'  => esc_html__( 'Large', 'seosight' ),
							),
							'inline'  => true,
						),
						array(
							'name'        => 'outlined',
							'label'       => esc_html__( 'Outlined button', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Button with border and transparent background', 'seosight' ),
						),
						array(
							'name'        => 'shadow',
							'label'       => esc_html__( 'Drop shadow', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Buttons shadow effect on hover', 'seosight' ),
						),
						array(
							'type'    => 'css',
							'label'   => esc_html__( 'css', 'seosight' ),
							'name'    => 'custom_css',
							'options' => array(
								array(
									'screens'                         => "any,1024,999,767,479",
									'Style'                           => array(
										array(
											'property' => 'color',
											'label'    => 'Text Color',
											'selector' => '.btn'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Text Size',
											'selector' => '.btn'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.btn'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.btn'
										),
										array(
											'property' => 'letter-spacing',
											'label'    => 'Letter Spacing',
											'selector' => '.btn'
										),
										array( 'property' => 'border', 'label' => 'Border', 'selector' => '.btn' ),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.btn'
										),
									),
									esc_html__( 'Icon', 'seosight' )  => array(
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.btn i'
										),
										array(
											'property' => 'padding',
											'label'    => 'Icon Spacing',
											'selector' => '.btn i'
										)
									),
									esc_html__( 'Hover', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Text Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius Hover',
											'selector' => '.btn:hover'
										)
									)
								)
							)
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
