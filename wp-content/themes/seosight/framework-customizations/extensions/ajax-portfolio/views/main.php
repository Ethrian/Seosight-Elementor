<?php
/**
 * @var object $ext
 * @var array $atts
 */
$builder_type          = $exclude               = $items_per_page        = $columns               = $nav_type              = $order                 = $orderby               = $portfolio_categories  = $sort_panel_type       = $sort_panel_visibility = '';
extract( $atts );

if ( $sort_panel_visibility === 'yes' ) {
    $ext->get_view( 'panel', array(
        'ext'  => $ext,
        'atts' => $atts,
    ), false );
}
?>

<?php
global $wp_query;
$the_query = $ext::the_query( $atts );
$wp_query  = $the_query;
?>

<div id="<?php echo esc_attr( $ext->get_config( 'selectors/gridContainer' ) ); ?>" class="ajax-portfolio-wrapper">
    <?php
    $ext->get_view( 'loop', array(
        'ext'  => $ext,
        'atts' => $atts,
    ), false );
    ?>
</div>

<div id="<?php echo esc_attr( $ext->get_config( 'selectors/navContainer' ) ); ?>">
    <?php
    if ( in_array( $nav_type, $ext::$available_navs ) ) {
        $nav_type = $nav_type;
    } else {
        $nav_type = 'numbers';
    }

    $ext->get_view( "navs/{$nav_type}", array(
        'ext'  => $ext,
        'atts' => $atts,
    ), false );
    ?>
</div>

<?php wp_reset_query(); ?>