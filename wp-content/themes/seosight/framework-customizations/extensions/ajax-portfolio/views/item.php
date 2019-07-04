<?php
/**
 * @var object $ext
 * @var array $atts
 * @var int $count
 */
$builder_type			 = $exclude				 = $columns				 = $items_per_page			 = $nav_type				 = $order					 = $orderby				 = $portfolio_categories	 = $sort_panel_type		 = $sort_panel_visibility	 = '';

extract( $atts );

global $wp_query, $post;

if ( $count === 1 || $count === 2 ) {
	$big_classes = 'big';
} else {
	$big_classes = '';
}
?>
<div class="crumina-case-item align-center mb30 <?php echo esc_attr( $big_classes ); ?>">
	<div class="crum-portfolio-item-mh">
		<a href="<?php echo the_permalink(); ?>" class="ajax-portfolio-item-thumb case-item__thumb mouseover lightbox shadow animation-disabled">
			<?php
			$video = seosight_get_project_video();
			if ( $video ) {
				?>
				<div class="responsive-video">
					<?php seosight_render( $video ); ?>
				</div>
				<?php
			} else {
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'ajax-portfolio-thumb' );
				} else {
					?>
					<?php $image_url = $ext->locate_URI( '/static/img/no-photo.jpg' ); ?>
					<img src="<?php echo esc_url( $image_url ) ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
					<?php
				}
			}
			?>
		</a>
    </div>
    <a href="<?php the_permalink(); ?>" class="ajax-portfolio-item-title h6 case-item__title"><?php the_title(); ?></a>
    <div class="ajax-portfolio-item-terms case-item__cat">
		<?php the_terms( get_the_ID(), fw_ext( 'portfolio' )->get_taxonomy_name() ); ?>
    </div>
</div>