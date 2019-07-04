<?php
/**
 * @var object $ext
 * @var array $atts
 */
$builder_type          = $exclude               = $items_per_page        = $columns               = $nav_type              = $order                 = $orderby               = $portfolio_categories  = $sort_panel_type       = $sort_panel_visibility = '';
extract( $atts );

global $wp_query;

if ( !$wp_query ) {
    return '';
}

$page = $wp_query->get( 'paged' );
$max  = $wp_query->max_num_pages;
$next = ($page < $max) ? $page + 1 : 0;
?>

<nav class="<?php echo esc_attr( $ext->get_config( 'selectors/navLinksWrapper' ) ); ?> ajax-portfolio-nav-loadmore">
    <a href="<?php echo esc_attr( "?page={$next}" ); ?>" class="<?php echo esc_attr( $ext->get_config( 'selectors/loadmoreItem' ) ); ?> btn btn--primary">
        <span>
            <?php seosight_render( ($page < $max) ? __( 'Load more', 'seosight' ) : __( 'Loaded all', 'seosight' ) ); ?>
        </span>
        <?php $ext->get_view( 'spinner', array(), false ); ?>
    </a>
</nav>