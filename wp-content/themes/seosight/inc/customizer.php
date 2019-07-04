<?php

if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Settings and options for online preview Customizer changes.
 *
 * @package Seosight
 */
global $wp_customize;

if ( defined( 'FW' ) ):

	/**
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @internal
	 */
	function _action_customizer_live_crum_options( $wp_customize ) {
		//Color options
		$wp_customize->add_setting( 'primary-accent-color', array(
			'type'				 => 'option',
			'capability'		 => 'manage_options',
			'sanitize_callback'	 => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( 'primary-accent-color', array(
			'label'		 => esc_html__( 'Primary Accent Color', 'seosight' ),
			'section'	 => 'colors',
			'type'		 => 'color',
			'settings'	 => 'primary-accent-color',
		) );

		$wp_customize->add_setting( 'secondary-accent-color', array(
			'type'				 => 'option',
			'capability'		 => 'manage_options',
			'sanitize_callback'	 => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( 'secondary-accent-color', array(
			'label'		 => esc_html__( 'Secondary Accent Color', 'seosight' ),
			'section'	 => 'colors',
			'type'		 => 'color',
			'settings'	 => 'secondary-accent-color',
		) );

		// Header
		$wp_customize->get_setting( 'fw_options[logo-image]' )->transport				 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[logo-title]' )->transport				 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[logo-subtitle]' )->transport			 = 'postMessage';
		// Stunning Header.
		$wp_customize->get_setting( 'fw_options[stunning_bg_color]' )->transport		 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[stunning_text_color]' )->transport		 = 'postMessage';
		// Subscribe section
		$wp_customize->get_setting( 'fw_options[subscribe_bg_image]' )->transport		 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[subscribe_bg_cover]' )->transport		 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[subscribe_bg_color]' )->transport		 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[subscribe_text_color]' )->transport		 = 'postMessage';
		// Footer section
		$wp_customize->get_setting( 'fw_options[footer_bg_image]' )->transport			 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_bg_cover]' )->transport			 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_bg_color]' )->transport			 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_text_color]' )->transport		 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_title_color]' )->transport		 = 'postMessage';
		// Copyright section
		$wp_customize->get_setting( 'fw_options[footer_copyright]' )->transport			 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[size_copyright_section]' )->transport	 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[copyright_bg_color]' )->transport		 = 'postMessage';
		$wp_customize->get_setting( 'fw_options[copyright_text_color]' )->transport		 = 'postMessage';

		$wp_customize->get_setting( 'fw_options[scroll_top_icon]' )->transport = 'postMessage';
		// SubHeader
	}

	add_action( 'customize_register', '_action_customizer_live_crum_options' );

	/**
	 * @internal
	 */
	function _action_customizer_live_crum_options_preview() {
		$translation_array = array( 'templateUrl' => get_template_directory_uri() );
		wp_enqueue_script(
				'seosight-customizer',
				get_template_directory_uri() . '/js/customizer.js',
				array( 'jquery', 'customize-preview' ),
				fw()->theme->manifest->get_version(),
				true
		);
		wp_localize_script( 'seosight-customizer', 'theme_vars', $translation_array );
	}

	add_action( 'customize_preview_init', '_action_customizer_live_crum_options_preview' );

	/**
	 * Add Extra Elements for Default Customizer sections
	 */


endif;
