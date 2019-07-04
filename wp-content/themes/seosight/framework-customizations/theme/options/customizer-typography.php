<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'section_typography_body' => array(
		'title'   => esc_html__( 'Body font', 'seosight' ),
		'options' => array(
			'typography_body' => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#757575'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'Body font', 'seosight' ),
			),
		)
	),
	'section_typography_h1' => array(
		'title'   => esc_html__( 'H1 headings', 'seosight' ),
		'options' => array(
			'typography_h1'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H1 headings', 'seosight' ),
			),
		)
	),
	'section_typography_h2' => array(
		'title'   => esc_html__( 'H2 headings', 'seosight' ),
		'options' => array(
			'typography_h2'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H2 headings', 'seosight' ),
			),
		)
	),
	'section_typography_h3' => array(
		'title'   => esc_html__( 'H3 headings', 'seosight' ),
		'options' => array(
			'typography_h3'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H3 headings', 'seosight' ),
			),
		)
	),
	'section_typography_h4' => array(
		'title'   => esc_html__( 'H4 headings', 'seosight' ),
		'options' => array(
			'typography_h4'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H4 headings', 'seosight' ),
			),
		)
	),
	'section_typography_h5' => array(
		'title'   => esc_html__( 'H5 headings', 'seosight' ),
		'options' => array(
			'typography_h5'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H5 headings', 'seosight' ),
			),
		)
	),
	'section_typography_h6' => array(
		'title'   => esc_html__( 'H6 headings', 'seosight' ),
		'options' => array(
			'typography_h6'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'line-height'    => false,
					'letter-spacing' => true,
					'color'          => true
				),
				'label'      => esc_html__( 'H6 headings', 'seosight' ),
			),
		)
	),
	'section_typography_nav' => array(
		'title'   => esc_html__( 'Menu typography', 'seosight' ),
		'options' => array(
			'typography_nav'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'line-height'    => false,
					'letter-spacing' => true,
					'color'          => true
				),
				'label'      => esc_html__( 'Menu typography', 'seosight' ),
			),
		)
	),
	'section_typography_logo' => array(
		'title'   => esc_html__( 'Logo typography', 'seosight' ),
		'options' => array(
			'typography_logo'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'line-height'    => false,
					'letter-spacing' => true,
					'color'          => true
				),
				'label'      => esc_html__( 'Logo typography', 'seosight' ),
			),
		)
	),

);