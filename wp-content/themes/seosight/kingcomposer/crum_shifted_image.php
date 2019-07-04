<?php
global $allowedposttags;
$output = $wrap_class = $css = $title = $desc = $image = $direction = '';

extract( $atts );

$image_atts = wp_get_attachment_image_src( $image, 'full' );
if ( ! empty( $image_atts ) ) {
    $img_src = $image_atts[0];
} else {
    $img_src = kc_asset_url( 'images/get_start.jpg' );
}

$el_class = apply_filters( 'kc-el-class', $atts );
$el_class[] = 'crumina-module';
$el_class[] = 'crumina-product-description-border';
if ( $direction === 'rightimage' ) {
	$el_class[] = 'even';
}

$el_class[]  = $wrap_class;

?>

<div class="<?php echo esc_attr( implode( ' ', $el_class ) ) ?>">


    <div class="product-description-thumb">
        <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $title ) ?>" class="shadow-image">
    </div>

    <div class="product-description-content">
        <div class="crumina-module crumina-heading">
            <h4 class="h1 heading-title"><?php echo esc_html( $title ) ?></h4>
            <div class="heading-decoration">
                <span class="first"></span>
                <span class="second"></span>
            </div>
            <div class="product-description-text"> <?php echo wp_kses( $desc, $allowedposttags ); ?></div>
            </div>
    </div>

    <div class="product-description-border"></div>
</div>