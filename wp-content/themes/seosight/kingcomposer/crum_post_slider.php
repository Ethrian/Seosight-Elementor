<?php
/** @var array $atts */
$output      = $number_post = $show_date = $show_author = $number_of_items = $wrap_class = $taxonomy = $thumbnail = $show_button = $css = $post_taxonomy = '';
$dots        = $dots_position = $autoscroll = $time = '';
$slider_attr = $slider_class = array();
extract( $atts );

$wrp_el_classes = apply_filters( 'kc-el-class', $atts );

$orderby = isset( $order_by ) ? $order_by : 'ID';
$order   = isset( $order_list ) ? $order_list : 'ASC';

$post_taxonomy_data = explode( ',', $post_taxonomy );
$taxonomy_term      = array();
$post_type          = 'post';

if ( isset( $post_taxonomy_data ) ) {
	foreach ( $post_taxonomy_data as $post_taxonomy ) {
		$post_taxonomy_tmp = explode( ':', $post_taxonomy );
		$post_type         = $post_taxonomy_tmp[0];

		if ( isset( $post_taxonomy_tmp[1] ) ) {
			$taxonomy_term[] = $post_taxonomy_tmp[1];
		}
	}
}

$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
$taxonomy         = key( $taxonomy_objects );

$args = array(
	'post_type'        => $post_type,
	'posts_per_page'   => $number_post,
	'orderby'          => $orderby,
	'order'            => $order,
	'suppress_filters' => false
);
if ( count( $taxonomy_term ) ) {
	$tax_query = array(
		'relation' => 'OR'
	);
	foreach ( $taxonomy_term as $term ) {
		$tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term,
		);
	}
	$args['tax_query'] = $tax_query;
}

$the_query = new WP_Query( $args );

$element_attribute = array();

$el_classess = array(
	'crumina-module',
	'news-slider-module',
	$custom_class
);
$wrap_class  = array_merge( $el_classess, $wrp_el_classes );

$slider_attr[] = 'data-show-items="' . esc_attr( $number_of_items ) . '"';
$slider_attr[] = 'data-scroll-items="' . esc_attr( $number_of_items ) . '"';

$slider_attr[] = 'data-loop="false"';
if ( 'yes' === $autoscroll ) {
	$slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
	$slider_attr[] = 'data-loop="true"';
}

if ( 'top' === $dots_position ) {
	$dots_class     = 'swiper-pagination top-right';
	$slider_class[] = 'top-pagination';
} else {
	$slider_class[] = 'pagination-bottom';
	$dots_class     = 'swiper-pagination gray';
}
/* portfolio format settings*/
$container_width = 1170;
$gap_paddings    = 90;
$grid_size       = intval( 12 / $number_of_items );
$img_width       = intval( $container_width / ( 12 / $grid_size ) ) - $gap_paddings;
$img_height      = intval( $img_width * 0.75 );
$default_src     = kc_asset_url( 'images/get_start.jpg' );

?>
    <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
		<?php if ( ! $the_query->have_posts() ) {
			echo '<h2>' . esc_html__( ' No posts found', 'seosight' ) . '</h2>';
		} else { ?>
            <div class="swiper-container <?php echo implode( ' ', $slider_class ); ?>" <?php echo implode( ' ', $slider_attr ); ?>>
                <div class="swiper-wrapper">
					<?php if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post(); ?>
                            <div class="swiper-slide">
								<?php if ( 'portfolio' === $layout ) { ?>
                                    <div class="crumina-case-item">
                                        <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                            <a href="<?php the_permalink() ?>">
												<?php
												$thumbnail_id = get_post_thumbnail_id();
												if ( ! empty( $thumbnail_id ) ) {
													$thumbnail       = get_post( $thumbnail_id );
													$image           = fw_resize( $thumbnail->ID, $img_width, $img_height, true );
													$thumbnail_title = $thumbnail->post_title;
												} else {
													$image           = $default_src;
													$thumbnail_title = $image;
												} ?>
                                                <img src="<?php echo esc_url( $image ) ?>"
                                                     width="<?php echo esc_attr( $img_width ) ?>"
                                                     height="<?php echo esc_attr( $img_height ) ?>"
                                                     alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
                                            </a>
                                        </div>
                                        <a class="case-item__title"
                                           href="<?php the_permalink() ?>"><?php the_title(); ?></a>
										<?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat">', ', ', '</div>' ); ?>
                                    </div>

								<?php } else { ?>
                                    <article class="hentry post">
										<?php if ( 'yes' === $show_date ) {
											echo seosight_posted_time( false );
										} ?>
                                        <div class="post__content">
											<?php the_title( '<h5 class="entry-title"><a class="post__title" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>

											<?php if ( ! has_excerpt() ) {
												$post_content = get_the_content();
											} else {
												$post_content = get_the_excerpt();
											}
											$post_content = strip_shortcodes( $post_content );
											?>
                                            <p class="post__text">
												<?php echo wp_trim_words( $post_content, 10, '' ); ?>
                                            </p>
                                        </div>
										<?php if ( 'yes' === $show_author ) {
											seosight_post_author_avatar( get_the_author_meta( 'ID' ) );
										} ?>
                                    </article>

								<?php } ?>
                            </div>
							<?php
						}
					}
					wp_reset_postdata(); ?>
                </div>
				<?php if ( 'yes' === $dots ) { ?>
                    <!-- Slider pagination -->
                    <div class="<?php echo esc_attr( $dots_class ) ?>"></div>
				<?php } ?>
            </div>
		<?php } ?>
    </div>

<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>