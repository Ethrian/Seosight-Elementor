<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 */

$show_share_custom = $show_navigation_custom = $show_related_custom = '';
/* Elements Customization options */

// Options value

$media_align = fw_get_db_customizer_option( 'thumbnail-align', 'left' );


$show_share      = fw_get_db_customizer_option( 'folio-share-show', 'no' );
$show_navigation = fw_get_db_customizer_option( 'folio-bottom-nav/post-navigation', 'yes' );
$show_related    = fw_get_db_customizer_option( 'folio-related-show/value', 'no' );

// Metabox value
$enable_customization = fw_get_db_post_option( get_the_ID(), 'custom-description/enable', 'no' );
$media_align_custom   = fw_get_db_post_option( get_the_ID(), 'thumbnail-align', 'default' );

if ( 'yes' === $enable_customization ) {
    $show_share_custom      = fw_get_db_post_option( get_the_ID(), 'custom-description/yes/folio-share-show', 'default' );
    $show_navigation_custom = fw_get_db_post_option( get_the_ID(), 'custom-description/yes/folio-navigation-show', 'default' );
    $show_related_custom    = fw_get_db_post_option( get_the_ID(), 'custom-description/yes/folio-related-show', 'default' );
}

// End value
$media_align     = ( ! empty( $media_align_custom ) && 'default' !== $media_align_custom ) ? $media_align_custom : $media_align;
$show_share      = ( ! empty( $show_share_custom ) && 'default' !== $show_share_custom ) ? $show_share_custom : $show_share;
$show_navigation = ( ! empty( $show_navigation_custom ) && 'default' !== $show_navigation_custom ) ? $show_navigation_custom : $show_navigation;
$show_related    = ( ! empty( $show_related_custom ) && 'default' !== $show_related_custom ) ? $show_related_custom : $show_related;

$layout = seosight_sidebar_conf();
$container_width = 'container';
$padding_class = 'medium-padding120';
$builder_meta = get_post_meta( get_the_ID(), 'kc_data', true );
if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] && 'full' === $layout['position'] ) {
    $container_width = 'page-builder-wrap';
    $padding_class = '';
}
get_header(); ?>
    <div id="primary">
        <?php get_template_part( 'template-parts/project', $media_align ); ?>
<?php while ( have_posts() ) : the_post();
    if ( 0 !== strlen(get_the_content(''))){ ?>
        <div class="<?php echo esc_attr( $container_width ) ?>">
            <div class="row <?php echo esc_attr( $padding_class ) ?>">
                <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                    <main id="main" class="site-main" >
                        <?php  the_content(); ?>
                    </main><!-- #main -->
                </div>
                <?php if ( 'full' !== $layout['position'] ) { ?>
                    <div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div><!-- #row -->
        </div>
    <?php }
    endwhile; // End of the loop.
?>
    </div><!-- #primary -->
<?php if ( 'yes' === $show_share ) {
    get_template_part( 'template-parts/share', 'panel' );
}
if ( 'yes' === $show_navigation ) {
    get_template_part( 'template-parts/portfolio', 'navigation' );
}
if ( 'yes' === $show_related ) {
    get_template_part( 'template-parts/related', 'slider' );
}

get_footer();
