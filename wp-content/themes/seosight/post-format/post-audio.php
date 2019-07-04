<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
$oembed = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'audio_oembed' ) : '';
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post-standard'); ?>>

	<?php if ( ! empty( $oembed ) ) { ?>
	<div class="post-thumb">
		<?php
		echo wp_oembed_get( $oembed, array('width'=>690, 'height'=> 180) );
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
				<?php the_content(); ?>
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