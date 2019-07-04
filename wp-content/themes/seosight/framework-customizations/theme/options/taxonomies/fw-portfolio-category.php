<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'stunning-header' => array(
		'title'   => esc_html__( 'Stunning Header', 'seosight' ),
		'type'    => 'box',
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
);