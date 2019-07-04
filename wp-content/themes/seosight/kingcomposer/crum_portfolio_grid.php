<?php
/** @var array $atts */
$output = $number_post = $number_of_items = $wrap_class = $taxonomy = $css = $post_taxonomy = '';

extract( $atts );


$wrp_el_classes = apply_filters( 'kc-el-class', $atts );

$orderby = isset( $order_by ) ? $order_by : 'ID';
$order   = isset( $order_list ) ? $order_list : 'ASC';

$post_taxonomy_data = explode( ',', $post_taxonomy );
$taxonomy_term      = array();
$post_type          = 'fw-portfolio';

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

$el_classess = array(
	'crumina-module',
	'portfolio-grid',
	$custom_class
);
$wrap_class  = array_merge( $el_classess, $wrp_el_classes );

/* portfolio format settings*/
$container_width = 1170;
$gap_paddings    = 90;
$grid_size       = intval( 12 / $number_of_items );
$img_width       = intval( $container_width / ( 12 / $grid_size ) ) - $gap_paddings;
$img_height      = intval( $img_width * 0.75 );
$default_src     = kc_asset_url( 'images/get_start.jpg' );
$item_class_add  = $grid_size > 5 ? 'big mb60' : 'mb30';
$title_tag       = $grid_size > 5 ? 'h5' : 'h6';

ob_start();

if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$open_link    = fw_get_db_post_option( get_the_ID(), 'open-item', 'default' );
		$thumbnail_id = get_post_thumbnail_id();

		if ( isset( $open_link ) && $open_link === 'lightbox' ) {
			$permalink  = wp_get_attachment_image_src( $thumbnail_id, 'full' );
			$permalink  = $permalink[0];
			$link_class = 'js-zoom-image';
		} else {
			$permalink  = get_the_permalink();
			$link_class = '';
		}
		?>
        <div class="col-lg-<?php echo esc_attr( $grid_size ) ?> col-md-<?php echo esc_attr( $grid_size ) ?> col-sm-6 col-xs-12">
            <div class="crumina-case-item <?php echo esc_attr( $item_class_add ) ?>" data-mh="recent-folio-grid">
                <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                    <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr( $link_class ) ?>">
						<?php
						if ( ! empty( $thumbnail_id ) ) {
							$thumbnail       = get_post( $thumbnail_id );
							$image           = fw_resize( $thumbnail->ID, $img_width, $img_height, true );
							$thumbnail_title = $thumbnail->post_title;
						} else {
							$image           = $default_src;
							$thumbnail_title = $image;
						} ?>
                        <img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
                             height="<?php echo esc_attr( $img_height ) ?>"
                             alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
                    </a>
                </div>
                <a href="<?php echo esc_url( $permalink ) ?>"
                   class="<?php echo esc_attr( $title_tag ) . ' ' . esc_attr( $link_class ) ?> case-item__title"><?php the_title(); ?></a>
				<?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat">', ', ', '</div>' ); ?>
            </div>
        </div>
		<?php
	}
} else {

}
wp_reset_postdata();
$output = ob_get_clean();

?>
<div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
	<?php if ( ! $the_query->have_posts() ) {
		echo '<h2>' . esc_html__( ' No posts found', 'seosight' ) . '</h2>';
	} else { ?>
        <div class="row">
			<?php seosight_render( $output ); ?>
        </div>
	<?php } ?>
</div>