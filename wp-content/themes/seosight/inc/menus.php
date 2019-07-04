<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Register menus
 */

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'primary'   => esc_html__( 'Top primary menu', 'seosight' ),
) );