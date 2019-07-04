<?php
/*
Extension Name: Title Block
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
			'crum_title' => array(
				'name'          => esc_html__( 'Title', 'seosight' ),
				'description'   => esc_html__( 'Title and subtitle text for module description', 'seosight' ),
				'icon'          => 'kc-icon-title',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'live_editor'   => $live_tmpl . 'crum_title.tpl',
				'params'        => array(
					'general' => array(
						array(
							'name'        => 'post_title',
							'label'       => esc_html__( 'Use Post Title?', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Use the title of current post/page as content element instead of text input value.', 'seosight' )
						),
						array(
							'name'        => 'title',
							'label'       => esc_html__( 'Title', 'seosight' ),
							'type'        => 'text',
							'value'       => 'The Title',
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'post_title',
								'hide_when' => 'yes'
							)
						),
						array(
							'name'        => 'type',
							'label'       => esc_html__( 'Title Tag', 'seosight' ),
							'type'        => 'select',
							'admin_label' => true,
							'options'     => array(
								'h1'   => 'H1',
								'h2'   => 'H2',
								'h3'   => 'H3',
								'h4'   => 'H4',
								'h5'   => 'H5',
								'h6'   => 'H6',
								'div'  => 'div',
								'span' => 'Span',
								'p'    => 'P'
							)
						),
						array(
							'name'        => 'el_class',
							'label'       => esc_html__( 'Tag class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'Add class name for title tag only', 'seosight' )
						),
						array(
							'name'        => 'inline_link',
							'label'       => esc_html__( 'Add inline link?', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Additional text with link on one line with title text', 'seosight' )
						),
						array(
							'name'        => 'title_link',
							'label'       => esc_html__( 'Add Link', 'seosight' ),
							'type'        => 'link',
							'description' => esc_html__( 'Add link with title text', 'seosight' ),
							'relation'    => array(
								'parent'    => 'inline_link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'title_delim',
							'label'       => esc_html__( 'Title Decoration', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Visual decoration lines below title text', 'seosight' )
						),
						array(
							'name'        => 'subtitle',
							'label'       => esc_html__( 'Subtitle', 'seosight' ),
							'type'        => 'text',
							'value'       => '',
							'admin_label' => true,
						),
						array(
							'type'        => 'radio',
							'name'        => 'align',
							'label'       => esc_html__( 'Content align', 'seosight' ),
							'description' => esc_html__( 'The horizontal alignment of elements', 'seosight' ),
							'options'     => array(
								'align-left'   => esc_html__( 'Left', 'seosight' ),
								'align-center' => esc_html__( 'Centered', 'seosight' ),
								'align-right'  => esc_html__( 'Right', 'seosight' ),
							),
							'value'       => 'align-center',
							'relation'    => array(
								'parent'    => 'inline_link',
								'hide_when' => 'yes'
							)
						),
						array(
							'name'        => 'class',
							'label'       => esc_html__( 'Extra class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
						),
					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                              => "any,1024,999,767,479",
									esc_html__( 'Title', 'seosight' )      => array(
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
											'property' => 'line-height',
											'label'    => 'Line height',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'letter-spacing',
											'label'    => 'Letter Spacing',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.heading-title'
										),
									),
									esc_html__( 'Subtitle', 'seosight' )   => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'opacity',
											'label'    => 'Opacity',
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
											'property' => 'line-height',
											'label'    => 'Line height',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'letter-spacing',
											'label'    => 'Letter Spacing',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.heading-text'
										),
									),
									esc_html__( 'Decoration', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.heading-decoration'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin'
										),
									),
									esc_html__( 'Box Style', 'seosight' )  => array(
										array(
											'property' => 'text-align',
											'label'    => 'Align'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin'
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