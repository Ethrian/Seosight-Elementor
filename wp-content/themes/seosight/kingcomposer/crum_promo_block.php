<?php
/** @var array $atts */
$title   = $desc = $image = $image_hover = $show_link = $link_button = $link = $custom_class = $data_img = $data_icon = $data_title = $data_desc = $data_position = $data_button = $media = '';
$btn_color  = $btn_size = $outlined = '';
$wrap_class = apply_filters( 'kc-el-class', $atts );

global $allowedtags;

extract( $atts );

$wrap_class = array_merge(
        array(
	        'crumina-module',
	        'crumina-servises-item',
                'bg-border-color',
	        'servises-item-reverse-color'
        ), $wrap_class
);

if ( ! empty( $custom_class ) ) {
    $wrap_class[] = $custom_class;
}

if ( ! empty( $image ) || ! empty( $image_hover ) ) {
	$data_img .= '<div class="servises-item__thumb">';
    if ( ! empty( $image_hover ) ) {
        $img_link = wp_get_attachment_image_src( $image_hover, 'full' );
        $data_img .= '<img src="' . $img_link[0] . '" alt="' . esc_attr( $title ) . '" class="hover">';
    }
    if ( ! empty( $image ) ) {
        $img_link = wp_get_attachment_image_src( $image, 'full' );
        $data_img .= '<img src="' . $img_link[0] . '" alt="' . esc_attr( $title ) . '">';
    }
    $data_img .= '</div>';
}

    $link        = ( '||' === $link ) ? '' : $link;
    $button_link = kc_parse_link( $link );

    if ( strlen( $button_link['url'] ) > 0 ) {
        $button_href   = $button_link['url'];
        $button_title  = ! empty( $button_link['title'] ) ? $button_link['title'] : '';
        $button_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

        if ( 'yes' === $link_button ) {
	        $btn_class = array( 'btn', 'btn-hover-shadow', 'btn-reverse-bg-color-dark' );
            if ('yes' == $outlined){
                $btn_class[] = 'btn-border';
            }
            $btn_class[] = 'btn-' . esc_attr( $btn_size );
            $btn_class[] = 'btn--' . esc_attr( $btn_color );

            $data_button .= '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '"';
            $data_button .= 'class="'. esc_attr( implode(' ', $btn_class ) ) .'" >';
            $data_button .= '<span class="text">' . esc_html( $button_title ) . ' </span><span class="semicircle"></span>';
            $data_button .= '</a>';
        } else {
            $data_button .= '<a class="promo-link" href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '"><span class="text">' . esc_html( $button_title ) . ' </span><i class="seoicon-right-arrow"></i></a>';
    }
	    if ( ! empty( $title ) ) {
		    $title = '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '">' . esc_html( $title ) . '</a>';
	    }
    }
?>
<div class="<?php echo implode( ' ', $wrap_class ); ?>">

    <?php seosight_render( $data_img ); ?>

    <?php if ( ! empty( $title ) ) { ?>
        <h5 class="servises-title"><?php echo wp_kses( $title, $allowedtags ) ?></h5>
    <?php } ?>
    <?php if ( ! empty( $desc ) ) { ?>
        <p class="servises-text"><?php echo do_shortcode( $desc ); ?></p>
    <?php } ?>

	<?php seosight_render( $data_button ); ?>
</div>