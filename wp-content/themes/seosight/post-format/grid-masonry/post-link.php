<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
global $allowedtags;
$content    = get_the_content();
$post_url   = get_url_in_content( $content );
$link_parts = parse_url( $post_url );

if ( has_post_thumbnail() ) {
    $poster_class       = 'custom-bg';
    $post_thumbnail_id  = get_post_thumbnail_id( get_the_ID() );
    $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
    $poster_style       = 'style="background-image:url(' . esc_url( $post_thumbnail_url ) . ');"';
} else {
    $poster_style = '';
    $poster_class = 'bg-boxed-primary';
}

$post_extra_classes   = get_query_var( 'post_extra_classes' );
$post_extra_classes   = is_array( $post_extra_classes ) ? $post_extra_classes : array();
$post_extra_classes[] = 'link';

if ( is_sticky() ) {
    $post_extra_classes[] = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( implode( ' ', $post_extra_classes ) ); ?>>
    <div class="post-thumb <?php echo esc_attr( $poster_class ); ?>" <?php seosight_render( $poster_style ) // WPCS: XSS OK.   ?>>
        <div class="thumb-content">
            <a href="<?php echo esc_url( $post_url ); ?>" class="post-link">
                <i class="seoicon-link-bold"></i>
            </a>
            <a href="<?php echo esc_url( $post_url ); ?>" class="h5 thumb-content-title"><?php echo strip_tags( $content ) ?></a>
            <a href="<?php echo esc_url( $post_url ); ?>" class="site-link" rel="nofollow" target="_blank"><?php echo esc_attr( $link_parts[ 'host' ] ) ?></a>
        </div>
        <div class="overlay"></div>
    </div>

    <?php
    if ( has_excerpt() ) {
        $excerpt = get_the_excerpt();
        ?>
        <div class="post__content-info">
            <div class="post__text">
                <p><?php echo esc_html( $excerpt ); ?></p>
            </div>
        </div>
    <?php } ?>
</article>