<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
$video_oembed = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'video_oembed' ) : '';
$run_js       = 'plyr.setup(\'.plyr\');';

wp_enqueue_script( 'plyr-js' );
wp_add_inline_script( 'plyr-js', $run_js );

$blog_grid_type       = get_query_var( 'blog_grid_type' );
$post_extra_classes   = get_query_var( 'post_extra_classes' );
$post_extra_classes   = is_array( $post_extra_classes ) ? $post_extra_classes : array();
$post_extra_classes[] = 'video';

if ( is_sticky() ) {
    $post_extra_classes[] = 'sticky';
}
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( implode( ' ', $post_extra_classes ) ); ?>>

    <?php if ( !empty( $video_oembed ) ) { ?>
        <div class="post-thumb">
            <?php
            echo '<div class="embed-responsive embed-responsive-16by9">' . wp_oembed_get( $video_oembed, array(
                'width'  => 1280,
                'height' => 720
            ) ) . '</div>';
            ?>
        </div>
    <?php } ?>

    <div class="post__content">
        <?php if ( empty( $video_oembed ) && $blog_grid_type === 'blog-grid-main' ) { ?>
            <div class="post__no_thumb"><img src="<?php echo get_template_directory_uri() . '/img/no-image.svg' ?>" alt="<?php esc_attr_e( 'No image', 'seosight' ); ?>"></div>
        <?php } ?>
        <div class="post__content-info">
            <?php seosight_grid_title_with_post_meta(); ?>

            <?php
            if ( has_excerpt() ) {
                $excerpt = get_the_excerpt();
                ?>
                <div class="post__text">
                    <p><?php echo esc_html( $excerpt ); ?></p>
                </div>
            <?php } ?>
        </div>

        <div class="post__author author vcard">
            <?php seosight_grid_post_author(); ?>
        </div>

        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seosight' ),
            'after'  => '</div>',
        ) );
        ?>
    </div>

</article>