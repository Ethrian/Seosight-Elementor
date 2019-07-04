<?php
/** @var array $atts */
$title      = $desc = $icon = $image = $position = $show_link = $link_button = $link = $custom_class = $data_img = $data_icon = $data_title = $data_desc = $data_position = $data_button = $media = '';
$btn_color  = $btn_size = $outlined = '';
$layout     = 'standard';
$wrap_class = apply_filters( 'kc-el-class', $atts );

global $allowedposttags;

extract( $atts );
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-info-box';
$wrap_class[] = 'info-box--' . $layout;

if ( ! empty( $custom_class ) ) {
    $wrap_class[] = $custom_class;
}


if ( 'image' === $media && $image > 0 ) {
    $img_link = wp_get_attachment_image_src( $image, 'full' );
    $img_alt = esc_attr(trim(strip_tags($title)));
    $img_alt = !empty($img_alt) ? $img_alt : 'Icon';
    $data_img .= '<img src="' . $img_link[0] . '" alt="' . $img_alt . '">';

} else {
    if ( empty( $icon ) || $icon == '__empty__' ) {
        $icon = 'et-trophy';
    }

    $data_img .= '<i class="' . $icon . '"></i>';
}

if ( $show_link == 'yes' ) {
    $link        = ( '||' === $link ) ? '' : $link;
    $button_link = kc_parse_link( $link );

    if ( strlen( $button_link['url'] ) > 0 ) {
        $button_href   = $button_link['url'];
        $button_title  = ! empty( $button_link['title'] ) ? $button_link['title'] : esc_html__( 'Read More', 'seosight' );
        $button_target = ! empty( $button_link['target'] ) ? $button_link['target'] : '_self';

        if ( 'yes' === $link_button ) {
            $btn_class = array('btn', ' btn-hover-shadow');
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
            $data_button .= '<a class="read-more" href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '">' . $button_title . '<i class="seoicon-right-arrow"></i></a>';
        }
	    if ( ! empty( $title ) ) {
		    $title = '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '">' . esc_html( $title ) . '</a>';
	    }
    }
} ?>
<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <div class="info-box-image">
        <?php seosight_render( $data_img ); ?>
    </div>
    <div class="info-box-content">
        <?php
        if ( ! empty( $title ) ) { ?>
            <h5 class="info-box-title"><?php echo wp_kses( $title, $allowedposttags ) ?></h5>
        <?php } ?>
        <?php if ( ! empty( $desc ) ) { ?>
            <div class="info-box-text"><?php echo wp_kses( $desc, $allowedposttags ); ?></div>
        <?php } ?>
        <?php seosight_render( $data_button ) ?>
    </div>
</div>