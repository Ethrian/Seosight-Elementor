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

$links_args = array(
    'mid_size'  => 3,
    'prev_next' => true,
    'prev_text'    => '<svg class="btn-prev"><use xlink:href="#arrow-left"></use></svg>',
    'next_text'    => '<svg class="btn-next"><use xlink:href="#arrow-right"></use></svg>',
);

// Standard pagination
if ( $sort_panel_type !== 'ajax' ) {
    ?>
    <nav class="navigation portfolio-nav-numbers standard-portfolio-nav-numbers">
        <?php echo paginate_links( $links_args ); ?>
    </nav>
    <?php
    return;
}

// Ajax pagination
$links_args[ 'base' ]    = '%_%';
$links_args[ 'format' ]  = '?page=%#%';
$links_args[ 'total' ]   = $wp_query->max_num_pages;
$links_args[ 'current' ] = $wp_query->get( 'paged' );

$links = paginate_links( $links_args );

if ( !$links ) {
    return '';
}

$spinner = $ext->get_view( 'spinner' );

$links = preg_replace( array( '/href\=\'\'/', '/href=\"\"/', '/(\<a .+?\>)(.+?)(\<\/a\>)/' ), array( 'href="?page=1"', 'href="?page=1"', '$1<span>$2</span>' . $spinner . '$3' ), $links );
?>

<nav class="<?php echo esc_attr( $ext->get_config( 'selectors/navLinksWrapper' ) ); ?> navigation portfolio-nav-numbers ajax-portfolio-nav-numbers">
    <?php seosight_render( $links ); ?>
</nav>