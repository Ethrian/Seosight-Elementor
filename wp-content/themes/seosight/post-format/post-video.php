<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
$video_oembed = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'video_oembed' ) : '';
$show_excerpt = get_query_var( 'post_excerpt', false );
$run_js = 'plyr.setup(\'.plyr\');';

wp_enqueue_script( 'plyr-js' );
wp_add_inline_script( 'plyr-js', $run_js );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post-standard'); ?>>

	<?php if ( ! empty( $video_oembed ) ) { ?>
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

		<?php seosight_post_author_avatar( get_the_author_meta( 'ID' ) ) ?>

		<div class="post__content-info">

			<?php the_title( '<h2 class="post__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="post-additional-info">
				<?php seosight_posted_on(); ?>
			</div>

			<div class="post__text">

                <?php
                if ( $show_excerpt ) {
                    the_excerpt();
                } else {
                    if ( ! has_excerpt() ) {
                        the_content();
                    } else {
                        the_excerpt();
                    }
                } ?>
			</div>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seosight' ),
				'after'  => '</div>',
			) );
			?>

		</div>
	</div>

</article>