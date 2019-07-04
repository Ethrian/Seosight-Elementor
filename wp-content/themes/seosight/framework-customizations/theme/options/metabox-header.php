<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'header-absolute'   => array(
		'type'  => 'switch',
		'label' => esc_html__( 'Absolute placed Header', 'seosight' ),
		'desc' => esc_html__( 'Header will be placed over page content', 'seosight' ),
		'help' => esc_html__( 'Useful on pages with full-screen height sliders', 'seosight' ),
	),
	'header-opacity'   => array(
		'type'  => 'slider',
		'label' => esc_html__( 'Header opacity', 'seosight' ),
		'desc' => esc_html__( 'Make header background semitransparent', 'seosight' ),
		'help' => esc_html__( 'Useful on pages with full-screen height sliders', 'seosight' ),
		'value' => 100,
		'properties' => array(
			'min' => 0,
			'max' => 100,
			'step' => 5,
		),
	),
	'header-color' => array(
		'type'  => 'color-picker',
		'label' => esc_html__( 'Text Color', 'seosight' ),
		'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
	),
	'select_menu' => array(
		'desc'    => sprintf(__( 'Select one of website menus. Or <a href="%s">Create new menu</a>.', 'seosight' ), admin_url( 'nav-menus.php' ) ),
		'type'    => 'select',
		'label'   => esc_html__( 'Select menu to display', 'seosight' ),
		'choices' => seosight_get_menus(),
	),

);