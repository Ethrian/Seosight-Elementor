<?php
/** @var array $atts */
$effect     = $loop = $autoscroll = $slider_autoplay_attr = '';
$wrap_class = apply_filters( 'kc-el-class', $atts );
$time       = 10;

extract( $atts );

if ( ! empty( $el_class ) ) {
	$wrap_class[] = $el_class;
}
if ( ! isset( $effect ) || empty( $effect ) ) {
	$effect = 'slide';
}
$loop = isset( $loop ) && $loop === 'yes' ? 'true' : 'false';
if ( isset( $autoscroll ) && 'yes' === $autoscroll ) {
	$slider_autoplay_attr = 'data-autoplay=' . esc_attr( intval( $time ) * 1000 ) . '';
}

preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );

$i   = 1;
$all = 0;
if ( isset( $matches[0] ) ) {
	$all = count( $matches[0] );
}

if ( isset( $_GET['kc_action'] ) && $_GET['kc_action'] === 'live-editor' ) { ?>
    <div class="<?php echo implode( ' ', $wrap_class ) ?>" style="width: 100%;">
        <h1 class=" heading-title">Not available to edit on frontend</h1>
        <div class="heading-decoration"><span class="first"></span><span class="second"></span></div>
            <h5>For best performance, the Module has been disabled in frontend editing mode. Please use Backend editor</h5>
    </div>
<?php } else { ?>
    <div class="<?php echo implode( ' ', $wrap_class ) ?>">
		<?php if ( $all > 0 ) { ?>
        <!-- Slider main container -->
        <div class="swiper-container pagination-vertical"
             data-direction="vertical" <?php echo esc_attr( $slider_autoplay_attr ) ?>
             data-loop="<?php echo esc_attr( $loop ) ?>" data-mouse-scroll="true"
             data-effect="<?php echo esc_attr( $effect ) ?>">

            <div class="swiper-wrapper">
                <?php foreach ( $matches[0] as $single_shortcode ) {
                    echo '<div class="swiper-slide">';
                    echo do_shortcode( $single_shortcode );
                    echo '</div>';
	                $i ++;
                }
                } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
<?php } ?>