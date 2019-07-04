<?php
/**
 * @var object $ext
 * @var array $atts
 */
$builder_type          = $exclude               = $items_per_page        = $columns               = $nav_type              = $order                 = $orderby               = $portfolio_categories  = $sort_panel_type       = $sort_panel_visibility = '';
$cats = $ext::get_cats( $atts );
extract( $atts );
?>

<?php if ( !empty( $cats ) ) { ?>
    <div id="<?php echo esc_attr( $ext->get_config( 'selectors/panelContainer' ) ); ?>">
        <ul class="<?php echo esc_attr( $ext->get_config( 'selectors/panelLinksWrapper' ) ); ?> cat-list align-center sorting-menu">
            <?php if ( $sort_panel_type === 'ajax' ) { ?>
                <li class="cat-list__item active">
                    <a href="?cat=0">
                        <span> <?php esc_html_e( 'All Projects', 'seosight' ); ?></span>
                        <?php seosight_render( $ext->get_view( 'spinner' ) ); ?>
                    </a>
                </li>
            <?php } ?>
            <?php foreach ( $cats as $cat ) { ?>

                <?php
                if ( $sort_panel_type === 'ajax' ) {
                    $url     = "?cat={$cat->term_id}";
                    $spinner = $ext->get_view( 'spinner' );
                    $active  = '';
                } else {
                    $url     = get_term_link( $cat->term_id, fw_ext( 'portfolio' )->get_taxonomy_name() );
                    $active  = ( $cat->term_id == get_queried_object_id() ) ? 'active' : '';
                    $spinner = '';
                }
                ?>

                <li class="<?php echo esc_attr( $active ); ?> cat-list__item">
                    <a href="<?php echo esc_url( $url ); ?>">
                        <span><?php echo esc_html( $cat->name ); ?></span>
                        <?php seosight_render( $spinner ); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>