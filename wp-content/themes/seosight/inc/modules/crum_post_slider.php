<?php
/*
Extension Name: Post + Portfolio items Slider
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
			'crum_post_slider' => array(
				'name'          => esc_html__( 'Post / Portfolio Carousel', 'seosight' ),
				'description'   => esc_html__( 'Slider with posts / portfolio items', 'seosight' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-post-slider',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Blog Posts', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'seosight' ),
							'name'        => 'layout',
							'admin_label' => false,
							'options'     => array(
								'post'      => $images_path . 'post-carousel.png',
								'portfolio' => $images_path . 'portfolio-corousel.png'
							),
							'value'       => 'post'
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Show date', 'seosight' ),
							'name'        => 'show_date',
							'description' => esc_html__( 'Show the post publish date.', 'seosight' ),
							'relation'    => array(
								'parent'    => 'layout',
								'show_when' => 'post'
							)
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Show author?', 'seosight' ),
							'name'        => 'show_author',
							'description' => esc_html__( 'Author name and avatar block', 'seosight' ),
							'relation'    => array(
								'parent'    => 'layout',
								'show_when' => 'post'
							)
						),
						array(
							'name'        => 'number_of_items',
							'label'       => esc_html__( 'Items per page', 'seosight' ),
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 1,
								'max'        => 10,
								'show_input' => true
							),
							'value'       => '3',
							'description' => 'Number of items displayed on one screen',
						),
						array(
							'name'        => 'dots',
							'label'       => esc_html__( 'Show Dots', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Pagination dots', 'seosight' ),
							'value'       => 'yes'
						),
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Dots position', 'seosight' ),
							'name'        => 'dots_position',
							'description' => esc_html__( 'Placement of slide pagination dots', 'seosight' ),
							'options'     => array(
								'bottom' => esc_html__( 'Bottom', 'seosight' ),
								'top'    => esc_html__( 'Top', 'seosight' ),
							),
							'relation'    => array(
								'parent'    => 'dots',
								'show_when' => 'yes'
							)
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
					'query'   => array(
						array(
							'type'        => 'post_taxonomy',
							'label'       => esc_html__( 'Content Type', 'seosight' ),
							'name'        => 'post_taxonomy',
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
								'max' => 20
							)
						),
					),
				)
			),
		)
	);
}