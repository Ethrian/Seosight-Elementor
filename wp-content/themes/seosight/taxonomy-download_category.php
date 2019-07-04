<?php
/**
 * The template for displaying easy digital downloads products Category.
 */
get_header();
$layout = seosight_sidebar_conf();
?>
    <!-- Case Item -->
    <div id="primary" class="container">
        <div class="row medium-padding120">
            <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                <main id="main" class="site-main" >
                    <div class="row" id="downloads-loop">
						<?php while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/downloads', 'item' );
						endwhile; ?>
                    </div>
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
get_footer();