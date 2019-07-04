<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Customizer options
 *
 * @var array $options Fill this array with options to generate theme style from frontend Customizer
 */


$options = array(
	'panel_design' => array(
		'title'   => esc_html__( 'Design customize', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-design' ),
		),
	),
	'panel_typo' => array(
		'title'   => esc_html__( 'Typography', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-typography' ),
		),
	),
	'panel_header'    => array(
		'title'   => esc_html__( 'Header options', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-header' ),
		),
	),
	'panel_stunning'  => array(
		'title'   => esc_html__( 'Stunning header', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-stunning' ),
		),
	),
	'panel_subscribe' => array(
		'title'   => esc_html__( 'Subscribe panel', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-subscribe' ),
		),
	),
	'panel_footer'    => array(
		'title'   => esc_html__( 'Footer options', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-footer' ),
		),
	),
	'panel_blog'      => array(
		'title'   => esc_html__( 'Blog options', 'seosight' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-blog' ),
		),
	),
	'panel_portfolio' => array(
		'title'   => esc_html__( 'Single Portfolio options', 'seosight' ),
		'options' => array(
			'thumbnail-align' => array(
				'type'    => 'radio',
				'value'   => 'left',
				'label'   => esc_html__( 'Thumbnail / Slider align', 'seosight' ),
				'desc'    => esc_html__( 'Align project media on single page', 'seosight' ),
				'choices' => array(
					'left'   => esc_html__( 'Left', 'seosight' ),
					'center' => esc_html__( 'Center', 'seosight' ),
					'right'  => esc_html__( 'Right', 'seosight' ),
				),
				'inline'  => true,
			),
			fw()->theme->get_options( 'customizer-portfolio' ),
		),
	),
	'custom_js'    => array(
		'title'   => esc_html__( 'Additional JS', 'seosight' ),
		'options' => array(
			'custom-js'     => array(
				'type'  => 'textarea',
				'value' => '',
				'label'      => esc_html__( 'JS code field', 'seosight' ),
				'desc'       => wp_kses( __( 'without &lt;script&gt; tags', 'seosight' ), array('&lt;' => array(),'&gt;' => array()) ),
				'attr' => array(
					'class' => 'large-textarea',
					'placeholder' => 'jQuery( document ).ready(function() {  SOME CODE  });',
					'rows'        => 20,
				),
			),
		),
	),

);