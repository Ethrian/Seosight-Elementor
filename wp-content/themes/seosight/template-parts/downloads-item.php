<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
global $post;
$container_width = 1170;
$gap_paddings    = 90;
$img_width       = intval( $container_width / ( 12 / 4 ) ) - $gap_paddings;
$img_height      = intval( $img_width * 0.75 );

$thumbnail_id = get_post_thumbnail_id();
$permalink    = get_the_permalink();
$link_class   = '';

?>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="crumina-case-item product-item align-center mb30" data-mh="downloads-grid-item">
        <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
            <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr( $link_class ) ?>">
				<?php
				$thumbnail_id = get_post_thumbnail_id();
				if ( ! empty( $thumbnail_id ) ) {
					$thumbnail       = get_post( $thumbnail_id );
					$image           = fw_resize( $thumbnail->ID, $img_width, $img_width, true );
					$thumbnail_title = $thumbnail->post_title;
				} else {
					$image           = get_template_directory_uri() . '/img/no-image.svg';
					$thumbnail_title = $image;
				} ?>
                <img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
                     height="<?php echo esc_attr( $img_width ) ?>" alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
            </a>
        </div>
		<?php the_terms( $post->ID, 'download_category', '<div class="case-item__cat">', ', ', '</div>' ); ?>
        <a href="<?php the_permalink() ?>" class="h5 case-item__title"><?php the_title() ?></a>
        <div class="price h6">
			<?php edd_price( $post->ID, true ); ?>
        </div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>?edd_action=add_to_cart&download_id=<?php echo esc_attr( $post->ID ); ?>"
           class="btn btn-small btn--light-green btn-hover-shadow">
            <span class="text"><?php esc_attr_e( 'Add to cart', 'seosight' ) ?></span>
            <i class="seoicon-commerce"></i>
        </a>
    </div>
</div>