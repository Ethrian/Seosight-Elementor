<?php
/*
Extension Name: Team members module
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
			'crum_testimonial_slider' => array(
				'name'          => esc_html__( 'Testimonials Slider', 'seosight' ),
				'title'         => esc_html__( 'Testimonial Slider', 'seosight' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-testimonial-slider',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Display testimonials in slider.', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'seosight' ),
							'name'        => 'layout',
							'admin_label' => true,
							'options'     => array(
								'arrow'                 => $images_path . 'testimonials-1.png',
								'author-top'            => $images_path . 'testimonials-2.png',
								'author-centered'       => $images_path . 'testimonials-3.png',
								'author-centered-round' => $images_path . 'testimonials-4.png',
								'modern'                => $images_path . 'testimonials-6.png',
							),
							'value'       => 'arrow'
						),
						array(
							'name'        => 'number_of_items',
							'label'       => esc_html__( 'Items per page', 'seosight' ),
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 1,
								'max'        => 5,
								'show_input' => true
							),
							'value'       => '1',
							'description' => 'Number of items displayed on one screen',
							'relation'    => array(
								'parent'    => 'layout',
								'show_when' => array( 'arrow' )
							)
						),
						array(
							'name'        => 'arrows',
							'label'       => esc_html__( 'Show Arrows', 'seosight' ),
							'type'        => 'toggle',
							'value'       => 'yes',
							'description' => esc_html__( 'Previous/ Next Slider buttons', 'seosight' ),
							'relation'    => array(
								'parent'    => 'layout',
								'hide_when' => array( 'arrow', 'modern' )
							)
						),
						array(
							'name'        => 'dots',
							'label'       => esc_html__( 'Show Dots', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Pagination dots', 'seosight' ),
							'value'       => 'yes',
						),
						array(
							'name'        => 'autoscroll',
							'label'       => esc_html__( 'Autoslide', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Automatic auto scroll slides', 'seosight' ),
							'value'       => 'no',
						),
						array(
							'name'     => 'time',
							'label'    => esc_html__( 'Delay between scroll', 'seosight' ),
							'type'     => 'number_slider',
							'options'  => array(
								'min'        => 1,
								'max'        => 30,
								'unit'       => 'sec',
								'show_input' => true
							),
							'value'    => '5',
							'relation' => array(
								'parent'    => 'autoscroll',
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
					'items'   => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Slider items', 'seosight' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'seosight' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new slider item', 'seosight' ) ),
							'params'      => array(
								array(
									'type'        => 'text',
									'name'        => 'name',
									'label'       => esc_html__( 'Name', 'seosight' ),
									'value'       => 'Jonathan Simpson',
									'admin_label' => true
								),
								array(
									'name'  => 'position',
									'label' => esc_html__( 'Position', 'seosight' ),
									'type'  => 'text',
									'value' => 'Lead Manager'
								),
								array(
									'type'  => 'textarea',
									'name'  => 'desc',
									'label' => esc_html__( 'Description', 'seosight' ),
								),
								array(
									'name'     => 'image',
									'label'    => esc_html__( 'Photo of author', 'seosight' ),
									'type'     => 'attach_image',
									'relation' => array(
										'parent'    => 'layout',
										'hide_when' => array( 'quote-left' )
									)
								),
								array(
									'name'        => 'author_link',
									'label'       => 'Author link',
									'type'        => 'link',
									'value'       => '#', // remove this if you do not need a default content
									'description' => 'Link to author blog, page, etc.',
								),
								array(
									'name'  => 'stars',
									'label' => 'Stars',

									'type'    => 'number_slider',
									'options' => array(
										'min' => 0,
										'max' => 5,
									),
									'value'   => 0,
								),
                                
							)
						),

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
											'selector' => '.author-name'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.author-name'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.author-name'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.author-name'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.author-name'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.author-name'
										),
									),
									esc_html__( 'Sub Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.author-company'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.author-company'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.author-company'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.author-company'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.author-company'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.author-company'
										),
									),
									esc_html__( 'Text', 'seosight' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.testimonial-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.testimonial-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.testimonial-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.testimonial-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.testimonial-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.testimonial-text'
										),
									),
									esc_html__( 'Box style', 'seosight' ) => array(
										array(
											'property' => 'margin',
											'label'    => 'Margin',
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
										),
									),
									esc_html__( 'Image box', 'seosight' ) => array(
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.testimonial-img-author img'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.testimonial-img-author img'
										),
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.testimonial-img-author'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.testimonial-img-author'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.testimonial-img-author, .testimonial-img-author img'
										),

									),
								)
							)
						)
					),
				)
			),
		)
	);
}