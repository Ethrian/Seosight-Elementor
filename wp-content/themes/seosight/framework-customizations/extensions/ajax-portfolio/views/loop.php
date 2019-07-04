<?php
/**
 * @var object $ext
 * @var array $atts
 */
$builder_type			 = $exclude				 = $two_portfolio_items	 = $items_per_page			 = $columns				 = $nav_type				 = $order					 = $orderby				 = $portfolio_categories	 = $sort_panel_type		 = $sort_panel_visibility	 = '';

extract( $atts );

switch ( (int) $columns ) {
	case 2:
		$columns_classes = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
		break;
	case 3:
		$columns_classes = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
		break;
	case 4:
		$columns_classes = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
		break;
	default:
		$columns_classes = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
		break;
}
?>
<?php if ( have_posts() ) { ?>
	<?php
	$count = 1;
	while ( have_posts() ) : the_post();
		$columns_big_classes = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';

		if ( $two_portfolio_items === 'yes' && ( $count === 1 || $count === 2 ) ) {
			$classes = $columns_big_classes;
		} else {
			$classes = $columns_classes;
		}
		?>
		<div class="<?php echo esc_attr( $ext->get_config( 'selectors/masonryItem' ) ); ?> <?php echo esc_attr( $classes ); ?>">
			<?php
			$ext->get_view( 'item', array(
				'ext'	 => $ext,
				'atts'	 => $atts,
				'count'	 => $count,
					), false );
			?>
		</div>
		<?php
		$count++;
	endwhile;
	?>
<?php } else { ?>
	<h3 class="ajax-blog-no-items <?php echo esc_attr( $ext->get_config( 'selectors/masonryItem' ) ); ?>"><?php esc_html_e( 'No portfolio items', 'seosight' ); ?></h3>
<?php } ?>