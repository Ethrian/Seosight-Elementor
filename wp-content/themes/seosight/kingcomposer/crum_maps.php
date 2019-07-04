<?php
/*
 * Google maps shortcode template
 */


$random_id        = $google_js = $address = $custom_marker = $marker = $map_zoom = $map_style = $api_key = $map_type = $output = $wrap_class = $disable_scrolling = '';
$map_width        = '100%';
$map_height       = '350px';
$language         = substr( get_locale(), 0, 2 );
$google_maps_info = array();

extract( $atts );

$css_classes = apply_filters( 'kc-el-class', $atts );

$element_attributes = array();
$map_attributes     = array();

$css_classes = array_merge( $css_classes, array(
	'google-map'
) );

if ( ! empty( $wrap_class ) ) {
	$css_classes[] = $wrap_class;
}
if ( 'yes' === $google_js ) {
	wp_enqueue_script(
		'google-maps-api-v3',
		'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places&language=' . $language,
		array(),
		'3.15',
		false
	);
	wp_enqueue_script(
		'seosight-shortcode-map-script',
		get_template_directory_uri() . '/js/map-shortcode.js',
		array( 'jquery' ),
		'',
		true
	);
}
$element_attributes[] = 'class="' . esc_attr( implode( ' ', $css_classes ) ) . '"';
$map_attributes[]     = 'style="height: ' . esc_attr( $map_height ) . 'px"';

$map_location = preg_replace( array( '/width="\d+"/i', '/height="\d+"/i' ), array(
	sprintf( 'width="%s"', $map_width ),
	sprintf( 'height="%d"', intval( $map_height ) )
),
	$map_location );

if ( 'yes' === $google_js ) {
	$language                        = substr( get_locale(), 0, 2 );
	$all_styles                      = _seosight_google_map_custom_styles();
	$map_data_attr['data-map-style'] = trim( $all_styles[ $map_style ][1] );
	$map_data_attr['data-locations'] = str_replace( '\\', '', $address );
	$map_data_attr['data-zoom']      = $map_zoom;
	$map_data_attr['data-key']       = $api_key;
	$map_data_attr['data-map-type']  = $map_type;
	$map_data_attr['data-disable-scrolling']  = $disable_scrolling;

	unset( $map_data_attr['data-custom-marker'] );

	if ( 'yes' === $custom_marker ) {
		if ( ! empty( $marker ) ) {
			$img_link                            = wp_get_attachment_image_src( $marker, 'thumb' );
			$img_link                            = $img_link[0];
			$map_data_attr['data-custom-marker'] = $img_link;
		}
	}
	$output .= '<div id="gmap-' . esc_attr( $random_id ) . '" ' . implode( ' ', $element_attributes ) . ' ' . fw_attr_to_html( $map_data_attr ) . '>';
	$output .= '<div class="map-canvas" ' . implode( ' ', $map_attributes ) . '></div>';
	$output .= '</div>';
} else {
	$output .= '<div ' . implode( ' ', $map_attributes ) . '>' . $map_location . '</div>';
}

seosight_render( $output );
kc_js_callback( 'CRUMINA.google_map_init' );