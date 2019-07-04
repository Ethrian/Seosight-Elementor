<?php
/**
 * Template Name: Blog Grid
 */
get_header();

$is_ajax = seosight_is_ajax();

$the_query = seosight_custom_loop( 'post' );

$layout             = seosight_sidebar_conf();
$sort_panel         = fw_get_db_post_option( get_the_ID(), 'sorting_panel/value', 'yes' );
$sort_type          = fw_get_db_post_option( get_the_ID(), 'sorting_panel/yes/action', 'sort' );
$pagination         = fw_get_db_post_option( get_the_ID(), 'pagination_type', false );
$search_panel       = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog-search-show', 'no' ) : 'no';
$sort_wrapper_class = 'sort' == $sort_type ? 'sorting-menu' : '';
$post_template      = get_page_template_slug();
?>
<!-- Case Item -->
	<div id="primary" class="container">
		<div class="row medium-padding120">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="site-main">
					<div id="page-content" class="ovh">
						<?php
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
						?>
					</div>
					<?php if ( 'yes' === $search_panel ) { ?>
						<div class="row pb60">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<?php get_template_part( 'template-parts/search', 'blog' ); ?>
							</div>
						</div>
					<?php } ?>
					<?php if ( $the_query->have_posts() ) { ?>
						<?php
						$is_masonry = false;
						if ( preg_match( '/blog\-template\-masonry/', $post_template ) ) {
							$is_masonry = true;
						}
						?>
						<div id="post--loadmore-container"
						     class="row pb60 <?php seosight_render( $is_masonry ? 'post--grid-masonry-container' : 'post--grid-container' ); ?>">
							<?php
							$i = 1;
							while ( $the_query->have_posts() ) : $the_query->the_post();
								$post_extra_classes = array( 'post--grid', 'post-standard' );
                            $post_col_classes   = array( 'col-sm-12', 'col-xs-12' );
                            $format             = get_post_format();

                            if ( false === $format ) {
                                $format = 'standard';
                            }

                            if ( $is_masonry ) {
                                $data_mh                 = '';
                                $post_extra_classes[]    = 'post--grid-masonry';
                                $post_col_classes[]      = 'post--grid-masonry-col';
                                $post_col_classes_extend = 'col-lg-4 col-md-6';
                                $blog_grid_type          = 'blog-grid-masonry';
                            } else {
                                $blog_grid_type = 'blog-grid-main';
                                $data_mh        = 'data-mh="post-grid"';

                                if ( !$is_ajax && ($i === 1 || $i === 2) ) {
                                    $post_extra_classes[]    = 'post--grid-main';
                                    $post_col_classes_extend = 'col-lg-6 col-md-6';
                                } else {
                                    $post_col_classes_extend = 'col-lg-4 col-md-6';
                                }
                            }

                            if ( 'full' !== $layout[ 'position' ] ) {
                                $post_col_classes_extend = 'col-lg-6 col-md-12';
                            }

                            $post_col_classes[] = $post_col_classes_extend;

                            set_query_var( 'post_extra_classes', $post_extra_classes );
                            set_query_var( 'blog_grid_type', $blog_grid_type );
                            ?>
                            <div class="<?php echo esc_attr( implode( ' ', $post_col_classes ) ); ?>" <?php seosight_render( $data_mh ); ?>>
                                <?php get_template_part( 'post-format/grid-masonry/post', $format ); ?>
                            </div>
                            <?php
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <div class="row pb60">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            if ( 'loadmore' === $pagination ) {
                                seosight_ajax_loadmore( $the_query, $container_id = 'post--loadmore-container' );
                            } else {
                                seosight_paging_nav( $the_query );
                            }

                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                <?php } else {
                    ?>
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'seosight' ); ?></h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'seosight' ); ?></p>
                        </div><!-- .page-content -->
                    </section><!-- .no-results -->
                <?php }
                ?>
            </main><!-- #main -->
        </div>
        <?php if ( 'full' !== $layout[ 'position' ] ) { ?>
            <div class="<?php echo esc_attr( $layout[ 'sidebar-classes' ] ) ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>
    </div><!-- #row -->
</div><!-- #primary -->
<!-- End Case Item -->
<?php
get_footer();
