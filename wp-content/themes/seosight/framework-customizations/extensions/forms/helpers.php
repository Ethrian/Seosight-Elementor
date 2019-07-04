<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( function_exists( 'kc_add_map' ) ) {
	$forms = get_posts(
		array(
			'post_type'   => 'crum-form',
			'numberposts' => - 1
		)
	);
	if ( ! empty( $forms ) ) {
		foreach ( $forms as $form ) {
			$choices[ $form->ID ] = empty( $form->post_title ) ? esc_html__( '(no title)', 'seosight' ) : $form->post_title;
		}
		if ( function_exists( 'seosight_button_colors' ) ) {
			$button_colors = seosight_button_colors();
		} else {
			$button_colors = array();
		}
		$options = array(
			'general' => array(
				array(
					'name'        => 'form_id',
					'type'        => 'select',
					'label'       => esc_html__( 'Select Form', 'seosight' ),
					'description' =>
						str_replace(
							array(
								'{br}',
								'{edit_form_link}'
							),
							array(
								'<br/>',
								fw_html_tag( 'a', array(
									'href'   => admin_url( 'edit.php?post_type=form' ),
									'target' => '_blank',
								), esc_html__( 'change this Form', 'seosight' ) )
							),
							esc_html__( 'You can edit forms in admin interface only. {br} Please go to the Forms page for {edit_form_link}.', 'seosight' )
						),
					'options'     => $choices
				),
				array(
					'type'        => 'link',
					'label'       => esc_html__( 'Redirect on submit', 'seosight' ),
					'name'        => 'link',
					'description' => esc_html__( 'Users will be redirected after form submit to that URL', 'seosight' ),
				),
				array(
					'name'        => 'custom_class',
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
								array(
									'property' => 'border',
									'label'    => 'Border',
									'selector' => 'input, textarea'
								),
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
				'name'        => 'no-forms',
				'type'        => 'html-full',
				'label'       => false,
				'description' => false,
				'admin_view'  => 'html',
				'value'       =>
					'<h1 style="font-weight:100; text-align:center;">' . esc_html__( 'No Forms Available', 'seosight' ) . '</h1>' .
					'<p style="text-align:center">' .
					'<em>' .
					str_replace(
						array(
							'{br}',
							'{add_form_link}'
						),
						array(
							'<br/>',
							fw_html_tag( 'a', array(
								'href'   => admin_url( 'post-new.php?post_type=fw-form' ),
								'target' => '_blank',
							), esc_html__( 'create a new Form', 'seosight' ) )
						),
						__( 'No Forms created yet. Please go to the {br}Forms page and {add_form_link}.', 'seosight' )
					) .
					'</em>' .
					'</p>'
			)

		);
	}
	kc_add_map(
		array(
			'fw_form' => array(
				'name'        => esc_html__( 'Form', 'seosight' ),
				'description' => esc_html__( 'Display theme form', 'seosight' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-contact-form',
				'category'    => esc_html__( 'Content', 'seosight' ),
				'params'      => $options
			),  // End of elemnt kc_icon

		)
	); // End add map
}

add_action( 'admin_footer', '_action_seosight_enable_fw_forms' );
function _action_seosight_enable_fw_forms() {
	if ( fw()->extensions->manager->can_activate() ) {
		fw()->extensions->manager->activate_extensions( array( 'forms' => array(), 'builder' => array() ) );
	}
}

add_action( 'updated_post_meta', '_action_seosight_cpt_form_save', 0, 4 );
function _action_seosight_cpt_form_save() {
	global $post;
	if ( ! empty( $post ) && $post->post_type == 'crum-form' ) {
		$form_meta = get_post_meta( $post->ID, 'fw_options', true );
		if ( ! empty( $form_meta ) ) {
			update_option( 'fw:ext:cf:fd:' . $post->ID, $form_meta );
		}
	}
}

add_action( 'trashed_post', '_action_seosight_cpt_form_delete' );
function _action_seosight_cpt_form_delete( $post_id ) {
	if ( 'crum-form' == get_post_type( $post_id ) ) {
		delete_option( 'fw:ext:cf:fd:' . $post_id );
	}
}

