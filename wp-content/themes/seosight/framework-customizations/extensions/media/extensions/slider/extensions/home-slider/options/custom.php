<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'image_layout' => array(
		'label'        => esc_html__( 'Main image position', 'seosight' ),
		'type'         => 'switch',
		'right-choice' => array(
			'value' => 'content',
			'label' => esc_html__( 'Content', 'seosight' ),
		),
		'left-choice'  => array(
			'value' => 'background',
			'label' => esc_html__( 'Background', 'seosight' ),
		),
		'value'        => 'content',
		'desc'         => esc_html__( 'Main text color light / dark', 'seosight' ),
	),
	'buttons'    => array(
		'label'         => esc_html__( 'Buttons', 'seosight' ),
		'type'          => 'addable-popup',
		'template'      => '{{- label }}',
		'desc'          => esc_html__( 'Add button', 'seosight' ),
		'popup-options' => array(
			'label' => array(
				'label' => esc_html__( 'Button Label', 'seosight' ),
				'desc'  => esc_html__( 'This is the text that appears on your button', 'seosight' ),
				'type'  => 'text',
				'value' => ''
			),
			fw()->theme->get_options( 'option-link' ),
			'color' => array(
				'label'   => esc_html__( 'Color', 'seosight' ),
				'type'    => 'select', // or 'short-select'
				'attr'  => array( 'class' => 'colored-options' ),
				'choices' => seosight_button_colors(),
			),
			'size'  => array(
				'type'    => 'radio',
				'value'   => 'medium',
				'label'   => esc_html__( 'Button size', 'seosight' ),
				'choices' => array(
					'small'  => esc_html__( 'Small', 'seosight' ),
					'medium' => esc_html__( 'Medium', 'seosight' ),
					'large'  => esc_html__( 'Large', 'seosight' ),
				),
				'inline'  => true,
			),
			'outlined' => array(
				'label'       => esc_html__( 'Outlined button', 'seosight' ),
				'type'         => 'switch',
				'right-choice' => array(
					'value' => 'on',
					'label' => esc_html__( 'On', 'seosight' ),
				),
				'left-choice'  => array(
					'value' => 'off',
					'label' => esc_html__( 'Off', 'seosight' ),
				),
				'value'        => 'off',
				'desc'         => esc_html__( 'Button with border and transparent background', 'seosight' ),
			),
			'shadow' => array(
				'label'        => esc_html__( 'Drop shadow', 'seosight' ),
				'type'         => 'switch',
				'right-choice' => array(
					'value' => 'on',
					'label' => esc_html__( 'On', 'seosight' ),
				),
				'left-choice'  => array(
					'value' => 'off',
					'label' => esc_html__( 'Off', 'seosight' ),
				),
				'value'        => 'on',
				'desc'         => esc_html__( 'Buttons shadow effect on hover', 'seosight' ),
			),
			'class'      => array(
				'type'  => 'text',
				'label' => esc_html__( 'Additional class', 'seosight' ),
				'desc'  => esc_html__( 'Class that can be used for additional styling or JS actions', 'seosight' )
			),
		),
	),
	'text-align' => array(
		'type'    => 'image-picker',
		'value'   => 'center',
		'label'   => esc_html__( 'Content placement', 'seosight' ),
		'desc'    => esc_html__( 'Choose content position on slide', 'seosight' ),
		'choices' => array(
			'center' => get_template_directory_uri() . '/images/admin/slide-text-center.png',
			'alignleft'   => get_template_directory_uri() . '/images/admin/slide-text-left.png',
			'alignright'  => get_template_directory_uri() . '/images/admin/slide-text-right.png',
		),
	),
	'bg-color'   => array(
		'type'     => 'color-picker',
		'value'    => '#f6f8f7',
		// palette colors array
		'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
		'label'    => esc_html__( 'Slide background color', 'seosight' ),
	),
	'text-color' => array(
		'label'        => esc_html__( 'Text Color scheme', 'seosight' ),
		'type'         => 'switch',
		'right-choice' => array(
			'value' => 'dark',
			'label' => esc_html__( 'Dark', 'seosight' ),
			'color' => '#2f2c2c'
		),
		'left-choice'  => array(
			'value' => 'light',
			'label' => esc_html__( 'Light', 'seosight' ),
		),
		'value'        => 'dark',
		'desc'         => esc_html__( 'Main text color light / dark', 'seosight' ),
	),
	'title'      => array(
		'type'  => 'text',
		'label' => esc_html__( 'Tab Title', 'seosight' ),
		'desc'  => esc_html__( 'Will be shown on bottom in slide label', 'seosight' )
	),
	'subtitle'   => array(
		'type'  => 'text',
		'label' => esc_html__( 'Tab Subtitle', 'seosight' ),
		'desc'  => esc_html__( 'Choose a subtitle for your slide label', 'seosight' )
	),
);
