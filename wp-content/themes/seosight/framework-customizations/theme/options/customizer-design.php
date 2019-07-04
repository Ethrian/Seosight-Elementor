<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'website_preloader' => array(
		'type'  => 'switch',
		'value' => false,
		'label' => esc_html__( 'Enable website pre-loader', 'seosight' ),
	),
	'sidebar_width' => array(
		'type'  => 'select',
		'value' => 'narrow',
		'label' => esc_html__('Sidebar width', 'seosight'),
		'desc'  => esc_html__('Choose between wide and narrow sidebar on your pages', 'seosight'),
		'choices' => array(
			'narrow' => esc_html__('Narrow', 'seosight'),
			'wide' => esc_html__('Wide', 'seosight'),
		),
	)

);

if ( class_exists( 'KingComposer' ) ) {
    $options[ 'sections_padding' ] = array(
        'type'    => 'multi-picker',
        'label'   => false,
        'desc'    => false,
        'picker'  => array(
            'sections_padding_picker' => array(
                'label'   => esc_html__( 'Sections padding', 'seosight' ),
                'type'    => 'radio',
                'value'   => 'medium',
                'inline'  => true,
                'choices' => array(
                    'small'  => esc_html__( 'Small', 'seosight' ),
                    'medium' => esc_html__( 'Medium', 'seosight' ),
                    'large'  => esc_html__( 'Large', 'seosight' ),
                    'custom' => esc_html__( 'Custom', 'seosight' ),
                ),
            ),
        ),
        'choices' => array(
            'custom' => array(
                'top'    => array(
                    'type'  => 'text',
                    'value' => 100,
                    'label' => __( 'Padding top', 'seosight' ),
                    'desc'  => __( 'Number only', 'seosight' ),
                ),
                'bottom' => array(
                    'type'  => 'text',
                    'value' => 100,
                    'label' => __( 'Padding bottom', 'seosight' ),
                    'desc'  => __( 'Number only', 'seosight' ),
                ),
            ),
        ),
    );
}