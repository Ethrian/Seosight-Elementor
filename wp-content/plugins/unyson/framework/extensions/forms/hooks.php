<?php if (!defined('FW')) die('Forbidden');

/**
 * @internal
 * @param array $widths Default widths
 * @return array
 */
function _filter_ext_forms_change_builder_item_widths($widths) {
	foreach ($widths as &$width) {
		$width['frontend_class'] .= ' form-builder-item';
	}

	return $widths;
}
add_filter('fw_builder_item_widths:form-builder', '_filter_ext_forms_change_builder_item_widths');

function _action_fw_ext_forms_option_types_init() {
	require dirname(__FILE__) .'/includes/option-types/form-builder/class-fw-option-type-form-builder.php';
}
add_action('fw_option_types_init', '_action_fw_ext_forms_option_types_init');


/**
 * Register types for custom form shortcode
 */
 if ( ! function_exists('_crum_ext_form_createLabels') ){	 
	function _crum_ext_form_createLabels( $overrides = array() ) {
	$defaults = array(

		'name'               => __( 'Forms', 'unyson' ),
		'singular_name'      => __( 'Form', 'unyson' ),
		'menu_name'          => __( 'Forms', 'unyson' ),
		'name_admin_bar'     => __( 'Form', 'unyson' ),
		'add_new'            => __( 'Add New', 'unyson' ),
		'add_new_item'       => __( 'Add New Form', 'unyson' ),
		'new_item'           => __( 'New Form', 'unyson' ),
		'edit_item'          => __( 'Edit Form', 'unyson' ),
		'view_item'          => __( 'View Form', 'unyson' ),
		'view_items'         => __( 'View Forms', 'unyson' ),
		'all_items'          => __( 'All Forms', 'unyson' ),
		'search_items'       => __( 'Search Forms', 'unyson' ),
		'parent_item_colon'  => __( 'Parent Forms:', 'unyson' ),
		'attributes'         => __( 'Form Attributes', 'unyson' ),
		'not_found'          => __( 'No Forms found.', 'unyson' ),
		'not_found_in_trash' => __( 'No Forms found in Trash.', 'unyson' )
	);

	return wp_parse_args( $overrides, $defaults );
	}
}

$crum_form_args = array(
	'labels'             => _crum_ext_form_createLabels(),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'form' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => 20,
	'menu_icon'          => 'dashicons-editor-table',
	'supports'           => array( 'title', 'thumbnail', 'page-attributes' )
);
if ( function_exists( 'fw_ext' ) && fw_ext( 'forms' ) ) {
	register_post_type( 'crum-form', $crum_form_args );
}

if( wp_doing_ajax() ) {
	add_action( 'wp_ajax_nopriv_widget_contact_form', 'crum_widget_contact_form' );
	add_action( 'wp_ajax_widget_contact_form', 'crum_widget_contact_form' );
}
function crum_widget_contact_form() {

	check_ajax_referer( 'widget_contact_form', 'security' );

	$mail_to = isset( $_POST['mail_to'] ) ? strip_tags( trim( $_POST['mail_to'] ) ) : '';

	// Required fields
	$email = isset( $_POST['email'] ) ? strip_tags( trim( $_POST['email'] ) ) : '';
	$name  = isset( $_POST['name'] ) ? strip_tags( trim( $_POST['name'] ) ) : '';
	$text  = isset( $_POST['message'] ) ? strip_tags( trim( $_POST['message'] ) ) : '';

	try {
		if (empty($email) || empty($name) || empty($text)) {
			throw new Exception('Bad form parameters. Check the markup to make sure you are naming the inputs correctly.');
		}
		if (!is_email($email)) {
			throw new Exception('Email address not formatted correctly.');
		}
		if (!is_email($email)) {
			throw new Exception('Email address not formatted correctly.');
		}

		// Additional fields
		$subject   = isset( $_POST['subject'] ) ? strip_tags( trim( $_POST['subject'] ) ) : '';
		$permalink = isset( $_POST['permalink'] ) ? strip_tags( trim( $_POST['permalink'] ) ) : '';
		$phone     = isset( $_POST['phone'] ) ? strip_tags( trim( $_POST['phone'] ) ) : '';
		$company   = isset( $_POST['company'] ) ? strip_tags( trim( $_POST['company'] ) ) : '';

		$mail_subject = $subject != '' ? $subject : esc_html__('From Contact form on website','fw');

		$message = '<h3>' . esc_html__( 'You got a mail from website:', 'fw' ) . ' ' . $_SERVER['HTTP_HOST'] . '</h3>' . '<br/>';
		$message .= '<b>' . esc_html__( 'Name:', 'fw' ) . '</b> ' . $name . '<br/>';
		$message .= '<b>' . esc_html__( 'Email:', 'fw' ) . '</b> ' . $email . '<br/>';

		if ( ! empty( $permalink ) ) {
			$message .= '<b>' . esc_html__( 'Website:', 'fw' ) . '</b> ' . $permalink . '<br/>';
		}
		if ( ! empty( $phone ) ) {
			$message .= '<b>' . esc_html__( 'Phone:', 'fw' ) . '</b> ' . $phone . '<br/>';
		}
		if ( ! empty( $company ) ) {
			$message .= '<b>' . esc_html__( 'Company:', 'fw' ) . '</b> ' . $company . '<br/>';
		}

		$message .= '<b>' . esc_html__( 'Message:', 'fw' ) . '</b> ' . $text . '<br/>';


		$headers = "From: ". $name . "<" . strip_tags($email) . ">\r\n";
		$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		if (wp_mail($mail_to, $mail_subject, $message, $headers)) {
			echo json_encode(array('status' => 'success', 'message' => 'Contact message sent.'));
			exit;
		} else {
			throw new Exception('Failed to send email. Check AJAX handler.');
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		exit;
	}
}