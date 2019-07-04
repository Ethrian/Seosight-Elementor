<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
?>

<?php
$quote_author  = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'quote_author' ) : '';
$quote_dopinfo = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'quote_dopinfo' ) : '';
$quote_avatar  = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'quote_avatar' ) : '';
$text_color    = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'text_color' ) : '';

if ( has_post_thumbnail() ) {
    $poster_class       = 'custom-bg';
    $post_thumbnail_id  = get_post_thumbnail_id( get_the_ID() );
    $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
    $poster_style       = 'style="background-image:url(' . esc_url( $post_thumbnail_url ) . ');"';
} else {
    $poster_style = '';
    $poster_class = 'bg-boxed-dark';
}
$text_style = !empty( $text_color ) ? 'style="color:' . esc_attr( $text_color ) . ';"' : '';

$post_extra_classes   = get_query_var( 'post_extra_classes' );
$post_extra_classes   = is_array( $post_extra_classes ) ? $post_extra_classes : array();
$post_extra_classes[] = 'quote';

if ( is_sticky() ) {
    $post_extra_classes[] = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( implode( ' ', $post_extra_classes ) ); ?>>
    <div class="post-thumb <?php echo esc_attr( $poster_class ); ?>" <?php seosight_render( $poster_style ); ?>>
        <div class="testimonial-content">
            <div class="quote">
                <i class="seoicon-quotes"></i>
            </div>
            <div class="text" <?php seosight_render( $text_style ) ?>>
                <?php the_content(); ?>
            </div>
            <div class="author-info-wrap table">
                <div class="testimonial-img-author table-cell">
                    <?php
                    if ( !empty( $quote_avatar ) ) {
                        echo fw_html_tag( 'img', array(
                            'src' => fw_resize( $quote_avatar[ 'url' ], 64, 64, false ),
                            'alt' => $quote_author
                        ), false );
                    }
                    ?>
                </div>
                <div class="author-info table-cell">
                    <?php if ( !empty( $quote_author ) ) { ?>
                        <h6 class="author-name"><?php echo esc_html( $quote_author ) ?></h6>
                        <?php
                    }
                    if ( !empty( $quote_dopinfo ) ) {
                        ?>
                        <div class="author-company"><?php echo esc_html( $quote_dopinfo ) ?></div>
                    <?php } ?>
                </div>
            </div>

        </div>
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