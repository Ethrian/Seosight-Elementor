<?php
/*
Extension Name: Icon with contact info
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
			'crum_contacts' => array(
				'name'          => esc_html__( 'Address block', 'seosight' ),
				'description'   => esc_html__( 'Block used on contacts page for contacts.', 'seosight' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-contacts',
				'wrapper_class' => 'clearfix',
				//'live_editor'   => $live_tmpl . 'crum_contacts.tpl',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'name'  => 'image',
							'label' => esc_html__( 'Image', 'seosight' ),
							'type'  => 'attach_image',
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Title', 'seosight' ),
							'name'        => 'title',
							'admin_label' => true,
							'value'       => 'Country, Some City',
							'description' => esc_html__( 'Enter title for block', 'seosight' )
						),
						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Text Link', 'seosight' ),
							'name'        => 'link',
							'description' => esc_html__( 'Add link to title text.', 'seosight' ),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Subitle', 'seosight' ),
							'name'        => 'subtitle',
							'value'       => 'Some street address',
							'description' => esc_html__( 'Enter subtitle for block', 'seosight' )
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
									'screens'                             => "any,1024,999,767,479",
									esc_html__( 'Box style', 'seosight' ) => array(
										array( 'property' => 'margin', 'label' => 'Margin', ),
										array( 'property' => 'padding', 'label' => 'Padding', ),
									),
									esc_html__( 'Title', 'seosight' )     => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.content .title'
										),
										array(
											'property' => 'color',
											'label'    => 'Color on Hover',
											'selector' => '.content .title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.content .title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.content .title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.content .title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.content .title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.content .title'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.content .title'
										),

									),
									esc_html__( 'Subtitle', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'color',
											'label'    => 'Color on Hover',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.content .sub-title'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Align',
											'selector' => '.content .sub-title'
										),
									),
									esc_html__( 'Image box', 'seosight' ) => array(
										array( 'property' => 'width', 'label' => 'Width', 'selector' => '.icon' ),
										array( 'property' => 'height', 'label' => 'Height', 'selector' => '.icon' ),
										array( 'property' => 'border', 'label' => 'Border', 'selector' => '.icon' ),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.icon, .icon img'
										),
										array( 'property' => 'padding', 'label' => 'Padding', 'selector' => '.icon' ),
										array( 'property' => 'margin', 'label' => 'Margin', 'selector' => '.icon' ),

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