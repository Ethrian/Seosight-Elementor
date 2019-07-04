<?php
/** @var array $atts */
$wrap_class = $number_of_items = $arrows = $dots = $autoscroll = $time = $custom_class = '';
$options    = $slider_attr = array();

extract( $atts );

//Kingcomposer wrapper class for each element.
$module_class = apply_filters( 'kc-el-class', $atts );
$wrap_class   = array( 'clients-slider-module', 'crumina-module' );

//custom class element
$wrap_class[] = $custom_class;

$wrap_class = array_merge( $module_class, $wrap_class );

$slider_attr[] = 'data-show-items="' . esc_attr( $number_of_items ) . '"';

if ( 'yes' === $autoscroll ) {
    $slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
}
if ( 'yes' === $arrows ) {
	$pagination_class = 'pagination-bottom-large';
} elseif ( 'yes' === $dots ) {
	$pagination_class = 'pagination-bottom';
} else {
	$pagination_class = '';
}


?>

<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <?php if ( ! empty( $options ) ) { ?>
        <div class="swiper-container <?php echo esc_attr( $pagination_class ) ?>" <?php echo implode( ' ', $slider_attr ); ?>>
            <div class="swiper-wrapper">

                <?php foreach ( $options as $option ) {
	                $link_att = array();
                    $image = $option->image;
                    $link  = $option->link;
                    if ( $image > 0 ) {
                        $img_link   = wp_get_attachment_image_src( $image, 'full' );
                        $img_link   = $img_link[0];
                        $link       = ( '||' === $link ) ? '' : $link;
                        $link       = kc_parse_link( $link );
                        $link_att[] = 'class="client-image"';

                        if ( strlen( $link['url'] ) > 0 ) {
                            $has_link   = true;
                            $a_target   = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                            $link_att[] = 'href="' . esc_attr( $link['url'] ) . '"';
                            $link_att[] = 'target="' . esc_attr( $a_target ) . '"';
                            $link_att[] = 'title="' . esc_attr( $link['title'] ) . '"';
                        }
                        $data_image = '<img src="' . esc_url( $img_link ) . '" alt="hover" class="hover">';
                        ?>
                        <div class="swiper-slide client-item">
                            <?php if ( $has_link ) {
                                echo '<a ' . implode( ' ', $link_att ) . '>';
                                seosight_render( $data_image );
                                echo '</a>';
                            } else {
                                seosight_render( $data_image );
                            } ?>
                        </div>
                    <?php }
                } ?>
            </div>
            <?php if ( 'yes' === $arrows ) {
                ?>
                <!--Prev Next Arrows-->
                <svg class="btn-next">
                    <use xlink:href="#arrow-right"></use>
                </svg>
                <svg class="btn-prev">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            <?php } elseif ( 'yes' === $dots ) { ?>
                <!-- Slider pagination -->
                <div class="swiper-pagination"></div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>