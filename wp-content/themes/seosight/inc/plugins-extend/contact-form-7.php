<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/* Add Contact form 7 module for King Composer */
if ( function_exists( 'kc_add_map' ) ) {
	$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
	if ( function_exists( 'seosight_button_colors' ) ) {
		$button_colors = seosight_button_colors();
	} else {
		$button_colors = array();
	}
	if( function_exists('fw_html_tag')){
		$create_form_text = fw_html_tag( 'a', array(
			'href'   => admin_url( '?page=wpcf7-new' ),
			'target' => '_blank',
		), esc_html__( 'create a new Form', 'seosight' ) );
	} else {
		$create_form_text =  esc_html__( 'create a new Form', 'seosight' );
	}

	$contact_forms = array();
	if ( ! empty( $cf7 ) ) {

		foreach ( $cf7 as $cform ) {
			$contact_forms[ $cform->ID ] = $cform->post_title;
		}
		$options = array(
			'general' => array(
				array(
					'name'    => 'contact_form_id',
					'type'    => 'select',
					'label'   => esc_html__( 'Select Created Form', 'seosight' ),
					'options' => $contact_forms
				),
				array(
					'name'        => 'wrap_class',
					'label'       => esc_html__( 'Extra class', 'seosight' ),
					'type'        => 'text',
					'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'seosight' ),
				),
			),
			'styling' => array(
				array(
					'name'    => 'color_form',
					'type'    => 'select',
					'label'   => esc_html__( 'Color scheme', 'seosight' ),
					'options' => array(
						'white' => esc_html__( 'White', 'seosight' ),
						'dark'  => esc_html__( 'Dark', 'seosight' ),
					)
				),
				array(
					'name'    => 'color_btn',
					'label'   => esc_html__( 'Submit Color', 'seosight' ),
					'type'    => 'select', // or 'short-select'
					'options' => $button_colors,
				),
				array(
					'type'    => 'css',
					'label'   => esc_html__( 'css', 'seosight' ),
					'name'    => 'custom_css',
					'options' => array(
						array(
							'screens'                             => 'any',
							esc_html__( 'Box Style', 'seosight' ) => array(
								array( 'property' => 'text-align', 'label' => 'Align' ),
								array( 'property' => 'padding', 'label' => 'Padding' ),
								array( 'property' => 'margin', 'label' => 'Margin' ),
							),
							esc_html__( 'Input', 'seosight' )     => array(
								array(
									'property' => 'font-size',
									'label'    => 'Font Size',
									'selector' => 'input, textarea'
								),
								array(
									'property' => 'color',
									'label'    => 'Text color',
									'selector' => 'input, textarea'
								),
								array(
									'property' => 'background-color',
									'label'    => 'Background Color',
									'selector' => 'input, textarea'
								),
								array( 'property' => 'border', 'label' => 'Border', 'selector' => 'input, textarea' ),
								array(
									'property' => 'border-radius',
									'label'    => 'Border Radius',
									'selector' => 'input, textarea'
								),
							),
							esc_html__( 'Button', 'seosight' )    => array(
								array(
									'property' => 'color',
									'label'    => 'Text Color',
									'selector' => '.btn'
								),
								array(
									'property' => 'background-color',
									'label'    => 'Background Color',
									'selector' => '.btn'
								),
								array(
									'property' => 'font-size',
									'label'    => 'Text Size',
									'selector' => '.btn'
								),
								array( 'property' => 'border', 'label' => 'Border', 'selector' => '.btn' ),
								array(
									'property' => 'border-radius',
									'label'    => 'Border Radius',
									'selector' => '.btn'
								),
							),
						)
					)
				),
			),
		);
	} else {
		$options = array(
			array(
				'name'       => 'no-forms',
				'type'       => 'html-full',
				'label'      => false,
				'desc'       => false,
				'admin_view' => 'html',
				'value'      =>
					'<h3>' . esc_html__( 'No Forms Available', 'seosight' ) . '</h3>' .
					'<p>' .
					'<em>' .
					str_replace(
						array(
							'{br}',
							'{add_slider_link}'
						),
						array(
							'<br/>',
							$create_form_text
						),
						__( 'No Forms created yet. Please go to the {br}Contact Forms page and {add_slider_link}.', 'seosight' )
					) .
					'</em>' .
					'</p>'
			)

		);
	}
	kc_add_map(
		array(
			'crum_cf7' => array(
				'name'        => 'Contact Form 7',
				'description' => esc_html__( 'Display contact form', 'seosight' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-contact-form',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'params'      => $options
			),  // End of elemnt kc_icon

		)
	); // End add map

} // End if