<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
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
$text_style = ! empty( $text_color ) ? 'style="color:' . esc_attr( $text_color ) . ';"' : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard quote' ); ?>>
    <div class="post-thumb <?php echo esc_attr( $poster_class ); ?>" <?php seosight_render( $poster_style ) // WPCS: XSS OK. ?>>
        <div class="testimonial-content">
            <div class="text" <?php seosight_render( $text_style ) ?>><?php the_content(); ?></div>
            <div class="author-info-wrap table">
                <div class="testimonial-img-author table-cell">
                    <?php if ( ! empty( $quote_avatar ) ) {
                        echo fw_html_tag( 'img', array(
                                'src' => fw_resize( $quote_avatar['url'], 64, 64, false ),
                                'alt' => $quote_author
                        ), false );
                    } ?>
                </div>
                <div class="author-info table-cell">
                    <?php if ( ! empty( $quote_author ) ) { ?>
                        <h6 class="author-name"><?php echo esc_html( $quote_author ) ?></h6>
                    <?php }
                    if ( ! empty( $quote_dopinfo ) ) { ?>
                        <div class="author-company"><?php echo esc_html( $quote_dopinfo ) ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="quote">
                <i class="seoicon-quotes"></i>
            </div>
        </div>
    </div>
	<?php if ( has_excerpt() ) { ?>
    <div class="post__content-info">
        <div class="post__text">
	        <?php echo ( get_the_excerpt() ); ?>
        </div>
    </div>
	<?php } ?>
</article>