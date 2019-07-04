<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post-standard'); ?>>

    <?php if ( has_post_thumbnail() ) { ?>
        <div class="post-thumb">
            <img src="<?php echo get_template_directory_uri(); ?>/img/post1.jpg" alt="thumb">
            <div class="overlay"></div>
            <a href="#" class="link-image">
                <i class="seoicon-zoom"></i>
            </a>
            <a href="#" class="link-post">
                <i class="seoicon-link-bold"></i>
            </a>
        </div>
    <?php } ?>

	<div class="post__content">
		<div class="post__author author vcard">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
			Posted by
			<div class="post__author-name fn">
				<a href="#" class="post__author-link">Admin</a>
			</div>

		</div>

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