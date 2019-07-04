<?php

if ( !defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$grid_link	 = '<a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grid</a>';
$options	 = array(
	'description'				 => array(
		'title'		 => esc_html__( 'Project summary', 'seosight' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'context'	 => 'side',
		'options'	 => array(
			'project-title'	 => array(
				'title'	 => esc_html__( 'Title', 'seosight' ),
				'desc'	 => esc_html__( 'Alternative title for project', 'seosight' ),
				'type'	 => 'text'
			),
			'project-desc'	 => array(
				'type'			 => 'wp-editor',
				'label'			 => false,
				'tinymce'		 => true,
				'media_buttons'	 => false,
				'wpautop'		 => true,
				'editor_height'	 => 200,
			),
			'project-button' => array(
				'label'			 => esc_html__( 'Project link', 'seosight' ),
				'button'		 => esc_html__( 'Add button', 'seosight' ),
				'size'			 => 'small',
				'type'			 => 'popup',
				'popup-options'	 => array(
					'label'		 => array(
						'label'	 => esc_html__( 'Button Label', 'seosight' ),
						'desc'	 => esc_html__( 'This is the text that appears on your button', 'seosight' ),
						'type'	 => 'text',
						'value'	 => esc_html__( 'Project link', 'seosight' ),
					),
					'background' => array(
						'type'	 => 'color-picker',
						'value'	 => '#2f2c2c',
						'label'	 => esc_html__( 'Button Background', 'seosight' ),
						'desc'	 => esc_html__( 'This is button background', 'seosight' ),
					),
					fw()->theme->get_options( 'option-link' ),
				),
			),
		),
	),
	'portfolio-page-open'		 => array(
		'title'		 => esc_html__( 'Behavior on Portfolio page', 'seosight' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'context'	 => 'side',
		'options'	 => array(
			'open-item' => array(
				'type'		 => 'radio',
				'value'		 => 'default',
				'label'		 => false,
				'choices'	 => array(
					'default'	 => esc_html__( 'Open inner project page', 'seosight' ),
					'lightbox'	 => esc_html__( 'Open featured image in lightbox', 'seosight' ),
				),
			),
		),
	),
	'portfolio-cover-video-box'	 => array(
		'title'		 => esc_html__( 'Cover video', 'seosight' ),
		'type'		 => 'box',
		'priority'	 => 'low',
		'context'	 => 'side',
		'options'	 => array(
			'cover-video-type'	 => array(
				'type'		 => 'radio',
				'value'		 => 'none',
				'label'		 => false,
				'inline'	 => true,
				'choices'	 => array(
					'none'	 => esc_html__( 'None', 'seosight' ),
					'link'	 => esc_html__( 'Link', 'seosight' ),
					'source' => esc_html__( 'Source', 'seosight' ),
				),
			),
			'cover-video-source' => array(
				'type'		 => 'multi-picker',
				'picker'	 => 'cover-video-type',
				'choices'	 => array(
					'link'	 => array(
						'url' => array(
							'type'	 => 'oembed',
							'label'	 => __( 'Link', 'seosight' ),
						),
					),
					'source' => array(
						'video_source' => array(
							'type'		 => 'upload',
							'label'		 => __( 'Source', 'seosight' ),
							'desc'		 => __( 'MP4 Only', 'seosight' ),
							'files_ext'	 => array( 'mp4' ),
						),
					),
				)
			),
		),
	),
	'design-customize'			 => array(
		'title'		 => esc_html__( 'Customize design', 'seosight' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			'portfolio'			 => array(
				'title'		 => esc_html__( 'Thumbnail', 'seosight' ),
				'type'		 => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options'	 => array(
					'width-columns'		 => array(
						'type'		 => 'slider',
						'value'		 => 4,
						'properties' => array(
							'min'		 => 3,
							'max'		 => 12,
							'step'		 => 1,
							'grid_snap'	 => true
						),
						'label'		 => esc_html__( 'Item size on Category page', 'seosight' ),
						'desc'		 => esc_html__( 'Select width in 12 column grid', 'seosight' ),
						'help'		 => esc_html__( 'More about grid and columns you can read here', 'seosight' ) . ' - ' . $grid_link,
					),
					'thumbnail-align'	 => array(
						'type'		 => 'radio',
						'value'		 => 'default',
						'label'		 => esc_html__( 'Thumbnail / Slider align', 'seosight' ),
						'desc'		 => esc_html__( 'Align project media on single page', 'seosight' ),
						'choices'	 => array(
							'default'	 => esc_html__( 'Default', 'seosight' ),
							'left'		 => esc_html__( 'Left', 'seosight' ),
							'center'	 => esc_html__( 'Center', 'seosight' ),
							'right'		 => esc_html__( 'Right', 'seosight' ),
						),
						'inline'	 => true,
					),
				),
			),
			'portfolio-parts'	 => array(
				'title'		 => esc_html__( 'Project content', 'seosight' ),
				'type'		 => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options'	 => array(
					'custom-description' => array(
						'type'		 => 'multi-picker',
						'label'		 => false,
						'desc'		 => false,
						'picker'	 => array(
							'enable' => array(
								'label'			 => esc_html__( 'Change settings?', 'seosight' ),
								'desc'			 => esc_html__( 'Extra settings for element. Will affect only on current page.', 'seosight' ),
								'type'			 => 'switch',
								'right-choice'	 => array(
									'value'	 => 'yes',
									'label'	 => esc_html__( 'Yes', 'seosight' )
								),
								'left-choice'	 => array(
									'value'	 => 'no',
									'label'	 => esc_html__( 'No', 'seosight' )
								),
								'value'			 => 'no',
							),
						),
						'choices'	 => array(
							'yes' => array(
								'folio-likes-show'		 => array(
									'label'		 => esc_html__( 'Show Like', 'seosight' ),
									'desc'		 => esc_html__( 'Heart icon with counter who liked page', 'seosight' ),
									'value'		 => 'default',
									'type'		 => 'select',
									'choices'	 => array(
										'default'	 => esc_html__( 'Default', 'seosight' ),
										'yes'		 => esc_html__( 'Show', 'seosight' ),
										'no'		 => esc_html__( 'Hide', 'seosight' ),
									),
								),
								'folio-data-show'		 => array(
									'label'		 => esc_html__( 'Show date?', 'seosight' ),
									'desc'		 => esc_html__( 'Show block with date of created page', 'seosight' ),
									'value'		 => 'default',
									'type'		 => 'select',
									'choices'	 => array(
										'default'	 => esc_html__( 'Default', 'seosight' ),
										'yes'		 => esc_html__( 'Show', 'seosight' ),
										'no'		 => esc_html__( 'Hide', 'seosight' ),
									),
								),
								'folio-share-show'		 => array(
									'label'		 => esc_html__( 'Show share icons?', 'seosight' ),
									'desc'		 => esc_html__( 'Icons with script for share post in social networks', 'seosight' ),
									'value'		 => 'default',
									'type'		 => 'select',
									'choices'	 => array(
										'default'	 => esc_html__( 'Default', 'seosight' ),
										'yes'		 => esc_html__( 'Show', 'seosight' ),
										'no'		 => esc_html__( 'Hide', 'seosight' ),
									),
								),
								'folio-navigation-show'	 => array(
									'label'		 => esc_html__( 'Show posts navigation', 'seosight' ),
									'desc'		 => esc_html__( 'Buttons with previous / next post links', 'seosight' ),
									'value'		 => 'default',
									'type'		 => 'select',
									'choices'	 => array(
										'default'	 => esc_html__( 'Default', 'seosight' ),
										'yes'		 => esc_html__( 'Show', 'seosight' ),
										'no'		 => esc_html__( 'Hide', 'seosight' ),
									),
								),
								'folio-related-show'	 => array(
									'label'		 => esc_html__( 'Show Related items', 'seosight' ),
									'desc'		 => esc_html__( 'Slider with similar portfolio items category tag', 'seosight' ),
									'value'		 => 'default',
									'type'		 => 'select',
									'choices'	 => array(
										'default'	 => esc_html__( 'Default', 'seosight' ),
										'yes'		 => esc_html__( 'Show', 'seosight' ),
										'no'		 => esc_html__( 'Hide', 'seosight' ),
									),
								),
							),
						),
					),
				),
			),
			'header'			 => array(
				'title'		 => esc_html__( 'Header', 'seosight' ),
				'type'		 => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options'	 => array(
					'custom-header' => array(
						'type'		 => 'multi-picker',
						'label'		 => false,
						'desc'		 => false,
						'picker'	 => array(
							'enable' => array(
								'label'			 => esc_html__( 'Change settings?', 'seosight' ),
								'desc'			 => esc_html__( 'Extra settings for element. Will affect only on current page.', 'seosight' ),
								'type'			 => 'switch',
								'right-choice'	 => array(
									'value'	 => 'yes',
									'label'	 => esc_html__( 'Yes', 'seosight' )
								),
								'left-choice'	 => array(
									'value'	 => 'no',
									'label'	 => esc_html__( 'No', 'seosight' )
								),
								'value'			 => 'no',
							),
						),
						'choices'	 => array(
							'yes' => array(
								fw()->theme->get_options( 'metabox-header' ),
							),
						),
					),
				),
			),
			'stunning-header'	 => array(
				'title'		 => esc_html__( 'Stunning Header', 'seosight' ),
				'type'		 => 'box',
				'attr'		 => array( 'class' => 'seosight-admin-popup-block' ),
				'options'	 => array(
					'custom-stunning' => array(
						'type'		 => 'multi-picker',
						'label'		 => false,
						'desc'		 => false,
						'picker'	 => array(
							'enable' => array(
								'label'			 => esc_html__( 'Change settings?', 'seosight' ),
								'desc'			 => esc_html__( 'Extra settings for element. Will affect only on current page.', 'seosight' ),
								'type'			 => 'switch',
								'right-choice'	 => array(
									'value'	 => 'yes',
									'label'	 => esc_html__( 'Yes', 'seosight' )
								),
								'left-choice'	 => array(
									'value'	 => 'no',
									'label'	 => esc_html__( 'No', 'seosight' )
								),
								'value'			 => 'no',
							),
						),
						'choices'	 => array(
							'yes' => array(
								fw()->theme->get_options( 'metabox-stunning' ),
							),
						),
					),
				),
			),
		),
	),
);
