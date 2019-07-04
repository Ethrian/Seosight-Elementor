<?php
/*
Extension Name: Pricing table
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
			'pricing_table' => array(
				'name'         => esc_html__( 'Pricing table', 'seosight' ),
				'title'        => esc_html__( 'Pricing table Wrapper', 'seosight' ),
				'icon'         => 'kc-icon-pricing',
				'category'     => esc_html__( 'Content', 'seosight' ),
				'nested'       => true,
				'accept_child' => 'pricing_box',
				'description'  => esc_html__( 'Visually merge elements into one section', 'seosight' ),
				'params'       => array(
					array(
						'name'    => 'columns',
						'label'   => esc_html__( 'Number of columns', 'seosight' ),
						'type'    => 'number_slider',
						'options' => array(
							'min'        => 1,
							'max'        => 6,
							'show_input' => true
						),
						'value'   => 3,
					),
					array(
						'name'        => 'wrap_class',
						'label'       => esc_html__( 'Extra class', 'seosight' ),
						'type'        => 'text',
						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
					)
				)
			),
			'pricing_box'   => array(
				'name'          => esc_html__( 'Pricing Box', 'seosight' ),
				'title'         => esc_html__( 'Pricing Settings', 'seosight' ),
				'icon'          => 'kc-icon-pricing',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'wrapper_class' => 'clearfix',
				'params'        => array(
					'general' => array(
						array(
							'name'        => 'layout',
							'label'       => esc_html__( 'Select layout', 'seosight' ),
							'type'        => 'radio_image',
							'options'     => array(
								'classic' => $images_path . 'pricing-1.png',
								'head'    => $images_path . 'pricing-2.png',
								'colored' => $images_path . 'pricing-3.png',
							),
							'value'       => 'classic',
							'description' => esc_html__( 'Select format of module', 'seosight' ),
						),
						array(
							'name'    => 'show_icon',
							'label'   => esc_html__( 'Show Icon In Header', 'seosight' ),
							'type'    => 'select',
							'options' => array(
								'no'    => esc_html__( 'No Icon', 'seosight' ),
								'image' => esc_html__( 'Image', 'seosight' ),
								'icon'  => esc_html__( 'Icon', 'seosight' ),
							),
						),
						array(
							'name'     => 'image_header',
							'label'    => esc_html__( 'Image', 'seosight' ),
							'type'     => 'attach_media',
							'relation' => array(
								'parent'    => 'show_icon',
								'show_when' => 'image'
							)
						),
						array(
							'name'        => 'icon_header',
							'label'       => esc_html__( 'Select Icon', 'seosight' ),
							'value'       => 'sl-cloud-upload',
							'description' => esc_html__( 'Choose an icon to display', 'seosight' ),
							'type'        => 'icon_picker',
							'relation'    => array(
								'parent'    => 'show_icon',
								'show_when' => 'icon'
							)
						),
						array(
							'type'        => 'text',
							'name'        => 'title',
							'label'       => esc_html__( 'Label', 'seosight' ),
							'value'       => 'Text Title',
							'admin_label' => true
						),
						array(
							'type'        => 'textarea',
							'name'        => 'desc',
							'label'       => esc_html__( 'Attributes', 'seosight' ),
							'description' => wp_kses( __( 'Insert tag &lt;strong&gt; when you want highlight text.<br> Example: &lt;strong&gt;<strong>24/7</strong>&lt;/strong&gt; Support', 'seosight' ), array(
								'br',
								'strong'
							) ),
						),
						array(
							'name'  => 'price',
							'label' => esc_html__( 'Price', 'seosight' ),
							'type'  => 'text',
							'value' => '99'
						),
						array(
							'name'  => 'currency',
							'label' => esc_html__( 'Currency', 'seosight' ),
							'type'  => 'text',
							'value' => '$'
						),
						array(
							'name'        => 'show_on_top',
							'label'       => esc_html__( 'Price Format', 'seosight' ),
							'description' => wp_kses( __( 'Price format default <strong>$99</strong>.<br> When turn on price format <strong>99$</strong>', 'seosight' ), array(
								'br',
								'strong'
							) ),
							'type'        => 'toggle',
							'value'       => 'no'
						),
						array(
							'name'  => 'duration',
							'label' => esc_html__( 'Per', 'seosight' ),
							'type'  => 'text',
							'value' => '/month'
						),
						array(
							'name'  => 'show_button',
							'label' => esc_html__( 'Display Button', 'seosight' ),
							'type'  => 'toggle',
							'value' => 'yes'
						),
						array(
							'name'     => 'button_text',
							'label'    => esc_html__( 'Text Button', 'seosight' ),
							'type'     => 'text',
							'value'    => 'Purchase',
							'relation' => array(
								'parent'    => 'show_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'button_link',
							'label'    => esc_html__( 'Link', 'seosight' ),
							'type'     => 'link',
							'value'    => '#',
							'relation' => array(
								'parent'    => 'show_button',
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
							'name'        => 'primary_color',
							'label'       => esc_html__( 'Background Color', 'seosight' ),
							'type'        => 'color_picker',
							'description' => esc_html__( 'Primary elements color', 'seosight' ),

						),
						array(
							'name'  => 'highlight',
							'label' => esc_html__( 'Always zoomed', 'seosight' ),
							'type'  => 'toggle',
							'value' => 'no'
						),
						array(
							'name'     => 'hover_zoom',
							'label'    => esc_html__( 'Zoom on hover', 'seosight' ),
							'type'     => 'toggle',
							'value'    => 'no',
							'relation' => array(
								'parent'    => 'highlight',
								'hide_when' => 'yes'
							)
						),
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                          => "any,1024,999,767,479",
									esc_html__( 'Icon', 'seosight' )   => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pricing-tables-icon i'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.pricing-tables-icon i'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.pricing-tables-icon'
										),
									),
									esc_html__( 'Title', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'color',
											'label'    => 'Color Hover',
											'selector' => '+:hover .pricing-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.pricing-title'
										),
									),
									esc_html__( 'Text', 'seosight' )   => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pricing-tables-position'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pricing-tables-position'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pricing-tables-position'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pricing-tables-position'
										),
									),
									esc_html__( 'Price', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.rate'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.rate'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.rate'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.rate'
										),
									),
									esc_html__( 'Button', 'seosight' ) => array(
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
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.btn'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.btn'
										),
										array(
											'property' => 'color',
											'label'    => 'Hover Text Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Hover Background Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border',
											'label'    => 'Hover Border',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'HoverBorder Radius Hover',
											'selector' => '.btn:hover'
										)
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