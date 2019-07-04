<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 *
 *
 * @return WP_Query
 */
if ( ! function_exists( 'seosight_custom_loop' ) ) :
	function seosight_custom_loop( $post_type ) {
		if ( 'fw-portfolio' === $post_type ) {
			$per_page = fw_get_db_settings_option( 'per_page', 9 );
			$order    = fw_get_db_settings_option( 'order', 'DESC' );
			$orderby  = fw_get_db_settings_option( 'orderby', 'date' );
			$taxonomy = 'fw-portfolio-category';
		} else {
			$per_page = get_option( 'posts_per_page' );
			$order    = 'DESC';
			$orderby  = 'date';
			$taxonomy = 'category';
		}

		$meta_per_page          = fw_get_db_post_option( get_the_ID(), 'per_page' );
		$meta_order             = fw_get_db_post_option( get_the_ID(), 'order' );
		$meta_orderby           = fw_get_db_post_option( get_the_ID(), 'orderby' );
		$meta_order_by          = fw_get_db_post_option( get_the_ID(), 'order_by' );
		$meta_custom_categories = fw_get_db_post_option( get_the_ID(), 'taxonomy_select' );
		$meta_exclude           = fw_get_db_post_option( get_the_ID(), 'exclude' );


		if ( isset( $meta_per_page ) && ! empty( $meta_per_page ) ) {
			$per_page = $meta_per_page;
		}

		if ( isset( $meta_order ) && ! empty( $meta_order ) && ! ( 'default' === $meta_order ) ) {
			$order = $meta_order;
		}

		if ( isset( $meta_orderby ) && ! empty( $meta_orderby ) && ! ( 'default' === $meta_orderby ) ) {
			$orderby = $meta_orderby;
		}
		if ( isset( $meta_order_by ) && ! empty( $meta_order_by ) && ! ( 'default' === $meta_order_by ) ) {
			$orderby = $meta_order_by;
		}

		if ( is_front_page() ) {
			$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
		} else {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		}

		$args = array(
			'post_type'      => $post_type,
			'paged'          => $paged,
			'posts_per_page' => $per_page,
			'order'          => $order,
			'orderby'        => $orderby,
		);

		$search = filter_input( INPUT_GET, 'search' );
		if ( $search ) {
			$args['s'] = $search;
		}

		if ( ! empty( $meta_custom_categories ) ) {
			if ( true === $meta_exclude ) {
				$operator = 'NOT IN';
			} else {
				$operator = 'IN';
			}
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $meta_custom_categories,
					'operator' => $operator,
				),
			);
		}

		$porfolio_query = new WP_Query( $args );

		return $porfolio_query;

	}
endif;
