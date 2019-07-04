<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array  $args
 * @var string $title
 * @var string $menu
 * @var string $menu2
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

seosight_render( $before_widget );

if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
}


if ( ! empty( $menu ) || ! empty ( $menu2 ) ) {
	$column_class = empty( $menu ) || empty ( $menu2 ) ? 'full-width' : 'half-width';
	?>
	<div class="menus-wrap ovh">
		<?php if ( ! empty( $menu ) ) {
			wp_nav_menu( array( 'menu' => $menu, 'container' => 'ul', 'menu_class' => 'list--traingle ' . esc_attr( $column_class ), 'fallback_cb' => '', 'walker' => new Seosight_Widget_Walker_Nav() ) );
		}
		if ( ! empty( $menu2 ) ) {
			wp_nav_menu( array( 'menu' => $menu2, 'container' => 'ul', 'menu_class' => 'list--traingle ' . esc_attr( $column_class ), 'fallback_cb' => '', 'walker' => new Seosight_Widget_Walker_Nav() ) );
		} ?>
	</div>
<?php }
seosight_render( $after_widget );
