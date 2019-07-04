<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array  $args
 * @var string $title
 * @var string $count
 * @var string $cat_sel
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

seosight_render( $before_widget );

if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
}
$categories = get_categories( array(
	'orderby'  => 'name',
	'order'    => 'ASC',
	'taxonomy' => $cat_sel
) );

if ( ! empty( $categories ) ) { ?>
	<ul class="post-category-wrap">
		<?php
		foreach ( $categories as $category ) {
			$category_link = sprintf( '<a href="%1$s" alt="%2$s"  class="category-title">%3$s <i class="seoicon-right-arrow"></i></a>',
				esc_url( get_category_link( $category->term_id ) ),
				esc_attr( sprintf( __( 'View all posts in %s', 'seosight' ), $category->name ) ),
				esc_html( $category->name )
			); ?>
			<li class="category-post-item">
				<?php if ( $count ) { ?>
					<span class="post-count"><?php echo esc_attr( $category->count ) ?></span>
				<?php } ?>
				<?php seosight_render( $category_link ) ?>
			</li>
		<?php } ?>
	</ul>
<?php }
seosight_render( $after_widget );
