<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'link'       => array(
		'type'          => 'popup',
		'label'         => esc_html__( 'Set link', 'seosight' ),
		'popup-title'   => esc_html__( 'Insert/edit link', 'seosight' ),
		'button'        => esc_html__( 'Select URL', 'seosight' ),
		'size'          => 'small', // small, medium, large
		'popup-options' => array(
			'selected' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'label'   => esc_html__( 'Link source', 'seosight' ),
						'type'    => 'select', // or 'short-select'
						'url' => 'url',
						'choices' => array(
							'url'  => esc_html__( 'Type url', 'seosight' ),
							'page' => esc_html__( 'Select page', 'seosight' ),
						),
						'desc'    => esc_html__( 'Select link source', 'seosight' ),
					),
				),
				'choices' => array(
					'url'  => array(
						'link' => array(
							'type'  => 'text',
							'label' => esc_html__( 'Type Link', 'seosight' ),
							'desc'  => esc_html__( 'Where should this element link to?', 'seosight' )
						),
					),
					'page' => array(
						'link' => array(
							'type'       => 'multi-select',
							'label'      => esc_html__( 'Select some blog page', 'seosight' ),
							'desc'       => esc_html__( 'Select a page which this element will be linked to', 'seosight' ),
							'help'       => esc_html__( 'Click on field and type page name to find page', 'seosight' ),
							'population' => 'posts',
							'value'      => '',
							'source'     => 'page',
							'limit'      => 1,
						),
					),
				),
			),
			'target'   => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Open Link in New Window', 'seosight' ),
				'desc'         => esc_html__( 'Select here if you want to open the linked page in a new window', 'seosight' ),
				'right-choice' => array(
					'value' => '_blank',
					'label' => esc_html__( 'Yes', 'seosight' ),
				),
				'left-choice'  => array(
					'value' => '_self',
					'label' => esc_html__( 'No', 'seosight' ),
				),
			),
		),
	),
);
