<?php
/*
Extension Name: Embedded + Google maps
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

$all_styles    = _seosight_google_map_custom_styles();
$style_options = array();
foreach ( $all_styles as $key => $value ) {
	$style_options[ $key ] = $value[0];
}

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_maps' => array(
				'name'        => esc_html__( 'Maps module', 'seosight' ),
				'description' => esc_html__( 'Show google maps with embed', 'seosight' ),
				'icon'        => 'kc-icon-map',
				'category'    => esc_html__( 'Medias', 'seosight' ),
				'admin_view'  => 'gmaps',
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'random_id',
							'label'       => '',
							'type'        => 'random',
							'description' => '',
						),
						array(
							'name'        => 'google_js',
							'label'       => esc_html__( 'Show JS Google Map', 'seosight' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Extended options section for show javascript google map.', 'seosight' ),
						),
						array(
							'type'        => 'textarea',
							'label'       => esc_html__( 'Map Embed Code', 'seosight' ),
							'name'        => 'map_location',
                            'description' => sprintf( wp_kses( __( 'Go to <a href="%s" target=_blank>Google Maps</a> and search your Location. Click on menu near search text => Share or embed map => Embed map. Next copy iframe to this field', 'seosight' ), array( 'a' => array( 'href' => array() ) ) ), 'https://www.google.com/maps/' ),
							'relation'    => array(
								'parent'    => 'google_js',
								'hide_when' => 'yes'
							)
						),
						array(
							'type'        => 'text',
							'name'        => 'api_key',
							'label'       => esc_html__( 'API KEY for google maps service', 'seosight' ),
                            'description' => sprintf( wp_kses( __( 'Go to <a href="%s">Instruction to create API key</a>', 'seosight' ), array( 'a' => array( 'href' => array() ) ) ), 'https://developers.google.com/maps/documentation/javascript/get-api-key' ),
							'relation'    => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'type'     => 'textarea',
							'label'    => esc_html__( 'Type Address', 'seosight' ),
							'name'     => 'address',
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'map_zoom',
							'label'    => esc_html__( 'Map zoom', 'seosight' ),
							'type'     => 'number_slider',
							'options'  => array(
								'min'        => 1,
								'max'        => 21,
								'show_input' => true
							),
							'value'    => 14,
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							),
                            'description' => esc_html__( 'Work for one address only!', 'seosight' ),
						),
						array(
							'type'     => 'select',
							'name'     => 'map_style',
							'label'    => esc_html__( 'Select map style', 'seosight' ),
							'options'  => $style_options,
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'type'     => 'select',
							'name'     => 'map_type',
							'label'    => esc_html__( 'Map Type', 'seosight' ),
							'options'  => array(
								'roadmap'   => esc_html__( 'Roadmap', 'seosight' ),
								'terrain'   => esc_html__( 'Terrain', 'seosight' ),
								'satellite' => esc_html__( 'Satellite', 'seosight' ),
								'hybrid'    => esc_html__( 'Hybrid', 'seosight' )
							),
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'disable_scrolling',
							'type'        => 'toggle',
							'label'       => esc_html__( 'Disable zoom on scroll', 'seosight' ),
							'description' => esc_html__( 'Prevent the map from zooming when scrolling until clicking on the map', 'seosight' ),
							'relation'    => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'custom_marker',
							'type'        => 'toggle',
							'label'       => esc_html__( 'Custom map marker', 'seosight' ),
							'description' => esc_html__( 'Replace default map marker with custom image', 'seosight' ),
							'relation'    => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'marker',
							'label'    => esc_html__( 'Marker Image', 'seosight' ),
							'desc'     => esc_html__( 'Add marker image', 'seosight' ),
							'type'     => 'attach_image',
							'relation' => array(
								'parent'    => 'custom_marker',
								'show_when' => 'yes'
							)
						),
						array(
							'type'  => 'text',
							'name'  => 'map_height',
							'label' => esc_html__( 'Map Height (px)', 'seosight' ),
							'value' => 350
						),
						array(
							'name'        => 'custom_class',
							'label'       => esc_html__( 'Extra class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
						)
					)
				)
			),
		)
	);
}