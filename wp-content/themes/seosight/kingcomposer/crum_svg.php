<?php
/*----------------------------------
 * Animated SVG shortcode
 *--------------------------------*/

$image = $animation = $css = '';

extract( $atts );

$css_classes        = apply_filters( 'kc-el-class', $atts );
$element_attributes = array();

$svg_url = wp_get_attachment_url( $image );

$css_classes = array_merge( $css_classes, array(
	'crumina-module ',
	'animated-svg'
));

if ( 'yes' === $animation && ( ! isset( $_GET['kc_action'] ) || $_GET['kc_action'] !== 'live-editor' ) ) {
	$css_classes[] = 'js-animate-icon';
}
$css_class            = implode(' ', $css_classes);
$element_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"'; ?>
<div <?php echo implode( ' ', $element_attributes ) ;?>>
    <?php

    $svg_file     = wp_remote_get( esc_url_raw( $svg_url ) );
    $svg_file = wp_remote_retrieve_body( $svg_file );

    $find_string  = '<svg';
    $position     = strpos( $svg_file, $find_string );
    $svg_file_new = substr( $svg_file, $position );
    seosight_render( $svg_file_new );
    ?>
</div>

<?php kc_js_callback( 'kc_front.refresh' ); ?>