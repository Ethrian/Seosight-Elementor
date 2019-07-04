<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'post-quote'   => array(
		'type'    => 'box',
		'title'   => esc_html__( 'Quote post options', 'seosight' ),
		'options' => array(
			'quote_author' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Quote author', 'seosight' ),
			),
			'quote_dopinfo' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Author profession', 'seosight' ),
			),
			'quote_avatar' => array(
				'type'  => 'upload',
				'images_only' => true,
				'label' => esc_html__( 'Author avatar', 'seosight' ),
			),
			'text_color' => array(
				'type'  => 'rgba-color-picker',
				'label' => esc_html__( 'Text Color', 'seosight' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
		),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'post-image'   => array(
		'type'    => 'box',
		'options' => array(
			'enable_overlay' => array(
				'type'  => 'checkbox',
				'value' => true,
				'label' => esc_html__( 'Enable Image Overlay', 'seosight' ),
				'desc'  => esc_html__( 'Darken semi-transparent overlay over image', 'seosight' ),
				'text'  => esc_html__( 'Yes', 'seosight' ),
			)
		),
		'title'   => esc_html__( 'Image post options', 'seosight' ),
		'context' => 'side',
		'priority' => 'high',
	),
	'post-video'   => array(
		'type'     => 'box',
		'options'  => array(
			'video_oembed' => array(
				'type'    => 'oembed',
				'label'   => esc_html__( 'Link to video', 'seosight' ),
				'desc'    => esc_html__( 'Enter link for video that will be embedded', 'seosight' ),
				'help'    => esc_html__( 'More information about WordPress embeds:', 'seosight' ) . '<br> <a href="https://codex.wordpress.org/Embeds">https://codex.wordpress.org/Embeds</a>',
				'preview' => array(
					'width'      => 640, // optional, if you want to set the fixed width to iframe
					'height'     => 480, // optional, if you want to set the fixed height to iframe
					/**
					 * if is set to false it will force to fit the dimensions,
					 * because some widgets return iframe with aspect ratio and ignore applied dimensions
					 */
					'keep_ratio' => true
				)
			)
		),
		'title'    => esc_html__( 'Video post options', 'seosight' ),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'post-audio'   => array(
		'type'     => 'box',
		'options'  => array(
			'audio_oembed' => array(
				'type'    => 'oembed',
				'label'   => esc_html__( 'Link to audio', 'seosight' ),
				'value'   => 'https://soundcloud.com/',
				'desc'    => esc_html__( 'Enter link for video that will be embedded', 'seosight' ),
				'help'    => esc_html__( 'More information about WordPress embeds:', 'seosight' ) . '<br> <a href="https://codex.wordpress.org/Embeds">https://codex.wordpress.org/Embeds</a>',
				'preview' => array(
					'width'      => 690, // optional, if you want to set the fixed width to iframe
					'height'     => 180, // optional, if you want to set the fixed height to iframe
					'keep_ratio' => true
				)
			)
		),
		'title'    => esc_html__( 'Audio post options', 'seosight' ),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'post-gallery' => array(
		'type'     => 'box',
		'options'  => array(
			'gallery_images' => array(
				'type'        => 'multi-upload',
				'label'       => esc_html__( 'Images in slider on post list:', 'seosight' ),
				'desc'        => esc_html__( 'Images that will be displayed in slider on post list pages', 'seosight' ),
				'images_only' => true,
			)
		),
		'title'    => esc_html__( 'Gallery post options', 'seosight' ),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'design-customize' => array(
		'title'    => esc_html__( 'Customize design', 'seosight' ),
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			'header'          => array(
				'title'   => esc_html__( 'Header', 'seosight' ),
				'type'    => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options' => array(
					'aside-panel' => array(
						'label'   => esc_html__( 'Show aside open button?', 'seosight' ),
						'desc'    => esc_html__( 'Will enable button and aside panel', 'seosight' ),
						'type'    => 'select',
						'value'   => 'default',
						'choices' => array(
							'default' => esc_html__( 'Default', 'seosight' ),
							'yes'     => esc_html__( 'Show', 'seosight' ),
							'no'      => esc_html__( 'Hide', 'seosight' )
						),
					),
					'custom-header' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label' => esc_html__( 'Change settings?', 'seosight' ),
								'desc'  => esc_html__( 'Extra settings for element. Will affect only on current page.', 'seosight' ),
								'type'  => 'switch',
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'seosight' )
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'seosight' )
								),
								'value'        => 'no',
							),
						),
						'choices' => array(
							'yes' => array(
								fw()->theme->get_options( 'metabox-header' ),
							),
						),
					),
				),
			),
			'stunning-header' => array(
				'title'   => esc_html__( 'Stunning Header', 'seosight' ),
				'type'    => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options' => array(
					'custom-stunning' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label' => esc_html__( 'Change settings?', 'seosight' ),
								'desc'  => esc_html__( 'Extra settings for element. Will affect only on current page.', 'seosight' ),
								'type'  => 'switch',
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'seosight' )
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'seosight' )
								),
								'value'        => 'no',
							),
						),
						'choices' => array(
							'yes' => array(
								fw()->theme->get_options( 'metabox-stunning' ),
							),
						),
					),
				),
			),
			'subscribe'          => array(
				'title'   => esc_html__( 'Subscribe panel', 'seosight' ),
				'type'    => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options' => array(
					'custom-subscribe' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label' => esc_html__( 'Change settings?', 'seosight' ),
								'desc'  => esc_html__( 'Extra settings for element. Will affect only on current page.', 'seosight' ),
								'type'  => 'switch',
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'seosight' )
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'seosight' )
								),
								'value'        => 'no',
							),
						),
						'choices' => array(
							'yes' => array(
								'subscribe-show' => array(
									'type'    => 'multi-picker',
									'label'   => false,
									'desc'    => false,
									'picker'  => array(
										'value' => array(
											'label'        => esc_html__( 'Show Subscribe panel?', 'seosight' ),
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
											'desc'         => esc_html__( 'Panel beforefooter will be show/hide from frontend', 'seosight' ),
										)
									),
									'choices' => array(
										'yes'  => array(
											fw()->theme->get_options( 'customizer-subscribe' ),
										)
									)
								)

							),
						),
					),
				),
			),
		),
	),
);