<?php
/** @var array $atts */
$contact_form_id = $wrap_class = $color_form = $color_btn = '';
$form_tags       = $submit_atts = array();

extract( $atts );

//Kingcomposer wrapper class for each element
$wrap_class = apply_filters( 'kc-el-class', $atts );
//custom class element
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'contact-form';

if ( isset( $contact_form_id ) && $contact_form_id > 0 ) { ?>
    <div class="<?php echo implode( ' ', $wrap_class ); ?>">
		<?php
		$form_html = do_shortcode( '[contact-form-7 id="' . $contact_form_id . '"]' );

		if ( 'dark' === $color_form ) {
			$form_html = str_replace( 'wpcf7-form-control-wrap', 'wpcf7-form-control-wrap input-dark', $form_html );
		} else {
			$form_html = str_replace( 'wpcf7-form-control-wrap', 'wpcf7-form-control-wrap input-standard-grey', $form_html );
		}

		preg_match_all( '/<input[^>]+>/i', $form_html, $result );
		$result = array_shift( $result );
		foreach ( $result as $input ) {
			preg_match_all( '/(class|value|type)=("[^"]*")/i', $input, $form_tags[ $input ] );
		}

		$submit_input = preg_grep("/type=\"submit\"/", $result);
		$submit_input = array_shift( $submit_input );

		foreach ( $form_tags as $tag ) {
			if ( '"submit"' === $tag[2][0] ) {
				$submit_atts = $tag[2];
			}
		}
		$button_text = str_replace( '"', '', $submit_atts[1] );
		$button_class = $submit_atts[2];

		$button_html = '<button class="btn-hover-shadow btn btn-medium btn--' . esc_attr( $color_btn . ' ' . $button_class ) . '"><span class="text">' . esc_html( $button_text ) . '</span><span class="semicircle"></span></button>';
		$form_html   = str_replace( $submit_input, $button_html, $form_html );

		seosight_render( $form_html );
		?>
    </div>
<?php } else { ?>
	<?php esc_html_e( 'Please create new and select contact form 7.', 'seosight' ); ?>
<?php } ?>
<?php kc_js_callback( 'kc_front.refresh' ); ?>
