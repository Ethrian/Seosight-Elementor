<?php
/*
Extension Name: Timeline slider
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
			'crum_timeline_slider' => array(
				'name'     => esc_html__( 'Timeline Slider', 'seosight' ),
				'icon'     => 'kc-crum-icon kc-crum-icon-timeline-slider',
				'category' => esc_html__( 'Content', 'seosight' ),
				'assets'   => array(
					'scripts' => array( 'seosight-timeline' => '' ),
				),
				'params'   => array(
					'general' => array(
						array(
							'name'        => 'type',
							'label'       => esc_html__( 'Timeline position', 'seosight' ),
							'type'        => 'radio_image',
							'options'     => array(
								'top'    => $images_path . 'timeline-top.png',
								'bottom' => $images_path . 'timeline-bottom.png',
							),
							'value'       => 'top',
							'description' => esc_html__( 'Position of timeline slider', 'seosight' ),
						),
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Options', 'seosight' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding timeline element.', 'seosight' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new item', 'seosight' ) ),
							'params'      => array(
								array(
									'type'        => 'text',
									'label'       => esc_html__( 'Title', 'seosight' ),
									'name'        => 'title',
									'description' => esc_html__( 'Enter text used as title of the item.', 'seosight' ),
									'admin_label' => true,
								),
								array(
									'type'        => 'editor',
									'name'        => 'desc',
									'label'       => esc_html__( 'Text', 'seosight' ),
									'admin_label' => false,
								),
								array(
									'name'        => 'pointdate',
									'label'       => esc_html__( 'Date', 'seosight' ),
									'type'        => 'crum_date_picker',
									'description' => esc_html__( 'Choose date to display on slider in format (day/month/year). Ex: 16/12/1985', 'seosight' ),
								),
								array(
									'name'        => 'image',
									'label'       => esc_html__( 'Upload Image', 'seosight' ),
									'type'        => 'attach_image',
									'admin_label' => false,
								),
							),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Wrapper class name', 'seosight' ),
							'name'        => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'seosight' ),
						)
					),
					'styling' => array(
						array(
							'type'    => 'css',
							'label'   => esc_html__( 'css', 'seosight' ),
							'name'    => 'custom_css',
							'options' => array(
								array(
									'screens'                         => "any,1024,999,767,479",
									esc_html__( 'Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.time-line-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.time-line-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.time-line-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.time-line-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.time-line-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.time-line-title'
										),
									),
									esc_html__( 'Text', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.time-line-content'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.time-line-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.time-line-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.time-line-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.time-line-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.time-line-text'
										),
									),
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