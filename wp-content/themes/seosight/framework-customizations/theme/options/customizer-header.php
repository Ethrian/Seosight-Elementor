<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'section_top_bar' => array(
        'title' => esc_html__('Top bar', 'seosight'),
        'options' => array(
            'sections-top-bar' => array(
                'type'  => 'multi-picker',
                'label' => false,
                'desc'  => false,
                'value' => array(
                    /**
                     * '<custom-key>' => 'default-choice'
                     */
                    'status' => 'hide',

                    /**
                     * These are the choices and their values,
                     * they are available after option was saved to database
                     */
                    'show' => array(
                        'theme-style' => 'top-bar-dark',
                    ),
                ),
                'picker' => array(
                    // '<custom-key>' => option
                    'status' => array(
                        'type'  => 'switch',
                        'label' => esc_html__('Top bar', 'seosight'),
                        'left-choice' => array(
                            'value' => 'show',
                            'label' => esc_html__('Show', 'seosight'),
                        ),
                        'right-choice' => array(
                            'value' => 'hide',
                            'label' => esc_html__('Hide', 'seosight'),
                        ),
                    ),
                ),
                'choices' => array(
                    'show' => array(
                        'theme-style' => array(
                            'type'  => 'select',
                            'label' => esc_html__('Theme style', 'seosight'),
                            'choices' => array(
                                '' => esc_html__('White', 'seosight'),
                                'top-bar-dark' => esc_html__('Dark', 'seosight'),
                            ),
                        ),
                        'show-languages' => array(
                            'type'  => 'multi-picker',
                            'label' => false,
                            'desc'  => false,
                            'value' => array(
                                'status' => 'hide',

                            ),
                            'picker' => array(
                                'status' => array(
                                    'type'  => 'switch',
                                    'label' => esc_html__('Languages selector', 'seosight'),
                                    'desc' => esc_html__('Works only with translate plugin  ','seosight'),
                                    'left-choice' => array(
                                        'value' => 'show',
                                        'label' => esc_html__('Show', 'seosight'),
                                    ),
                                    'right-choice' => array(
                                        'value' => 'hide',
                                        'label' => esc_html__('Hide', 'seosight'),
                                    ),
                                ),
                            ),
                            'choices' => array(
                                'show' => array(
                                    'language-select' => array(
                                        'type'  => 'multi-picker',
                                        'label' => false,
                                        'desc'  => false,
                                        'value' => array(
                                            'status' => 'theme-select',
                                        ),
                                        'picker' => array(
                                            // '<custom-key>' => option
                                            'status' => array(
                                                'type'  => 'radio',
                                                'label' => esc_html__('Use language switcher', 'seosight'),
                                                'choices' => array( // Note: Avoid bool or int keys http://bit.ly/1cQgVzk
                                                    'theme-select' => esc_html__('WPML or Polylang switcher', 'seosight'),
                                                    'plugin-select' => esc_html__('Other plugin shortcode', 'seosight'),
                                                ),
                                            ),
                                        ),
                                        'choices' => array(
                                            'plugin-select' => array(
                                                'shortcode' => array(
                                                    'type'  => 'text',
                                                    'label' => esc_html__('Provide plugin selector shortcode', 'seosight'),
                                                ),
                                            ),

                                        ),

                                    ),
                                ),

                            ),

                        ),
                        'info-boxes' => array(
                            'type'  => 'addable-box',
                            'label' => esc_html__('Text fields', 'seosight'),
                            'desc'  => esc_html__('Add you phone, email etc.', 'seosight'),
                            'value' => array(
                                array(
                                    'info' => 'info@seosight.com',
                                ),
                            ),
                            'box-options' => array(

                                'info' => array(
                                    'label' => esc_html__('Text','seosight'),
                                    'type' => 'text'
                                ),
                            ),
                            'template' => '{{- info  }}', // box title

                            'limit' => 0, // limit the number of boxes that can be added
                            'add-button-text' => esc_html__('Add field', 'seosight'),
                            'sortable' => true,
                        ),
                        'social-networks' => array(
                            'type'            => 'addable-box',
                            'label'           => esc_html__( 'Social networks', 'seosight' ),
                            'value' => array(
                                array(
                                    'link' => 'https://www.facebook.com/',
                                    'icon' => 'facebook.svg',
                                ),
                                array(
                                    'link' => 'https://www.youtube.com/',
                                    'icon' => 'youtube.svg',
                                ),
                                array(
                                    'link' => 'https://twitter.com',
                                    'icon' => 'twitter.svg',
                                ),
                                array(
                                    'link' => 'https://vk.com/',
                                    'icon' => 'vk.svg',
                                ),

                            ),
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
                        'show-login' => array(
                            'type'  => 'multi-picker',
                            'label' => false,
                            'desc'  => false,
                            'value' => array(
                                'status' => 'hide',
                                'show' => array(
                                ),
                            ),
                            'picker' => array(
                                // '<custom-key>' => option
                                'status' => array(
                                    'type'  => 'switch',
                                    'label' => esc_html__('Login/Logout block', 'seosight'),
                                    'left-choice' => array(
                                        'value' => 'show',
                                        'label' => esc_html__('Show', 'seosight'),
                                    ),
                                    'right-choice' => array(
                                        'value' => 'hide',
                                        'label' => esc_html__('Hide', 'seosight'),
                                    ),
                                ),
                            ),
                            'choices' => array(
                                'show' => array(

                                ),

                            ),

                        ),

                    ),
                ),
                /**
                 * (optional) if is true, the borders between choice options will be shown
                 */
                'show_borders' => false,
            )
        ),
    ),
    'section_sticky' => array(
	    'title'   => esc_html__( 'Sticky Header', 'seosight' ),
	    'options' => array(
            'sticky_header_desktop'           => array(
                'type'  => 'switch',
                'value' => true,
                'label' => esc_html__( 'Sticky header on desktop?', 'seosight' ),
            ),
            'sticky_header_mobile' => array(
                'type'  => 'switch',
                'value' => false,
                'label' => esc_html__( 'Sticky header on mobile?', 'seosight' ),
            ),
            'sticky_header_style'     => array(
                'type'    => 'select',
                'value'   => 'swing',
                'label'   => esc_html__( 'Animations', 'seosight' ),
                'desc'    => esc_html__( 'Header animation when it become sticky', 'seosight' ),
                'choices' => array(
                    'swing'  => 'Swing',
                    'slide'  => 'Slide',
                    'flip'   => 'Flip',
                    'bounce' => 'Bounce',
                    'none'   => 'No Animation'
                ),
                'blank'   => false
            )
        ),
    ),
	'section_logo'   => array(
		'title'   => esc_html__( 'Logotype', 'seosight' ),
		'options' => array(
			'logo-image'    => array(
				'label'       => esc_html__( 'Logotype Image', 'seosight' ),
				'type'        => 'upload',
				'images_only' => true,
			),
			'logo-retina'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Logo in Retina?', 'seosight' ),
				'desc'  => esc_html__( 'This image wil be displayed twice smaller than uploaded image size.', 'seosight' ),
			),
			'logo-title'    => array(
				'type'  => 'text',
				'label' => esc_html__( 'Logotype text', 'seosight' ),
				'desc'  => esc_html__( 'Write your logo title', 'seosight' ),
				'value' => get_bloginfo( 'name' )
			),
			'logo-subtitle' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Logotype description', 'seosight' ),
				'desc'  => esc_html__( 'Write your logo description', 'seosight' ),
				'value' => get_bloginfo( 'description' )
			),
		),
	),
	'section_search' => array(
		'title'   => esc_html__( 'Search', 'seosight' ),
		'options' => array(
			'search-icon' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show search icon?', 'seosight' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'seosight' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'seosight' )
						),
						'value'        => 'yes',
						'desc'         => esc_html__( 'Will enable search icon in page header', 'seosight' ),
					)
				),
				'choices' => array(
					'yes' => array(
						'style' => array(
							'type'    => 'image-picker',
							'value'   => 'fullscreen',
							'label'   => esc_html__( 'Select search style', 'seosight' ),
							'desc'    => esc_html__( 'Different styles for search that show on icon click', 'seosight' ),
							'choices' => array(
								'fullscreen' => get_template_directory_uri() . '/img/admin/search_full.png',
								'dropdown'   => get_template_directory_uri() . '/img/admin/search_drop.png',
							),
							'blank'   => false
						)
					)
				),
			),
		),
	),
	'section_aside'  => array(
		'title'   => esc_html__( 'Aside sidebar', 'seosight' ),
		'options' => array(
			'aside-panel' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show aside open button?', 'seosight' ),
						'desc'         => esc_html__( 'Will enable button and aside panel', 'seosight' ),
						'type'         => 'switch',
						'value'        => 'no',
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'seosight' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'seosight' )
						),
					)
				),
				'choices' => array(
					'yes' => array(
						'icon'   => array(
                            'type'        => 'upload',
                            'label'       => esc_html__( 'Custom icon', 'seosight' ),
                            'desc'        => esc_html__( 'Custom icon for opening menu', 'seosight' ),
                            'images_only' => true,
                        ),
                        'mobile' => array(
							'type'  => 'switch',
							'label' => esc_html__( 'Show on mobile?', 'seosight' ),
							'desc'  => esc_html__( 'Show button for opening aside panel on small screens', 'seosight' ),
							'value' => false,
						),
						'logo' => array(
							'type'  => 'switch',
							'label' => esc_html__( 'Show logo?', 'seosight' ),
							'desc'  => esc_html__( 'Logotype on aside panel', 'seosight' ),
							'value' => true,
						),
						'text' => array(
							'type'  => 'textarea',
							'label' => esc_html__( 'Text Block', 'seosight' ),
							'desc'  => esc_html__( 'Text block on aside panel', 'seosight' ),
						)
					)
				),
			),
		),
	),
);