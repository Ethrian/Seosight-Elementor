<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */


$show_featured = $show_meta = $show_author = $show_share = $show_authorbox = 'yes';

$format = get_post_format();
if ( false === $format ) {
    $format = 'standard';
}

$show_stunning = get_query_var('show_stunning');

if ( function_exists( 'fw_get_db_customizer_option' ) ) {
    $show_featured  = fw_get_db_customizer_option( 'single-featured-show', 'yes' );
    $show_author    = fw_get_db_customizer_option( 'single-author-show', 'yes' );
    $show_meta      = fw_get_db_customizer_option( 'single-meta-show', 'yes' );
    $show_share     = fw_get_db_customizer_option( 'single-share-show', 'yes' );
    $show_authorbox = fw_get_db_customizer_option( 'author-box-show', 'yes' );
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard-details' ); ?>>
    <?php if ( 'yes' === $show_featured ) : ?>
        <?php
        if ( 'video' === $format ) {
	        $oembed = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'video_oembed' ) : '';
	        echo '<div class="post-thumb"><div class="embed-responsive embed-responsive-16by9">' . wp_oembed_get( $oembed, array(
			        'width'  => 1280,
			        'height' => 720
		        ) ) . '</div></div>';
        }
        if ( 'audio' === $format ) {
            $oembed = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'audio_oembed' ) : '';
            echo '<div class="post-thumb">' . wp_oembed_get( $oembed, array(
                            'width'  => 750,
                            'height' => 180
                    ) ) . '</div>';
        } elseif ( 'standard' === $format && has_post_thumbnail() ) {
            echo '<div class="post-thumb">';
            the_post_thumbnail('large');
            echo '</div>';
        } ?>
    <?php endif; ?>
    <div class="post__content">
	    <?php if ( 'yes' !== $show_stunning ) {
		    the_title( '<h1 class="h2 entry-title">', '</h1>' );
	    } ?>
        <div class="post-additional-info">

            <?php if ( 'yes' === $show_author ) {
                seosight_post_author_avatar( get_the_author_meta( 'ID' ) );
            }
            if ( 'yes' === $show_meta ) {
                seosight_posted_on();
            } ?>

        </div>

        <div class="post__content-info">
            <div class="e-content entry-content">
                <?php the_content(); ?>
            </div>

            <?php wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seosight' ),
                    'after'  => '</div>',
            ) ); ?>

            <?php seosight_entry_footer(); ?>

            <?php if ( 'yes' === $show_share ) { ?>
                <div class="socials">
                    <?php get_template_part( 'template-parts/share', 'icons' ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</article>

<?php if ( 'yes' === $show_authorbox ) {
    get_template_part( 'template-parts/author', 'box' );
} ?>
