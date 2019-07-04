<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'stunning-show' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'value' => array(
				'label'        => esc_html__( 'Show stunning header?', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
				'desc'         => esc_html__( 'Panel after header will be shown/hidden from frontend', 'seosight' ),
			)
		),
		'choices' => array(
			'yes'  => array(
				'custom-title' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Custom title text', 'seosight' ),
				),
				'padding-top'    => array(
					'type'  => 'text',
					'value' => '125px',
					'label' => esc_html__( 'Padding from Top', 'seosight' ),
				),
				'padding-bottom' => array(
					'type'  => 'text',
					'value' => '125px',
					'label' => esc_html__( 'Padding from Bottom', 'seosight' ),
				),
                'stunning_bg_type'          => array(
                    'type'    => 'multi-picker',
                    'label'   => false,
                    'desc'    => false,
                    'picker'  => array(
                        'selected' => array(
                            'label'   => false,
                            'desc'    => esc_html__( 'Type of background', 'seosight' ),
                            'type'    => 'image-picker',
                            'value'   => 'image_bg',
                            'choices' => array(
                                'image_bg' => get_template_directory_uri() . '/img/admin/image_bg.png',
                                'video_bg' => get_template_directory_uri() . '/img/admin/video_bg.png',
                            ),
                        ),
                    ),
                    'choices' => array(
                        'image_bg' => array(
                            'stunning_bg_image' => array(
                                'type'    => 'background-image',
                                'value'   => seosight_get_old_stunning_options('page', 'stunning_bg_image'),
                                'label'   => esc_html__( 'Background image', 'seosight' ),
                                'desc'    => esc_html__( 'Select one of images or upload your own pattern', 'seosight' ),
                                'choices' => seosight_backgrounds()
                            ),
                            'stunning_bg_cover' => array(
                                'type'  => 'switch',
                                'value'   => seosight_get_old_stunning_options('page', 'stunning_bg_cover'),
                                'label' => esc_html__( 'Expand background', 'seosight' ),
                                'desc'  => esc_html__( 'Don\'t repeat image and expand it to full section background', 'seosight' ),
                            ),
                        ),
                        'video_bg' => array(
                            'placeholder' => array(
                                'label' => esc_html__( 'Placeholder Image', 'seosight' ),
                                'desc'  => esc_html__( 'Please select placeholder image', 'seosight' ),
                                'type'  => 'upload',
                            ),
                            'selected'    => array(
                                'type'    => 'multi-picker',
                                'label'   => false,
                                'desc'    => false,
                                'picker'  => array(
                                    'source' => array(
                                        'label'        => esc_html__( 'Video Source', 'seosight' ),
                                        'type'         => 'switch',
                                        'right-choice' => array(
                                            'value' => 'oembed',
                                            'label' => esc_html__( 'Youtube', 'seosight' ),
                                        ),
                                        'left-choice'  => array(
                                            'value' => 'self',
                                            'label' => esc_html__( 'Self hosted', 'seosight' ),
                                        ),
                                        'value'        => 'oembed',
                                    ),
                                ),
                                'choices' => array(
                                    'oembed' => array(
                                        'source' => array(
                                            'label' => esc_html__( 'Video Link', 'seosight' ),
                                            'desc'  => esc_html__( 'Insert Video URL to embed this video', 'seosight' ),
                                            'type'  => 'oembed',
                                        ),
                                    ),
                                    'self'   => array(
                                        'mp4'  => array(
                                            'type'        => 'upload',
                                            'label'       => esc_html__( 'Link to mp4 video', 'seosight' ),
                                            'desc'        => esc_html__( 'Source of uploaded video', 'seosight' ),
                                            'images_only' => false,
                                        ),
                                        'webm' => array(
                                            'type'        => 'upload',
                                            'label'       => esc_html__( 'Link to webm video', 'seosight' ),
                                            'desc'        => esc_html__( 'Source of uploaded video', 'seosight' ),
                                            'images_only' => false,
                                        ),
                                        'ogg'  => array(
                                            'type'        => 'upload',
                                            'label'       => esc_html__( 'Link to ogg video', 'seosight' ),
                                            'desc'        => esc_html__( 'Source of uploaded video', 'seosight' ),
                                            'images_only' => false,
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'stunning_overlay'   => array(
					'type'  => 'rgba-color-picker',
					'label' => esc_html__( 'Color overlay', 'seosight' ),
					'desc'  => esc_html__( 'Layer with colored overlay for background image', 'seosight' ),
				),
				'stunning_bg_color'   => array(
					'type'  => 'color-picker',
					'value' => '#3e4d50',
					'label' => esc_html__( 'Background Color', 'seosight' ),
					'desc'  => esc_html__( 'If you choose no image to display - that color will be set as background', 'seosight' ),
					'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
				),
				'stunning_text_color' => array(
					'type'  => 'color-picker',
					'label' => esc_html__( 'Text Color', 'seosight' ),
					'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
				),
				'stunning_hide_title'   => array(
					'label' => esc_html__( 'Hide title', 'seosight' ),
					'desc'  => esc_html__( 'Remove text with page title from stunning header section', 'seosight' ),
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'type'    => 'radio',
					'choices' => array(
						'default'        => __( 'Default', 'seosight' ),
						'no'          => __( 'Show', 'seosight' ),
						'yes'          => __( 'Hide', 'seosight' ),
					),
					'value'   => 'default'
				),
				'stunning_hide_breadcrumbs'   => array(
					'label' => esc_html__( 'Hide breadcrumbs', 'seosight' ),
					'desc'  => esc_html__( 'Remove breadcrumbs from stunning header section', 'seosight' ),
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'type'    => 'radio',
					'choices' => array(
						'default'        => __( 'Default', 'seosight' ),
						'no'          => __( 'Show', 'seosight' ),
						'yes'          => __( 'Hide', 'seosight' ),
					),
					'value'   => 'default'
				),
			),
		),
	),
);