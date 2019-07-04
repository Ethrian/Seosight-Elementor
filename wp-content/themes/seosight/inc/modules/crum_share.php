<?php
/*
Extension Name: Share buttons
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
			'crum_share' => array(
				'name'        => __( 'Share Page buttons', 'seosight' ),
				'title'       => __( 'Share Page buttons', 'seosight' ),
				'icon'        => 'kc-icon-multi-icons',
				'category'    => 'Content',
				'description' => __( 'List of icon with link for current page share.', 'seosight' ),
				//'live_editor'	=> $live_tmpl.'crum_share.tpl',
				'params'      => array(
					'general' => array(
						array(
							'type'        => 'text',
							'name'        => 'custom_class',
							'label'       => __( 'Class', 'seosight' ),
							'description' => __( 'Extra CSS class', 'seosight' )
						),
						array(
							'type'        => 'group',
							'label'       => __( 'Icons', 'seosight' ),
							'name'        => 'icons',
							'description' => __( 'Repeat this fields with each item created, Each item corresponding an icon element.', 'seosight' ),
							'options'     => array( 'add_text' => __( 'Add new icon', 'seosight' ) ),
							'params'      => array(
								array(
									'type'        => 'select',
									'label'       => __( 'Share service provider', 'seosight' ),
									'name'        => 'service',
									'options'     => array(
										'twitter'    => 'Twitter',
										'facebook'   => 'Facebook',
										'linkedin'   => 'Linkedin',
										'google-plus' => 'Google+',
										'whatsapp'   => 'Whatsapp',
										'pinterest'  => 'Pinterest',
										'tumblr'     => 'Tumblr',
										'reddit'     => 'Reddit',
										'vk'         => 'VK.com',
									),
									'description' => __( 'Enter text used as title of the icon.', 'seosight' ),
									'admin_label' => true,
								),
								array(
									'name'        => 'color',
									'label'       => __( 'Icon Color', 'seosight' ),
									'type'        => 'color_picker',
									'description' => __( 'The color for this icon. You can set color for all icon from Styling tab.', 'seosight' )
								),
								array(
									'name'        => 'bg_color',
									'label'       => __( 'Icon BG Color', 'seosight' ),
									'type'        => 'color_picker',
									'description' => __( 'The background color for this icon. You can set background color for all icon from Styling tab.', 'seosight' )
								),
							),
						),

					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'Icon Style' => array(
										array( 'property' => 'color', 'label' => 'Icon Color', 'selector' => 'i' ),
										array(
											'property' => 'background-color',
											'label'    => 'Icon BG Color',
											'selector' => 'a'
										),
										array( 'property' => 'font-size', 'label' => 'Icon Size', 'selector' => 'i' ),
										array( 'property' => 'border', 'label' => 'Icon Border', 'selector' => 'a' ),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => 'a'
										),
										array( 'property' => 'padding', 'label' => 'Icon Padding', 'selector' => 'a' ),
										array( 'property' => 'margin-right', 'label' => 'Icon gap', 'selector' => 'a' ),
									),
									'Icon Hover' => array(
										array( 'property' => 'color', 'label' => 'Color', 'selector' => 'a:hover i' ),
										array(
											'property' => 'background-color',
											'label'    => 'BG Color',
											'selector' => 'a:hover'
										),
										array(
											'property' => 'border-color',
											'label'    => 'Border Color',
											'selector' => 'a:hover'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => 'a:hover'
										),
									),
									'Box'        => array(
										array( 'property' => 'text-align', 'label' => 'Icon Align' ),
										array( 'property' => 'padding', 'label' => 'Padding' ),
									)
								),
							),
						),
					),
					'animate' => array(
						array(
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				),
			),
		)
	);
}