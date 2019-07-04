<?php
/**
 * Unyson slider shortcode
 **/

$tab_id = $title = '';
extract( $atts );

$css_class = apply_filters( 'kc-el-class', $atts ); ?>
<div class="<?php echo esc_attr( implode( ' ', $css_class ) ) ?>">
<?php if ( ! empty( $atts['slider_id'] ) ) {
	echo fw()->extensions->get( 'slider' )->render_slider( $atts['slider_id'],
		array() );
} ?>
    </div><?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>