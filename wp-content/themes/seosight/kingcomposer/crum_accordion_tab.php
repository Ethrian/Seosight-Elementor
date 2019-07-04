<?php
/**
 * kc_accordion_tab shortcode
 **/
$id          = $panel_heading_class = $panel_link_class = $panel_content_class = '';
$css_class   = apply_filters( 'kc-el-class', $atts );
$css_class[] = 'accordion-panel';

$title = 'Title';

if ( isset( $atts['id'] ) ) {
	$id = $atts['id'];
}
if ( isset( $atts['title'] ) ) {
	$title = $atts['title'];
}
$open = isset( $atts['open'] ) && $atts['open'] == "yes" ? "true" : "false";

if ( $open === 'true' ) {
	$panel_heading_class = 'active';
	$css_class[] = 'active';
	$panel_content_class = 'collapse in';
} else {
	$panel_link_class    = 'collapsed';
	$panel_content_class = 'collapse';
}

if ( isset( $atts['class'] ) ) {
	array_push( $css_class, $atts['class'] );
}

$tab_id = uniqid( 'tab-' );

$output = '<li class="' . esc_attr( implode( ' ', $css_class ) ) . '">
                            <div class="panel-heading ' . esc_attr( $panel_heading_class ) . '">
                                <a href="#tab-' . esc_attr( $tab_id ) . '" class="accordion-heading ' . esc_attr( $panel_link_class ) . '" data-toggle="collapse" data-parent="#' . esc_attr( $id ) . '" aria-expanded="' . esc_attr( $open ) . '">
                                        <span class="icon">
                                            <i class="fa fa-angle-right default" aria-hidden="true"></i>
                                            <i class="fa fa-angle-down active" aria-hidden="true"></i>
                                        </span>
                                    <span class="ovh">' . esc_html( $title ) . '</span>
                                </a>
                            </div>
                            <div id="tab-' . esc_attr( $tab_id ) . '" class="panel-collapse ' . esc_attr( $panel_content_class ) . '" aria-expanded="false" role="tree">
                                <div class="panel-info">
                                    ' .
          ( ( '' === trim( $content ) )
	          ? esc_html__( 'Empty section. Edit page to add content here.', 'seosight' )
	          : do_shortcode( str_replace( 'kc_accordion_tab#', 'kc_accordion_tab', $content ) ) ) .
          '
                                </div>
                            </div>
                        </li>';

seosight_render( $output );