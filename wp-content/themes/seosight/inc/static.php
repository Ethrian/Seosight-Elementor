<?php
/**
 * Include static files: javascript and css
 *
 * @package seosight.
 */

if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


if ( is_admin() ) {
	return;
}
global $post;
$my_theme = wp_get_theme();
$theme_version = $my_theme->get( 'Version' );
if (is_child_theme()){
	$my_theme = $my_theme->parent();
	$theme_version = $my_theme->get( 'Version' );
}

/**
 * Enqueue scripts and styles for the front end.
 */

// Add bootstrap cores styles.

wp_enqueue_style(
	'normalize',
	get_template_directory_uri() . '/css/normalize.css',
	array(),
	'1'
);

wp_enqueue_style(
	'seosight-grid',
	get_template_directory_uri() . '/css/grid.css',
	array(),
	$theme_version
);
wp_enqueue_style(
	'seosight-theme-style',
	get_template_directory_uri() . '/css/theme-styles.css',
	array( 'seosight-grid' ),
	$theme_version
);
wp_enqueue_style(
	'seosight-theme-plugins',
	get_template_directory_uri() . '/css/theme-plugins.css',
	array(),
	$theme_version
);
wp_enqueue_style(
	'seosight-theme-blocks',
	get_template_directory_uri() . '/css/blocks.css',
	array(),
	$theme_version
);
wp_enqueue_style(
	'seosight-color-scheme',
	get_template_directory_uri() . '/css/color-selectors.css',
	array(),
	$theme_version
);

// Enq parent rtl
$rtl_template_dir_uri = get_template_directory_uri();
$rtl_template_dir     = get_template_directory();
$rtl_stylesheet_dir   = get_stylesheet_directory();

if ( is_rtl() && is_child_theme() && file_exists( "$rtl_template_dir/rtl.css" ) && !file_exists( "$rtl_stylesheet_dir/rtl.css" ) ) {
    wp_register_style( 'parent-theme-rtl', "$rtl_template_dir_uri/rtl.css", array(), $theme_version );
    wp_enqueue_style( 'parent-theme-rtl' );
}

// Icons
wp_enqueue_style(
	'seosight-icons',
	get_template_directory_uri() . '/css/crumina-icons.css',
	array(),
	$theme_version
);

// Add font, used in the main stylesheet.
wp_enqueue_style(
	'seosight-theme-font',
	seosight_font_url(),
	array(),
	$theme_version
);
wp_enqueue_style(
	'tippy-css',
	get_template_directory_uri() . '/css/tippy.css',
	array(),
	'0.11.2'
);

// Register only scripts.
wp_register_script(
	'particles',
	get_template_directory_uri() . '/js/particles.js',
	array(),
	'2.0.0',
	true
);
wp_register_script(
	'partical-animation',
	get_template_directory_uri() . '/js/partical-animation.js',
	array(),
	'2.0.0',
	true
);

wp_register_script(
	'isotope',
	get_template_directory_uri() . '/js/isotope.pkgd.min.js',
	array(),
	'3.0.1',
	true
);
wp_register_script(
	'isotope-packery-mode',
	get_template_directory_uri() . '/js/isotope.packery.min.js',
	array('isotope'),
	'2.0.0',
	true
);
wp_register_script(
	'seosight-loadmore',
	get_template_directory_uri() . '/js/ajax-pagination.js',
	array(),
	'3.0.1',
	true
);

wp_register_script(
	'seosight-likes-public',
	get_template_directory_uri() . '/js/simple-likes-public.js',
	array( 'jquery' ),
	'1',
	true
);

wp_register_script(
	'seosight-share-buttons',
	get_template_directory_uri() . '/js/sharer.min.js',
	array(),
	'0.5',
	true
);
wp_register_script(
	'plyr-js',
	get_template_directory_uri() . '/js/plyr.min.js',
	array(),
	'2.0.12',
	true
);
wp_register_script(
	'chart-js',
	get_template_directory_uri() . '/js/chart.min.js',
	array(),
	'2.7.1',
	true
);
wp_register_script( 'seosight-timeline',
	get_template_directory_uri() . '/js/time-line.js',
	array( 'jquery', 'seosight-main-script' ),
	'1',
	true);
wp_register_script(
	'velocity',
	get_template_directory_uri() . '/js/velocity.min.js',
	array(),
	'1.2.3',
	true
);
wp_register_script(
	'scrollmagic',
	get_template_directory_uri() . '/js/ScrollMagic.min.js',
	array(),
	'2.0.5',
	true
);
wp_register_script(
	'scrollmagic-velocity',
	get_template_directory_uri() . '/js/animation.velocity.min.js',
	array( 'velocity', 'scrollmagic' ),
	'2.0.5',
	true
);



// Enqueue scripts.
wp_enqueue_script(
	'swiper-slider',
	get_template_directory_uri() . '/js/swiper.jquery.min.js',
	array(),
	'1.1.0',
	true
);
wp_enqueue_script(
	'seosight-megamenu',
	get_template_directory_uri() . '/js/crum-mega-menu.js',
	array(),
	'1.1.0',
	true
);

wp_enqueue_script(
	'seosight-plugins',
	get_template_directory_uri() . '/js/theme-plugins.js',
	array(),
	$theme_version,
	true
);
wp_enqueue_script(
	'jquery-extend',
	get_template_directory_uri() . '/js/jquery-extend.js',
	array( 'jquery' ),
	$theme_version,
	true
);
wp_enqueue_script(
	'hooks',
	get_template_directory_uri() . '/js/hooks.js',
	array( 'jquery' ),
	$theme_version,
	true
);
wp_enqueue_script(
	'seosight-main-script',
	get_template_directory_uri() . '/js/main.js',
	array( 'jquery', 'jquery-extend', 'hooks' ),
	$theme_version,
	true
);
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
if ( is_tax('fw-portfolio-category') || is_page_template( 'portfolio-template.php' ) || is_page_template( 'blog-template-grid.php' ) || is_page_template( 'blog-template-masonry.php' ) ) {
	wp_enqueue_script( 'isotope' );
	wp_enqueue_script( 'isotope-packery-mode' );
}
wp_enqueue_script(
	'tippy-js',
	get_template_directory_uri() . '/js/tippy.min.js',
	array(),
	'0.11.2',
	true
);

$custom_js = ( function_exists( 'fw_get_db_customizer_option' ) ) ? fw_get_db_customizer_option( 'custom-js', '' ) : '';
if ( ! empty( $custom_js ) ) {
	$custom_js = 'jQuery( document ).ready(function($) {  ' . $custom_js . '  });';
	wp_add_inline_script( 'seosight-main-script', $custom_js );
}