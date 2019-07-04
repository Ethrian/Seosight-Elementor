<?php if (!defined('FW')) die('Forbidden');

$options = array(

	'full_height' => array(
		'label'        => esc_html__( 'Full height slider', 'seosight' ),
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
		'desc'         => esc_html__( 'Expand height to full browser window height', 'seosight' ),
	),
	'slider_infinity' => array(
		'label'        => esc_html__( 'Infinite loop', 'seosight' ),
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
		'desc'         => esc_html__( 'Enable loop slides by circle', 'seosight' ),
	),
	'stop_on_hover' => array(
		'label'        => esc_html__( 'Stop on hover', 'seosight' ),
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
	),
	'autoplay' => array(
		'type'  => 'slider',
		'value' => 4,
		'properties' => array(
			'min' => 0,
			'max' => 20,
			'step' => 1,
		),
		'label' => esc_html__('Auto Scroll delay', 'seosight'),
		'desc'  => esc_html__('Time between change slides in seconds', 'seosight'),
		'help'  => esc_html__('If you will set "0" autopay will be disabled', 'seosight'),
	),
	'slide_labels' => array(
		'label'        => esc_html__( 'Slide labels', 'seosight' ),
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
		'desc'         => esc_html__( 'Title and description for each slide in bottom of slider', 'seosight' ),
	),
	'slide_arrows' => array(
		'label'        => esc_html__( 'Slide arrows', 'seosight' ),
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
		'desc'         => esc_html__( 'Prev / Next arrows buttons visibility', 'seosight' ),
	),

);
