<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'design-customize' => array(
		'title'    => esc_html__( 'Customize design', 'seosight' ),
		'attr'		 => array( 'class' => 'seosight-admin-customize-design' ),
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
	'portfolio-page'   => array(
		'title'   => esc_html__( 'Portfolio page options', 'seosight' ),
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			fw()->theme->get_options( 'metabox-portfolio-page' ),
		),
	),
	'blog-page'   => array(
		'title'    => esc_html__( 'Blog page options', 'seosight' ),
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			fw()->theme->get_options( 'metabox-blog-page' ),
		),
	),
);
