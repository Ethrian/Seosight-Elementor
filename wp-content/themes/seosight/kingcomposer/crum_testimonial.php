<?php
/** @var array $atts */
$data_author = $data_img    = $data_desc   = $name        = $author_link = $stars       = $position    = $desc        = $image       = '';
$layout      = 'arrow';
$wrap_class  = apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-testimonial-item testimonial-item-' . $layout;
if ( !empty( $custom_class ) ) {
    $wrap_class[] = $custom_class;
}

if ( $image > 0 ) {

    $img_link = wp_get_attachment_image_src( $image, 'thumbnail' );
    $img_link = $img_link[ 0 ];
    if ( 'author-centered-round' === $layout ) {
        $img_size = '85';
    } else {
        $img_size = '65';
    }
    //$img_link = fw_resize( $img_link, $img_size, $img_size, false );
    $data_img .= '<div class="testimonial-img-author">';
    $data_img .= '<img src="' . $img_link . '" alt="' . esc_html( $name ) . '">';
    $data_img .= '</div>';
}
$data_author .= '<div class="author-info">';

if ( !empty( $name ) || !empty( $position ) ) {
    if ( !empty( $name ) ) {

        $author_link   = kc_parse_link( $author_link );
        $author_href   = $author_link[ 'url' ];
        $author_title  = !empty( $author_link[ 'title' ] ) ? $author_link[ 'title' ] : $name;
        $author_target = !empty( $author_link[ 'target' ] ) ? $author_link[ 'target' ] : '_self';

        if ( $author_href ) {
            $data_author .= '<a href="' . esc_url( $author_href ) . '" target="' . esc_attr( $author_target ) . '" title="' . esc_attr( $author_title ) . '" class="h6 author-name">' . esc_html( $name ) . '</a>';
        } else {
            $data_author .= '<h6 class="author-name">' . esc_html( $name ) . '</h6>';
        }
    }
    if ( !empty( $position ) ) {
        $data_author .= '<div class="author-company">' . esc_html( $position ) . '</div>';
    }

}

$stars = (int) $stars;
$stars_html = '';
if ( $stars ) {
    ob_start();
    ?>
    <ul class="rait-stars">
        <?php for ( $i = 1; $i <= $stars; $i ++ ) { ?>
            <li>
				<svg class="seosight-icon seosight-icon-star" viewBox="0 0 512 512">
					<path d="M512 201c0-7-6-12-17-14l-155-23-69-140c-4-8-9-12-15-12s-11 4-15 12l-69 140-155 23c-11 2-17 7-17 14 0 4 3 9 8 15l112 109-27 154v6c0 4 1 8 3 11s5 4 10 4c3 0 7-1 12-3l138-73 138 73c5 2 9 3 13 3s7-1 9-4 3-7 3-11v-6l-27-154 112-109c5-5 8-10 8-15z"/>
				</svg>
            </li>
        <?php } ?>
        <?php for ( $i = $stars + 1; $i <= 5; $i ++ ) { ?>
            <li>
				<svg class="seosight-icon seosight-icon-lnr-star" viewBox="0 0 512 512">
					<path d="m397 486c-2 0-4 0-6-1l-135-74-135 74c-4 2-9 2-13-1-4-3-6-8-5-13l24-147-98-97c-3-4-4-9-3-13 2-5 6-8 10-9l147-25 62-122c2-4 6-7 11-7 5 0 9 3 11 7l62 122 147 25c4 1 8 4 10 9 1 4 0 9-3 13l-98 97 24 147c1 5-1 10-5 13-2 2-5 2-7 2z m-141-102c2 0 4 1 6 2l118 64-21-128c-1-4 0-8 3-11l85-85-129-21c-4-1-8-4-9-7l-53-105-53 105c-1 3-5 6-9 7l-129 21 85 85c3 3 4 7 3 11l-21 128 118-64c2-1 4-2 6-2z"/>
				</svg>
            </li>
        <?php } ?>
    </ul>
    <?php
    $stars_html = ob_get_clean();
    $data_author .= $stars_html;
}

$data_author .= '</div>';

if ( !empty( $desc ) ) {
    $data_desc .= '<h5 class="testimonial-text">';
    $data_desc .= esc_html( $desc );
    $data_desc .= '</h5>';
}
?>

<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <?php
    switch ( $layout ) {
        case 'arrow':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            seosight_render( $data_img );
            seosight_render( $data_author );
            echo '</div>';
            echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
            break;
        case 'author-top':
            seosight_render( $data_img );
            echo do_shortcode( $data_desc );
            seosight_render( $data_author );
            break;
        case 'author-centered':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap display-flex content-center">';
            seosight_render( $data_img );
            seosight_render( $data_author );
            echo '</div>';
            break;
        case 'author-centered-round':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            seosight_render( $data_img );
            seosight_render( $data_author );
            echo '</div>';
            break;
        case 'quote-left':
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            seosight_render( $data_author );
            echo '</div>';
            echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
            break;
        case 'modern':
            echo '<div class="testimonial-content">';
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            seosight_render( $data_author );
            echo '</div>';
            echo '</div>';
            seosight_render( $data_img );
            echo '<div class="quote"><i class="seoicon-quotes"></i></div>';

            break;
        default:
            echo do_shortcode( $data_desc );
            echo '<div class="author-info-wrap">';
            seosight_render( $data_img );
            seosight_render( $data_author );
            echo '</div>';
            break;
    }
    ?>
</div>