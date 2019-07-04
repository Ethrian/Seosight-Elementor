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
			'crum_team' => array(
				'name'          => esc_html__( 'Team member', 'seosight' ),
				'title'         => esc_html__( 'Team member', 'seosight' ),
				'icon'          => 'kc-icon-team',
				'category'      => esc_html__( 'Content', 'seosight' ),
				'wrapper_class' => 'clearfix',
				'live_editor'   => $live_tmpl . 'crum_team.tpl',
				'description'   => esc_html__( 'Member photo with social links', 'seosight' ),
				'params'        => array(
					'general' => array(
						array(
							'name'  => 'image',
							'label' => esc_html__( 'Avatar Image', 'seosight' ),
							'type'  => 'attach_image'
						),
						array(
							'type'        => 'select',
							'label'       => esc_html__( 'Image Size', 'seosight' ),
							'name'        => 'img_size',
							'value'       => 'full',
							'description' => esc_html__( 'Set the image size: "full", "thumbnail", "medium", "large" or other size ', 'seosight' ),
							'options'     => array(
								'full'      => esc_html__( 'Full Size', 'seosight' ),
								'thumbnail' => esc_html__( 'Thumbnail', 'seosight' ),
								'medium'    => esc_html__( 'Medium', 'seosight' ),
								'large'     => esc_html__( 'Large', 'seosight' ),
							)
						),
						array(
							'type'        => 'text',
							'name'        => 'title',
							'label'       => esc_html__( 'Name', 'seosight' ),
							'value'       => 'Your Name',
							'admin_label' => true
						),
						array(
							'name'  => 'subtitle',
							'label' => esc_html__( 'Subtitle', 'seosight' ),
							'type'  => 'text',
							'value' => 'Manager'
						),
						array(
							'name'  => 'link',
							'label' => esc_html__( 'Custom Link', 'seosight' ),
							'type'  => 'link',
							'value' => '',
						),
						array(
							'type'   => 'group',
							'label'  => esc_html__( 'Social networks', 'seosight' ),
							'name'   => 'social_networks',
							esc_html__( 'Links for your social networks profiles', 'seosight' ),
							'params' => array(
								array(
									'type'  => 'text',
									'label' => esc_html__( 'Link to profile', 'seosight' ),
									'name'  => 'link',
								),
								array(
									'name'        => 'icon',
									'label'       => esc_html__( 'Select Icon', 'seosight' ),
									'type'        => 'select',
									'options'     => seosight_social_network_icons(),
									'description' => esc_html__( 'Choose an icon to display', 'seosight' ),
								)
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
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                         => "any,1024,999,767,479",
									esc_html__( 'Image', 'seosight' ) => array(
										array(
											'property' => 'box-shadow',
											'label'    => 'Box Shadow',
											'selector' => '.module-image'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.module-image'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.module-image, .module-image img'
										),
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.module-image'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.module-image'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.module-image'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.module-image'
										)
									),
									esc_html__( 'Title', 'seosight' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.teammembers-item-name'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.teammembers-item-name'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.teammembers-item-name'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.teammembers-item-name'
										),

									),
									esc_html__( 'Text', 'seosight' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.teammembers-item-prof'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.teammembers-item-prof'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.teammembers-item-prof'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.teammembers-item-prof'
										),
									),
									esc_html__( 'Box', 'seosight' )   => array(
										array( 'property' => 'box-shadow', 'label' => 'Box Shadow' ),
										array( 'property' => 'border', 'label' => 'Border' ),
										array( 'property' => 'border-radius', 'label' => 'Border Radius' ),
										array( 'property' => 'margin', 'label' => 'Margin' ),
										array( 'property' => 'padding', 'label' => 'Padding' )
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