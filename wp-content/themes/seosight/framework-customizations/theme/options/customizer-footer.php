<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$grid_link = '<a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grid</a>';
$options   = array(
	'section_footer_design' => array(
		'title'   => esc_html__( 'Design', 'seosight' ),
		'options' => array(
			'footer_text_color' => array(
				'type'  => 'rgba-color-picker',
				'label' => esc_html__( 'Text Color', 'seosight' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
			'footer_title_color' => array(
				'type'  => 'rgba-color-picker',
				'label' => esc_html__( 'Titles and Links  Color', 'seosight' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
			'footer_bg_image'   => array(
				'type'    => 'background-image',
				'value'   => 'bg-0',
				'label'   => esc_html__( 'Background image', 'seosight' ),
				'desc'    => esc_html__( 'Select one of images or upload your own pattern', 'seosight' ),
				'choices' => seosight_backgrounds()
			),
			'footer_bg_cover'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Expand background', 'seosight' ),
				'desc'  => esc_html__( 'Don\'t repeat image and expand it to full section background', 'seosight' ),
			),
			'footer_fixed'      => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Fixed footer effect', 'seosight' ),
				'desc'  => esc_html__( 'Add sliding effect for your footer.', 'seosight' ),
			),
			'footer_bg_color'   => array(
				'type'  => 'color-picker',
				'value' => '#3e4d50',
				'label' => esc_html__( 'Background Color', 'seosight' ),
				'desc'  => esc_html__( 'If you choose no image to display - that color will be set as background', 'seosight' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
		),
	),
	'section_widgets'       => array(
		'title'   => esc_html__( 'Widgets section', 'seosight' ),
		'options' => array(
			'site-description' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show text block', 'seosight' ),
						'type'         => 'switch',
						'left-choice'  => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'seosight' )
						),
						'right-choice' => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'seosight' )
						),
						'value'        => 'no',
						'desc'         => esc_html__( 'Text block with description in footer', 'seosight' ),
					)
				),
				'choices' => array(
					'yes' => array(
						'width-columns' => array(
							'type'       => 'slider',
							'value'      => 7,
							'properties' => array(
								'min'       => 2,
								'max'       => 12,
								'step'      => 1,
								'grid_snap' => true
							),
							'label'      => esc_html__( 'Text block width', 'seosight' ),
							'desc'       => esc_html__( 'Select width in 12 column grid', 'seosight' ),
							'help'       => esc_html__( 'More about grid and columns you can read here', 'seosight' ) . ' - ' . $grid_link,
						),
						'description'   => array(
							'type'          => 'popup',
							'label'         => esc_html__( 'Text block Content', 'seosight' ),
							'desc'          => esc_html__( 'Click on button below to edit block content', 'seosight' ),
							'popup-title'   => null,
							'button'        => esc_html__( 'Edit Text Block Content', 'seosight' ),
							'size'          => 'medium', // small, medium, large
							'popup-options' => array(
								'title' => array(
									'title' => esc_html__( 'Title', 'seosight' ),
									'type'  => 'text',
								),
								'desc'  => array(
									'type'          => 'wp-editor',
									'label'         => esc_html__( 'Text in column', 'seosight' ),
									'desc'          => esc_html__( 'Text in left footer column', 'seosight' ),
									'tinymce'       => true,
									'media_buttons' => true,
									'wpautop'       => true,
									'size'          => 'small',
									'editor_type'   => 'tinymce',
									'editor_height' => 200,
								),
							),
						),
						'social-networks' => array(
							'type'            => 'addable-box',
							'label'           => esc_html__( 'Social networks', 'seosight' ),
							'box-options'     => array(
								'link' => array(
									'label' => esc_html__( 'Link to social network page', 'seosight' ),
									'type'  => 'text',
								),
								'icon'  => array(
									'label'   => esc_html__( 'Icon', 'seosight' ),
									'type'    => 'select',
									'value'   => 'phone',
									'choices' => seosight_social_network_icons()
								),
							),
							'template'        => 'Icon - {{- icon }}', // box title
							'limit'           => 0,
							'add-button-text' => esc_html__( 'Add icon', 'seosight' ),
							'desc' => esc_html__( 'Icons of social networks with links to profile', 'seosight' ),
							'sortable'        => true,
						),
						'class'           => array(
							'title' => esc_html__( 'Additional class', 'seosight' ),
							'type'  => 'text',
							'desc' => esc_html__( 'Custom CSS class will be added to this block', 'seosight' ),
						),

					),

				),
			),
		),
	),
	'section_contacts'      => array(
		'title'   => esc_html__( 'Contacts section', 'seosight' ),
		'options' => array(
			'footer_contacts_show'       => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Show section with contacts', 'seosight' ),
				'value' => 'yes',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
			),
			'footer_contacts' => array(
				'type'            => 'addable-box',
				'label'           => esc_html__( 'Boxes with contacts', 'seosight' ),
				'box-options'     => array(
					'title'    => array(
						'title' => esc_html__( 'Title', 'seosight' ),
						'type'  => 'text'
					),
					'subtitle' => array(
						'label' => esc_html__( 'Subtitle', 'seosight' ),
						'type'  => 'text'
					),
					'icon'     => array(
						'label'   => esc_html__( 'Icon', 'seosight' ),
						'type'    => 'select',
						'value'   => 'phone',
						'choices' => array(
							'phone'   => esc_html__( 'Phone', 'seosight' ),
							'phone2' => esc_html__( 'Phone', 'seosight' ) . ' 2',
							'mail'    => esc_html__( 'Mail', 'seosight' ),
							'address' => esc_html__( 'Address', 'seosight' ),
							'address2' => esc_html__( 'Address', 'seosight' ) . ' 2',
							'address3' => esc_html__( 'Address', 'seosight' ) . ' 3',
							'chat'   => esc_html__( 'Chat', 'seosight' ),
							'service' => esc_html__( 'Service', 'seosight' ),
							'service2' => esc_html__( 'Service', 'seosight' ) . ' 2',
						),
					),
				),
				'template'        => 'Contact - {{- icon }}', // box title
				'limit'           => 4,
				'add-button-text' => esc_html__( 'Add box', 'seosight' ),
				'sortable'        => true,
			),
		),
	),
	'section_copyright'     => array(
		'title'   => esc_html__( 'Copyright field', 'seosight' ),
		'options' => array(
			'footer_copyright'       => array(
				'type'  => 'textarea',
				'label' => esc_html__( 'Copyright text', 'seosight' ),
				'value' => 'Site is built on WordPress <a href="https://wordpress.org">WordPress</a>'
			),
			'size_copyright_section' => array(
				'type'    => 'radio',
				'value'   => 'large',
				'label'   => esc_html__( 'Section height', 'seosight' ),
				'choices' => array(
					'large'  => esc_html__( 'Large', 'seosight' ),
					'medium' => esc_html__( 'Medium', 'seosight' ),
					'small'  => esc_html__( 'Small', 'seosight' ),
				),
				'inline'  => true,
			),
			'copyright_bg_color'     => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Background Color', 'seosight' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
			'copyright_text_color'   => array(
				'type'  => 'rgba-color-picker',
				'label' => esc_html__( 'Text Color', 'seosight' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
		),
	),
	'section_scroll_top' => array(
		'title'   => esc_html__( 'Scroll Top Button', 'seosight' ),
		'options' => array(
			'scroll_top_icon' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show Scroll to top button?', 'seosight' ),
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
						'desc'         => esc_html__( 'Display or hide button that scroll page to top on click.', 'seosight' ),
					)
				),
				'choices' => array(
					'yes' => array(
						'fixed'       => array(
							'type'  => 'switch',
							'label' => esc_html__( 'Become fixed', 'seosight' ),
							'desc'  => esc_html__( 'Make button fixed. By default will be shown in footer only', 'seosight' ),
						),
					)
				),
			),
		),
	),
);


