<?php
/** @var array $atts */
$title = $desc = $show_link = $link = $data_text = $data_button = '';
$layout       = 'standard';

$main_class = apply_filters( 'kc-el-class', $atts );

extract( $atts );

$main_class[] = 'crumina-module';
$main_class[] = 'call-to-action';
$main_class[] = 'cta-' . $layout;

if ( 'yes' === $show_link && 'center' !== $layout ) {
	$row_class         = 'row table';
	$title_wrap_class  = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 table-cell';
	$button_wrap_class = 'col-lg-3 col-md-3 col-sm-12 col-xs-12 table-cell align-right';
} else {
	$row_class         = 'row';
	$title_wrap_class  = 'col-sm-12 text-center align-center mb30';
    $button_wrap_class = 'col-sm-12 align-center';
}
if ( ! empty( $custom_class ) ) {
    $main_class[] = $custom_class;
}


if ( ! empty( $title ) ) {
	$data_text .= '<h2 class="h1 heading-title no-margin">' . esc_html( $title ) . '</h2>';
}
if ( ! empty( $desc ) ) {
	$data_text .= '<div class="h5 heading-text no-margin">' . esc_html( $desc ) . '</div>';
}


if ( $show_link == 'yes' ) {
    $link        = ( '||' === $link ) ? '' : $link;
    $button_link = kc_parse_link( $link );

    if ( strlen( $button_link['url'] ) > 0 ) {
        $button_href   = $button_link['url'];
        $button_title  = ! empty( $button_link['title'] ) ? $button_link['title'] : esc_html__( 'Read More', 'seosight' );
        $button_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

        $btn_class = array( 'btn', ' btn-hover-shadow' );
        if ( 'yes' == $outlined ) {
            $btn_class[] = 'btn-border';
        }
        $btn_class[] = 'btn-' . esc_attr( $btn_size );
        $btn_class[] = 'btn--' . esc_attr( $btn_color );

        $data_button .= '<div class="' . esc_attr( $button_wrap_class ) . '">';
        $data_button .= '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '"';
        $data_button .= 'class="' . esc_attr( implode( ' ', $btn_class ) ) . '" >';
        $data_button .= '<span class="text">' . esc_html( $button_title ) . ' </span><span class="semicircle"></span>';
        $data_button .= '</a>';
        $data_button .= '</div>';
    }
} ?>

<div class="<?php echo implode( ' ', $main_class ); ?>">
    <div class="<?php echo esc_attr( $row_class ) ?>">
        <div class="<?php echo esc_attr( $title_wrap_class ) ?>">
            <?php seosight_render( $data_text ); ?>
        </div>
        <?php seosight_render( $data_button ); ?>
    </div>
</div>