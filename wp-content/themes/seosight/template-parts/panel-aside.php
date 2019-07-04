<?php
/**
 * Template part for displaying aside widgets.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */

$panel_options = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'aside-panel/yes', false ) : false;

$show_logo  = function_exists( 'fw_akg' ) ? fw_akg( 'logo', $panel_options, true ) : true;
$panel_text = function_exists( 'fw_akg' ) ? fw_akg( 'text', $panel_options, '' ) : '';


?>
<!-- Right-menu -->

<div class="popup right-menu">

	<div class="mCustomScrollbar" data-mcs-theme="dark">
		<div class="right-menu-wrap">
			<div class="user-menu-close js-close-aside">
				<a href="#" class="user-menu-content  js-clode-aside">
					<span></span>
					<span></span>
				</a>
			</div>
			<?php if ( true === $show_logo ) { ?>
				<div class="logo">
					<?php seosight_logo(); ?>
				</div>
			<?php } ?>

				<div class="text">
					<?php echo do_shortcode( wpautop( $panel_text ) ); ?>
				</div>

		</div>
		<?php dynamic_sidebar( 'sidebar-hidden' ); ?>
	</div>

</div>

<!-- ... End Right-menu -->