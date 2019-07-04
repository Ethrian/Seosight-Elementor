<?php
/*
Extension Name: Portfolio Grid
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
			'crum_portfolio_grid' => array(
				'name'          => esc_html__( 'Portfolio Grid', 'seosight' ),
				'description'   => esc_html__( 'Grid with portfolio designed items', 'seosight' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-portfolio-grid',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Blog Posts', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'post_taxonomy',
							'label'       => esc_html__( 'Content Type', 'seosight' ),
							'name'        => 'post_taxonomy',
							'value'       => 'fw-portfolio',
							'description' => esc_html__( 'Choose supported content type such as post, custom post type, etc.', 'seosight' ),
						),
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Order by', 'seosight' ),
							'name'        => 'order_by',
							'admin_label' => true,
							'options'     => array(
								'ID'            => esc_html__( 'Post ID', 'seosight' ),
								'author'        => esc_html__( 'Author', 'seosight' ),
								'title'         => esc_html__( 'Title', 'seosight' ),
								'name'          => esc_html__( 'Post name (post slug)', 'seosight' ),
								'type'          => esc_html__( 'Post type (available since Version 4.0)', 'seosight' ),
								'date'          => esc_html__( 'Date', 'seosight' ),
								'modified'      => esc_html__( 'Last modified date', 'seosight' ),
								'rand'          => esc_html__( 'Random order', 'seosight' ),
								'comment_count' => esc_html__( 'Number of comments', 'seosight' )
							)
						),
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Order', 'seosight' ),
							'name'        => 'order_list',
							'admin_label' => true,
							'options'     => array(
								'ASC'  => esc_html__( 'ASC', 'seosight' ),
								'DESC' => esc_html__( 'DESC', 'seosight' ),
							)
						),
						array(
							'type'        => 'number_slider',
							'label'       => esc_html__( 'Number of items displayed', 'seosight' ),
							'name'        => 'number_post',
							'description' => esc_html__( 'The number of items you want to show.', 'seosight' ),
							'value'       => '9',
							'admin_label' => true,
							'options'     => array(
								'min' => 1,
								'max' => 30
							)
						),
						array(
							'name'        => 'number_of_items',
							'label'       => esc_html__( 'Items per row', 'seosight' ),
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 1,
								'max'        => 6,
								'show_input' => true
							),
							'value'       => '3',
							'description' => 'Number of items displayed on one row',
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
											'selector' => '.case-item__title'
										),
										array(
											'property' => 'color',
											'label'    => 'Color on Hover',
											'selector' => '.crumina-case-item:hover .case-item__title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.case-item__title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.case-item__title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.case-item__title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.case-item__title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.case-item__title'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.case-item__title'
										),
									),
									esc_html__( 'Text', 'seosight' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
										array(
											'property' => 'color',
											'label'    => 'Color on Hover',
											'selector' => 'crumina-case-item:hover .case-item__cat a'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.crumina-case-item .case-item__cat a'
										),
									),
									esc_html__( 'Image', 'seosight' )     => array(
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.case-item__thumb img'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.case-item__thumb img'
										),
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.case-item__thumb'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.case-item__thumb'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.case-item__thumb, .case-item__thumb img'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.case-item__thumb'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.case-item__thumb'
										),

									),
									esc_html__( 'Box style', 'seosight' ) => array(
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.crumina-case-item'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Color on hover',
											'selector' => '.crumina-case-item:hover'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.crumina-case-item'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.crumina-case-item'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.crumina-case-item'
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