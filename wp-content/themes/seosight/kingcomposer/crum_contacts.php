<?php
/** @var array $atts */

$image      = $title = $subtitle = $link = $custom_class = '';
$image_html = '';
$link_att   = array();

extract( $atts );

$css_class   = apply_filters( 'kc-el-class', $atts );
$css_class[] = 'crumina-module';
$css_class[] = 'contacts-item';

if ( ! empty( $custom_class ) ) {
    $css_class[] = $custom_class;
}

if ( ! empty( $image ) ) {
    $image_data = wp_get_attachment_image_src( $image, 'full' );
    $image_url  = $image_data[0];
	$image_html = '<div class="icon"><img src="' . esc_url( fw_resize( $image_url, 96, 96, false ) ) . '" alt="icon"/></div>';
}

if ( ! empty( $link ) ) {
    $link     = ( '||' === $link ) ? '' : $link;
    $link     = kc_parse_link( $link );
    $link_att = array();

    if ( strlen( $link['url'] ) > 0 ) {
        $has_link = true;
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';

        $link_att[] = 'href="' . esc_attr( $link['url'] ) . '"';
        $link_att[] = 'target="' . esc_attr( $a_target ) . '"';
        $link_att[] = 'title="' . esc_attr( $link['title'] ) . '"';
	    $link_att[] = 'class="h5 title"';
    }
}
?>
<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
    <?php seosight_render( $image_html ); ?>
    <div class="content">
        <?php if ( ! empty( $title ) ) {
            if ( ! empty( $link ) ) { ?>
                <a <?php echo implode( ' ', $link_att ); ?>><?php echo esc_html( $title ) ?></a>
            <?php } else { ?>
                <span class="h5 title"><?php echo esc_html( $title ) ?></span>
            <?php }
        } ?>
        <?php if ( ! empty( $subtitle ) ) { ?>
            <div class="sub-title"><?php echo esc_html( $subtitle ) ?></div>
        <?php } ?>
    </div>
</div>