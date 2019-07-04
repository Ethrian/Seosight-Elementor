<?php
/*
Extension Name: Video module
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
			'crum_video' => array(
				'name'     => esc_html__( 'Video Player', 'seosight' ),
				'icon'     => 'kc-icon-play',
				'category' => esc_html__( 'Medias', 'seosight' ),
				//'live_editor' => $live_tmpl . 'crum_video.tpl',
				'params'   => array(
					'general' => array(
						array(
							'name'        => 'type',
							'label'       => esc_html__( 'Type of player', 'seosight' ),
							'type'        => 'radio_image',
							'options'     => array(
								'button' => $images_path . 'video-button.png',
								'player' => $images_path . 'video-player.png',
							),
							'value'       => 'button',
							'description' => esc_html__( 'Select format of displayed video', 'seosight' ),
						),
						array(
							'type'  => 'attach_media',
							'name'  => 'placeholder',
							'label' => esc_html__( 'Placeholder Image', 'seosight' ),
							'desc'  => esc_html__( 'Please select placeholder image', 'seosight' ),
						),
						array(
							'type'        => 'select',
							'name'        => 'source',
							'label'       => esc_html__( 'Source', 'seosight' ),
							'description' => esc_html__( 'Choose source of video', 'seosight' ),
							'options'     => array(
								'oembed' => esc_html__( 'Youtube / Vimeo', 'seosight' ),
								'self'   => esc_html__( 'Self hosted', 'seosight' ),
							)
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Video Link', 'seosight' ),
							'name'        => 'video_link',
							'description' => esc_html__( 'Insert Video URL to embed this video', 'seosight' ),
							'admin_label' => true,
							'value'       => 'https://www.youtube.com/watch?v=iNJdPyoqt8U',
							'relation'    => array(
								'parent'    => 'source',
								'show_when' => 'oembed'
							)
						),
						array(
							'type'        => 'attach_media',
							'label'       => esc_html__( 'Link to mp4 video', 'seosight' ),
							'name'        => 'mp4',
							'description' => esc_html__( 'Source of uploaded video', 'seosight' ),
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'source',
								'show_when' => 'self'
							)
						),
						array(
							'type'        => 'attach_media',
							'label'       => esc_html__( 'Link to webm video', 'seosight' ),
							'name'        => 'webm',
							'description' => esc_html__( 'Source of uploaded video', 'seosight' ),
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'source',
								'show_when' => 'self'
							)
						),
						array(
							'type'        => 'attach_media',
							'label'       => esc_html__( 'Link to ogg video', 'seosight' ),
							'name'        => 'ogg',
							'description' => esc_html__( 'Source of uploaded video', 'seosight' ),
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'source',
								'show_when' => 'self'
							)
						),
						array(
							'type'     => 'select',
							'name'     => 'full_bg',
							'label'    => esc_html__( 'Background size', 'seosight' ),
							'options'  => array(
								'full'  => esc_html__( 'Same as parent column', 'seosight' ),
								'image' => esc_html__( 'Same as placeholder image', 'seosight' ),
							),
							'relation' => array(
								'parent'    => 'type',
								'show_when' => 'button'
							)
						),
						array(
							'type'        => 'toggle',
							'name'        => 'full_width',
							'label'       => esc_html__( 'Video Fullwidth', 'seosight' ),
							'description' => esc_html__( 'Stretch the video to fit the content width.', 'seosight' ),
							'relation'    => array(
								'parent'    => 'type',
								'hide_when' => 'button'
							)
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Video Width', 'seosight' ),
							'name'        => 'video_width',
							'description' => esc_html__( 'Set the width of the video. the height will be prorated = width*1.77', 'seosight' ),
							'value'       => 600,
							'relation'    => array(
								'parent'    => 'full_width',
								'hide_when' => 'yes'
							)
						),
						array(
							'type'        => 'toggle',
							'name'        => 'auto_play',
							'label'       => esc_html__( 'Auto Play', 'seosight' ),
							'description' => esc_html__( 'The video automatically plays when site loaded.', 'seosight' ),
						),
						array(
							'name'        => 'wrap_class',
							'label'       => esc_html__( 'Extra class', 'seosight' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
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