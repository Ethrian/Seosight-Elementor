<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */

?>


<article id="post-<?php the_ID(); ?>" class="post-standard">

	<div class="post__content">

		<div class="post__content-info">

			<?php the_title( '<h2 class="post__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="post__text">
				<?php echo strip_shortcodes( get_the_excerpt() ) ?>
			</div>

		</div>
	</div>

</article>