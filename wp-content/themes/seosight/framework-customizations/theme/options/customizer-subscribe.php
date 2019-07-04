<?php

if ( !defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'show_subscribe_section' => array(
		'label'			 => esc_html__( 'Show Email subscribe section', 'seosight' ),
		'type'			 => 'switch',
		'left-choice'	 => array(
			'value'	 => 'yes',
			'label'	 => esc_html__( 'Show', 'seosight' )
		),
		'right-choice'	 => array(
			'value'	 => 'no',
			'label'	 => esc_html__( 'Hide', 'seosight' )
		),
		'value'			 => 'yes',
		'desc'			 => esc_html__( 'Display or hide section with subscribe form before footer.', 'seosight' ),
	),
	'section-subscribe-form' => array(
		'type'			 => 'popup',
		'label'			 => esc_html__( 'Customize Subscribe form', 'seosight' ),
		'desc'			 => esc_html__( 'Click on button below to edit block content', 'seosight' ),
		'popup-title'	 => null,
		'button'		 => esc_html__( 'Edit Subscribe Form', 'seosight' ),
		'size'			 => 'medium', // small, medium, large
		'popup-options'	 => array(
			'title'			 => array(
				'title'	 => esc_html__( 'Title', 'seosight' ),
				'type'	 => 'text',
			),
			'desc'			 => array(
				'type'	 => 'textarea',
				'label'	 => esc_html__( 'Description', 'seosight' ),
				'desc'	 => esc_html__( 'Text that display after subscribe form', 'seosight' ),
			),
			'custom-form'	 => array(
				'type'		 => 'multi-picker',
				'label'		 => false,
				'desc'		 => false,
				'picker'	 => array(
					'value' => array(
						'label'			 => esc_html__( 'Show Custom form here?', 'seosight' ),
						'type'			 => 'switch',
						'left-choice'	 => array(
							'value'	 => 'yes',
							'label'	 => esc_html__( 'Yes', 'seosight' )
						),
						'right-choice'	 => array(
							'value'	 => 'no',
							'label'	 => esc_html__( 'No', 'seosight' )
						),
						'value'			 => 'no',
						'desc'			 => esc_html__( 'You can use any custom HTML or shortcode here.', 'seosight' ),
						'help'			 => esc_html__( 'By default here is displayed form from "Email Subscribers & Newsletters" plugin.  
						Plugin must be installed and activated if you want to use built-in form', 'seosight' ),
					)
				),
				'choices'	 => array(
					'yes'	 => array(
						'html' => array(
							'type'	 => 'textarea',
							'label'	 => esc_html__( 'HTML Field', 'seosight' ),
							'desc'	 => esc_html__( 'Content of this block will be displayed Instead default subscribe form.', 'seosight' ),
						),
					),
					'no'	 => array(
						'name_field' => array(
							'type'		 => 'multi-picker',
							'picker'	 => array(
								'show' => array(
									'type'	 => 'switch',
									'label'	 => esc_html__( 'Name field', 'seosight' ),
									'desc'	 => esc_html__( 'Add name field to subscribe form', 'seosight' ),
									'value'	 => false,
								)
							),
							'choices'	 => array(
								'true' => array(
									'name_field_swap' => array(
										'type'	 => 'switch',
										'label'	 => esc_html__( 'Show name field first?', 'seosight' ),
										'value'	 => false,
									),
								)
							),
						)
					)
				),
			),
			'list'			 => array(
				'type'		 => 'select-multiple',
				'label'		 => __( 'List', 'seosight' ),
				'desc'		 => esc_html__( 'You can manage lists here: Email Subscribers > Audience > Manage Lists', 'seosight' ),
				'choices'	 => seosight_get_es_lists( true )
			)
		),
	),
	'subscribe_text_color'	 => array(
		'type'	 => 'rgba-color-picker',
		'label'	 => esc_html__( 'Text Color', 'seosight' ),
		'help'	 => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
	),
	'subscribe_bg_color'	 => array(
		'type'	 => 'color-picker',
		'value'	 => '',
		'label'	 => esc_html__( 'Background Color', 'seosight' ),
		'desc'	 => esc_html__( 'If you choose no image to display - that color will be set as background', 'seosight' ),
		'help'	 => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
	),
	'subscribe_bg_image'	 => array(
		'type'		 => 'background-image',
		'value'		 => 'bg-0',
		'label'		 => esc_html__( 'Background image', 'seosight' ),
		'desc'		 => esc_html__( 'Select one of images or upload your own pattern', 'seosight' ),
		'choices'	 => seosight_backgrounds()
	),
	'subscribe_bg_cover'	 => array(
		'type'	 => 'switch',
		'label'	 => esc_html__( 'Expand background', 'seosight' ),
		'desc'	 => esc_html__( 'Don\'t repeat image and expand it to full section background', 'seosight' ),
	),
	'subscribe_animated'	 => array(
		'type'	 => 'switch',
		'label'	 => esc_html__( 'Show animated images?', 'seosight' ),
		'desc'	 => esc_html__( 'Images animated when section become visible', 'seosight' ),
		'value'	 => true,
	),
);
