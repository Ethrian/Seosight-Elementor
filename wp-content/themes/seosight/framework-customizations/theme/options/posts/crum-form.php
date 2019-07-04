<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'type'    => 'box',
		'title'   => '',
		'options' => array(

			'id'       => array(
				'type' => 'unique',
			),
			'builder'  => array(
				'type'    => 'tab',
				'title'   => __( 'Form Fields','seosight' ),
				'options' => array(
					'form' => array(
						'label'        => false,
						'type'         => 'form-builder',
						'value'        => array(
							'json' => apply_filters( 'fw:ext:forms:builder:load-item:form-header-title', true )
								? json_encode( array(
									array(
										'type'      => 'form-header-title',
										'shortcode' => 'form_header_title',
										'width'     => '',
										'options'   => array(
											'title'    => '',
											'subtitle' => '',
										)
									)
								) )
								: '[]'
						),
						'fixed_header' => true,
					),
				),
			),
			'settings' => array(
				'type'    => 'tab',
				'title'   => __( 'Settings','seosight' ),
				'options' => array(
					'settings-options' => array(
						'title'   => __( 'Options','seosight' ),
						'type'    => 'tab',
						'options' => array(
							'form_text_settings'  => array(
								'type'    => 'group',
								'options' => array(
									'subject-group'       => array(
										'type'    => 'group',
										'options' => array(
											'subject_message' => array(
												'type'  => 'text',
												'label' => __( 'Subject Message','seosight' ),
												'desc'  => __( 'This text will be used as subject message for the email','seosight' ),
												'value' => __( 'New message','seosight' ),
											),
										)
									),
									'submit-button-group' => array(
										'type'    => 'group',
										'options' => array(
											'submit_button_text' => array(
												'type'  => 'text',
												'label' => __( 'Submit Button','seosight' ),
												'desc'  => __( 'This text will appear in submit button','seosight' ),
												'value' => __( 'Send','seosight' ),
											),
										)
									),
									'success-group'       => array(
										'type'    => 'group',
										'options' => array(
											'success_message' => array(
												'type'  => 'text',
												'label' => __( 'Success Message','seosight' ),
												'desc'  => __( 'This text will be displayed when the form will successfully send','seosight' ),
												'value' => __( 'Message sent!','seosight' ),
											),
										)
									),
									'failure_message'     => array(
										'type'  => 'text',
										'label' => __( 'Failure Message','seosight' ),
										'desc'  => __( 'This text will be displayed when the form will fail to be sent','seosight' ),
										'value' => __( 'Oops something went wrong.','seosight' ),
									),
								),
							),
							'form_email_settings' => array(
								'type'    => 'group',
								'options' => array(
									'email_to' => array(
										'type'  => 'text',
										'label' => __( 'Email To','seosight' ),
										'help'  => __( 'We recommend you to use an email that you verify often','seosight' ),
										'desc'  => __( 'The form will be sent to this email address.','seosight' ),
									),
								),
							),


						)
					),
					'mailer-options'   => array(
						'title'   => __( 'Mailer','seosight' ),
						'type'    => 'tab',
						'options' => array(
							'mailer' => array(
								'label' => false,
								'type'  => 'mailer'
							)
						)
					)
				),
			)
		)
	)
);