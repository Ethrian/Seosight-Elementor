<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
$oembed = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'audio_oembed' ) : '';

$post_extra_classes   = get_query_var( 'post_extra_classes' );
$post_extra_classes   = is_array( $post_extra_classes ) ? $post_extra_classes : array();

if ( is_sticky() ) {
    $post_extra_classes[] = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( implode( ' ', $post_extra_classes ) ); ?>>

    <?php if ( !empty( $oembed ) ) { ?>
        <div class="post-thumb">
            <?php
            echo wp_oembed_get( $oembed, array( 'width' => 690, 'height' => 180 ) );
            ?>
        </div>
    <?php } ?>

    <div class="post__content">
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