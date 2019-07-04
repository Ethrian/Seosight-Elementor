<?php
get_header();
global $wp_query;

wp_enqueue_script('isotope');

$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();

$taxonomy   = $ext_portfolio_settings['taxonomy_name'];
$term       = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
$term_id    = ( ! empty( $term->term_id ) ) ? $term->term_id : 0;
$categories = fw_ext_portfolio_get_listing_categories( $term_id );

$listing_classes = fw_ext_portfolio_get_sort_classes( $wp_query->posts, $categories );
$loop_data       = array(
	'settings'        => $ext_portfolio_instance->get_settings(),
	'categories'      => $categories,
	'listing_classes' => $listing_classes
);
set_query_var( 'fw_portfolio_loop_data', $loop_data );

$page_title = ! empty( $term->description ) ? $term->description : $term->name;
$terms      = get_terms( $taxonomy, array( 'hide_empty' => true ) );

$layout = seosight_sidebar_conf();
?>
	<!-- Case Item -->
	<div id="primary" class="container">
		<div class="row medium-padding120">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="site-main" >
					<div class="heading align-center">
						<?php echo fw_html_tag( 'h2', array( 'class' => 'h1 heading-title' ), $page_title ); ?>
					</div>
					<?php if ( ! empty( $terms ) ) : ?>
						<ul class="cat-list align-center">
							<?php foreach ( $terms as $term ) : ?>
								<?php $active = ( $term->term_id == $term_id ) ? 'active' : ''; ?>
								<li class="cat-list__item <?php echo esc_attr( $active ) ?>"><a href="<?php echo esc_url( get_term_link( $term->slug, $taxonomy ) ) ?>"><?php echo esc_html( $term->name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( have_posts() ) : ?>
						<div class="row sorting-container" data-layout="packery" id="portfolio-loop">
							<?php
							while ( have_posts() ) : the_post();
								echo fw_render_view( fw()->extensions->get( 'portfolio' )->locate_view_path( 'loop-item' ) );
                            endwhile;
							?>
						</div>

						<?php seosight_paging_nav(); ?>

					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</main><!-- #main -->
			</div>
			<?php if ( 'full' !== $layout['position'] ) { ?>
				<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div><!-- #row -->
	</div><!-- #primary -->
	<!-- End Case Item -->
<?php
unset( $ext_portfolio_instance );
unset( $ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );

get_footer();