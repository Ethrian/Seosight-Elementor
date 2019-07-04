<?php

$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();
$taxonomy               = $ext_portfolio_settings['taxonomy_name'];

$prev_post = get_adjacent_post( true, '', true, $taxonomy );
$next_post = get_adjacent_post( true, '', false, $taxonomy );


$main_project_page = fw_get_db_customizer_option( 'folio-bottom-nav/yes/page_select/0', '' );

?>
<div class="container">
	<div class="pagination-arrow">
		<?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
			<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="btn-prev-wrap">
				<svg class="btn-prev">
					<use xlink:href="#arrow-left"></use>
				</svg>
				<span class="btn-content">
				<span class="btn-content-title"><?php esc_html_e( 'Previous Project', 'seosight' ) ?></span>
				<span class="btn-content-subtitle"><?php echo get_the_title( $prev_post->ID ); ?></span>
			</span>
			</a>
		<?php } ?>
		<?php if ( ! empty( $main_project_page ) ) { ?>
			<a href="<?php the_permalink( $main_project_page ) ?>" class="all-project">
				<i class="seoicon-shapes"></i>
			</a>
		<?php } ?>
		<?php if ( is_a( $next_post, 'WP_Post' ) ) { ?>
			<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="btn-next-wrap">
				<div class="btn-content">
					<div class="btn-content-title"><?php esc_html_e( 'Next Project', 'seosight' ) ?></div>
					<p class="btn-content-subtitle"><?php echo get_the_title( $next_post->ID ); ?></p>
				</div>
				<svg class="btn-next">
					<use xlink:href="#arrow-right"></use>
				</svg>
			</a>
		<?php } ?>
	</div>
</div>