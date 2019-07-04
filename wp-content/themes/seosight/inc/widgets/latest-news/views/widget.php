<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array  $args
 * @var string $title
 * @var string $text_button
 * @var string $link_button
 * @var array  $the_query
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

$button_url = ! empty( $link_button ) ? $link_button : get_home_url();

seosight_render( $before_widget );

if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
} ?>
	<div class="latest-news-wrap" itemscope itemtype="http://schema.org/WebPage">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<article class="latest-news-item">
				<header>
					<div class="post-additional-info">
						<?php echo seosight_posted_time(); ?>
					</div>
					<h5 class="post__title entry-title" >
						<a href="<?php the_permalink(); ?>" itemprop="relatedLink"><?php the_title(); ?></a>
					</h5>
				</header>
			</article>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php if ( ! empty( $text_button ) ) { ?>
    <a href="<?php echo esc_url( $button_url ); ?>" class="btn btn-small btn--dark btn-hover-shadow">
		<span class="text"><?php echo esc_attr( $text_button ); ?></span>
		<i class="seoicon-right-arrow"></i>
	</a>
<?php
}
seosight_render( $after_widget );