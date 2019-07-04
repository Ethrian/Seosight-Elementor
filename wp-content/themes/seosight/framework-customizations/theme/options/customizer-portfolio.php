<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'folio-likes-show' => array(
		'label'        => esc_html__( 'Show Like', 'seosight' ),
		'desc'         => esc_html__( 'Heart icon with counter who liked page', 'seosight' ),
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
	),
	'folio-data-show' => array(
		'label'        => esc_html__( 'Show date?', 'seosight' ),
		'desc'         => esc_html__( 'Show block with date of created page', 'seosight' ),
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
	),

	'folio-share-show' => array(
		'label'        => esc_html__( 'Show share icons?', 'seosight' ),
		'desc'         => esc_html__( 'Icons with script for share post in social networks', 'seosight' ),
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
	),
	'folio-related-show' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'value' => array(
				'label'        => esc_html__( 'Show Related items', 'seosight' ),
				'desc'         => esc_html__( 'Slider with similar portfolio items category tag', 'seosight' ),
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
			),
		),
		'choices' => array(
			'yes' => array(
				'block_title' => array(
					'type'       => 'text',
					'label'      => esc_html__( 'Related project section title', 'seosight' ),
					'value' => esc_html__( 'More Case Studies', 'seosight' ),
				),
			)
		),
	),
	'folio-bottom-nav' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'post-navigation' => array(
				'label'        => esc_html__( 'Enable inner navigation', 'seosight' ),
				'desc'         => esc_html__( 'Show additional navigation after portfolio', 'seosight' ),
				'type'         => 'switch',
				'right-choice' => array(
					'value' => 'yes',
					'label' => esc_html__( 'Enable', 'seosight' ),
				),
				'left-choice'  => array(
					'value' => 'no',
					'label' => esc_html__( 'Disable', 'seosight' ),
				),
				'value'        => 'yes',
			),
		),
		'choices' => array(
			'yes' => array(
				'page_select' => array(
					'type'       => 'multi-select',
					'label'      => esc_html__( 'Primary portfolio page', 'seosight' ),
					'desc'       => esc_html__( 'Select a page which center icon will be linked to', 'seosight' ),
					'help'       => esc_html__( 'Click on field and type page name to find page', 'seosight' ),
					'population' => 'posts',
					'source'     => 'page',
					'limit'      => 1,
				),
			)
		),
	),
);


