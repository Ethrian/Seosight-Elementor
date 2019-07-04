<?php

if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Filters and Actions
 */

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 * @internal
 */
function _action_seosight_admin_fonts() {
	wp_enqueue_style( 'seosight-font', seosight_font_url(), array(), '1.0' );
}

add_action( 'admin_print_scripts-appearance_page_custom-header', '_action_seosight_admin_fonts' );

if ( !function_exists( '_action_seosight_setup' ) ) : /**
	 * Theme setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 * @internal
	 */ {

		function _action_seosight_setup() {
			// Add custom background
			add_theme_support( 'custom-background' );

			// Add support for editor styles.
			add_theme_support( 'editor-styles' );
			add_editor_style( get_theme_file_uri( 'css/style-editor.css' ) );

			add_theme_support( "title-tag" );
			/*
			 * Make Theme available for translation.
			 */
			load_theme_textdomain( 'seosight', get_template_directory() . '/languages' );

			// This theme styles the visual editor to resemble the theme style.
			add_editor_style( array( 'css/editor-style.css', seosight_font_url() ) );

			// Add RSS feed links to <head> for posts and comments.
			add_theme_support( 'automatic-feed-links' );

			// Enable support for Post Thumbnails, and declare two sizes.
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 690, 420, true );
			add_image_size( 'seosight-full-width', 1038, 576, true );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			) );

			/*
			 * Enable support for Post Formats.
			 * See http://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'video',
				'audio',
				'quote',
				'link',
				'gallery',
			) );

			// Remove REST links from header
			remove_action( 'template_redirect', 'rest_output_link_header', 11 );

			// No Gutenberg no problem
			remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );

			// This theme uses its own gallery styles.
			add_filter( 'use_default_gallery_style', '__return_false' );

			// Declare 3-rd party plugins support
			add_theme_support( 'woocommerce', array(
				'product_grid' => array(
					'default_rows'		 => 4,
					'min_rows'			 => 2,
					'max_rows'			 => 9,
					'default_columns'	 => 3,
					'min_columns'		 => 2,
					'max_columns'		 => 5,
				),
			) );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Change kingcomposer modules path
			global $kc;
			if ( $kc && is_child_theme() && class_exists( 'KingComposer' ) ) {
				$kc->set_template_path( get_stylesheet_directory() . KDS . 'kingcomposer' . KDS );
			}

			// Loading translations
			load_theme_textdomain( 'seosight', get_template_directory() . '/languages/theme' );
		}

	}
endif;
add_action( 'after_setup_theme', '_action_seosight_setup' );

/**
 * Adjust content_width value for image attachment template.
 * @internal
 */
function _action_seosight_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS[ 'content_width' ] = 810;
	}
}

add_action( 'template_redirect', '_action_seosight_content_width' );

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 * @internal
 */
function _filter_seosight_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( is_active_sidebar( 'sidebar-footer' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && !is_front_page() ) {
		$classes[] = 'singular';
	}

	$classes[] = 'crumina-grid';

	return $classes;
}

add_filter( 'body_class', '_filter_seosight_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 *
 * @return array The filtered post class list.
 * @internal
 */
function _filter_seosight_post_classes( $classes ) {
	if ( !post_password_required() && !is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}

add_filter( 'post_class', '_filter_seosight_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 * @internal
 */
function _filter_seosight_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'seosight' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', '_filter_seosight_wp_title', 10, 2 );

/**
 * Flush out the transients used in seosight_categorized_blog.
 * @internal
 */
function _action_seosight_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'seosight_category_count' );
}

add_action( 'edit_category', '_action_seosight_category_transient_flusher' );
add_action( 'save_post', '_action_seosight_category_transient_flusher' );

/**
 * Register widget areas.
 * @internal
 */
function _action_seosight_widgets_init() {

	register_sidebar( array(
		'name'			 => esc_html__( 'Main Widget Area', 'seosight' ),
		'id'			 => 'sidebar-main',
		'description'	 => esc_html__( 'Appears in the right section of the site.', 'seosight' ),
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<div class="crumina-heading widget-heading"><h5 class="heading-title">',
		'after_title'	 => '</h5><div class="heading-decoration"><span class="first"></span><span class="second"></span></div></div>',
	) );
	register_sidebar( array(
		'name'			 => esc_html__( 'Hidden Widget Area', 'seosight' ),
		'id'			 => 'sidebar-hidden',
		'description'	 => esc_html__( 'Appears in the Hidden section. If available.', 'seosight' ),
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h4 class="heading-title">',
		'after_title'	 => '</h4>',
	) );
	register_sidebar( array(
		'name'			 => esc_html__( 'Footer Widget Area', 'seosight' ),
		'id'			 => 'sidebar-footer',
		'description'	 => esc_html__( 'Appears in footer section. Every widget in own column ', 'seosight' ),
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s columns_class_replace">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<div class="crumina-heading widget-heading"><h4 class="heading-title">',
		'after_title'	 => '</h4><div class="heading-decoration"><span class="first"></span><span class="second"></span></div></div>',
	) );
}

add_action( 'widgets_init', '_action_seosight_widgets_init' );

/**
 * Count Widgets
 * Count the number of widgets to add dynamic column class
 *
 * @param string $sidebar_id id of sidebar
 *
 * @since 1.0.0
 *
 * @return int
 */
function seosight_get_widget_columns( $sidebar_id ) {
	// Default number of columns in grid is 12
	$columns = apply_filters( 'seosight_columns', 12 );

	// get the sidebar widgets
	$the_sidebars = wp_get_sidebars_widgets();

	// if sidebar doesn't exist return error
	if ( !isset( $the_sidebars[ $sidebar_id ] ) ) {
		return esc_html__( 'Invalid sidebar ID', 'seosight' );
	}

	/* count number of widgets in the sidebar
	  and do some simple math to calculate the columns */
	$num = count( $the_sidebars[ $sidebar_id ] );

	switch ( $num ) {
		case 1 : $num = $columns;
			break;
		case 2 : $num = $columns / 2;
			break;
		case 3 : $num = $columns / 3;
			break;
		case 4 : $num = $columns / 4;
			break;
		case 5 : $num = $columns / 5;
			break;
		case 6 : $num = $columns / 6;
			break;
		case 7 : $num = $columns / 7;
			break;
		case 8 : $num = $columns / 8;
			break;
	}
	$num = floor( $num );
	return $num;
}

if ( defined( 'FW' ) ):
	/**
	 * Display current submitted FW_Form errors
	 * @return array
	 */
	if ( !function_exists( '_action_seosight_display_form_errors' ) ):

		function _action_seosight_display_form_errors() {
			$form = FW_Form::get_submitted();

			if ( !$form || $form->is_valid() ) {
				return;
			}

			wp_enqueue_script(
					'seosight-show-form-errors',
					get_template_directory_uri() . '/js/form-errors.js',
					array( 'jquery' ),
					'1.0',
					true
			);

			wp_localize_script( 'seosight-show-form-errors', '_localized_form_errors', array(
				'errors'	 => $form->get_errors(),
				'form_id'	 => $form->get_id()
			) );
		}

	endif;
	add_action( 'wp_enqueue_scripts', '_action_seosight_display_form_errors' );
endif;

/**
 * Custom read more Link formatting
 *
 * @return string
 */
function seosight_read_more_link() {
	return '<div class="more-link"><a href="' . get_permalink() . '" class="btn btn-small btn--dark btn-hover-shadow"><span class="text">' . esc_html__( 'Continue Reading', 'seosight' ) . '</span><i class="seoicon-right-arrow"></i></a></div>';
}

function seosight_excerpt_link( $output ) {
	return $output . '</p><div class="more-link"><a href="' . get_permalink() . '" class="btn btn-small btn--dark btn-hover-shadow"><span class="text">' . esc_html__( 'Continue Reading', 'seosight' ) . '</span><i class="seoicon-right-arrow"></i></a></div>';
}

add_filter( 'the_content_more_link', 'seosight_read_more_link' );
add_filter( 'the_excerpt', 'seosight_excerpt_link' );

function seosight_move_comment_field_to_bottom( $fields ) {
	$comment_field		 = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'seosight_move_comment_field_to_bottom' );

add_filter(
		'fw:option_type:icon-v2:packs',
		'_add_more_packs'
);

function _add_more_packs( $default_packs ) {
	return array(
		'seosight' => array(
			'name'				 => 'seosight',
			'css_class_prefix'	 => 'seoicon',
			'css_file'			 => get_template_directory() . '/css/crumina-icons.css',
			'css_file_uri'		 => get_template_directory_uri() . '/css/crumina-icons.css'
		)
	);
}

function _filter_seosight_disable_sliders( $sliders ) {
	foreach ( array( 'owl-carousel', 'bx-slider', 'nivo-slider' ) as $name ) {
		$key = array_search( $name, $sliders );
		unset( $sliders[ $key ] );
	}
	return $sliders;
}

add_filter( 'fw_ext_slider_activated', '_filter_seosight_disable_sliders' );

/**
 * Add SVG capabilities
 */
function seosight_svg_mime_type( $mimes = array() ) {
	$mimes[ 'svg' ]	 = 'image/svg+xml';
	$mimes[ 'svgz' ] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'upload_mimes', 'seosight_svg_mime_type' );

/**
 * Add tags to allowedtags filter
 */
function seosight_extend_allowed_tags() {
	global $allowedtags;

	$allowedtags[ 'i' ]		 = array(
		'class' => array(),
	);
	$allowedtags[ 'br' ]	 = array(
		'class' => array(),
	);
	$allowedtags[ 'img' ]	 = array(
		'src'	 => array(),
		'alt'	 => array(),
		'width'	 => array(),
		'height' => array(),
		'class'	 => array(),
	);
	$allowedtags[ 'span' ]	 = array(
		'class'	 => array(),
		'style'	 => array(),
	);
	$allowedtags[ 'a' ]		 = array(
		'class'		 => array(),
		'href'		 => array(),
		'target'	 => array(),
		'onclick'	 => array(),
		'rel'		 => array(),
	);
}

add_action( 'init', 'seosight_extend_allowed_tags' );

/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function seosight_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Add Sidebar' :
			$translated_text = esc_html__( 'Save changes', 'seosight' );
			break;
	}
	return $translated_text;
}

add_filter( 'gettext', 'seosight_text_strings', 20, 3 );

/**
 * Disable content editor for page template.
 */
function seosight_disable_admin_metabox() {

	$only = array(
		'only' => array( array( 'id' => 'page' ) ),
	);
	if ( function_exists( 'fw_current_screen_match' ) && fw_current_screen_match( $only ) ) {
		$post_id = ( isset( $_GET[ 'post' ] ) ) ? $_GET[ 'post' ] : '';
		if ( empty( $post_id ) ) {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
		}
		$template_file = get_post_meta( $post_id, '_wp_page_template', true );
		if ( 'portfolio-template.php' === $template_file ) {
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
		} elseif ( 'blog-template.php' === $template_file || 'blog-template-grid.php' === $template_file || 'blog-template-masonry.php' === $template_file ) {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
		} else {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
		}
	}
}

add_action( 'do_meta_boxes', 'seosight_disable_admin_metabox', 99 );

/**
 * Extend the default WordPress category title.
 *
 * Remove 'Category' word from cat title.
 *
 * @param string $title Original category title.
 *
 * @return string The filtered category title.
 * @internal
 */
function _filter_seosight_archive_title( $title ) {
	if ( is_home() ) {
		$title = esc_html__( 'Latest posts', 'seosight' );
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( ( is_singular( 'post' ) ) ) {
		$category	 = get_the_category( get_the_ID() );
		$title		 = $category[ 0 ]->name;
	} elseif ( is_singular( 'product' ) || is_singular( 'download' ) ) {
		$title = '<h2 class="stunning-header-title h1">' . esc_html__( 'Product Details', 'seosight' ) . '</h2>';
	}

	return $title;
}

add_filter( 'get_the_archive_title', '_filter_seosight_archive_title' );

/**
 *  Demo install config
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */
function _filter_seosight_fw_ext_backups_demos( $demos ) {
	$demos_array = array(
		'seosight-main' => array(
			'title'			 => esc_html__( 'Main demo', 'seosight' ),
			'screenshot'	 => get_template_directory_uri() . '/screenshot.png',
			'preview_link'	 => 'https://seosight.crumina.net/',
		),
			// ...
	);

	$download_url = 'http://up.crumina.net/demo-data/seosight/upload.php';

	foreach ( $demos_array as $id => $data ) {
		$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'		 => $download_url,
			'file_id'	 => $id,
				) );
		$demo->set_title( $data[ 'title' ] );
		$demo->set_screenshot( $data[ 'screenshot' ] );
		$demo->set_preview_link( $data[ 'preview_link' ] );

		$demos[ $demo->get_id() ] = $demo;

		unset( $demo );
	}

	return $demos;
}

add_filter( 'fw:ext:backups-demo:demos', '_filter_seosight_fw_ext_backups_demos' );

function seosight_remove_admin_login_header() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

add_action( 'get_header', 'seosight_remove_admin_login_header' );




/**
 * Exclude kc Section Post type from search query
 */
add_action( 'init', 'seosight_exclude_kc_section_search', 99 );

function seosight_exclude_kc_section_search() {
	global $wp_post_types;
	if ( post_type_exists( 'kc-section' ) ) {
		$wp_post_types[ 'kc-section' ]->exclude_from_search = true;
	}
}

/**
 * Modify query to remove a post type from search results, but keep all others
 *
 * @author Joshua David Nelson, josh@joshuadnelson.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2+
 */
add_action( 'pre_get_posts', 'seosight_search_modify_query' );

function seosight_search_modify_query( $query ) {

	// First, make sure this isn't the admin and is the main query, otherwise bail
	if ( is_admin() || !$query->is_main_query() )
		return;

	// If this is a search result query
	if ( $query->is_search() ) {
		// Gather all searchable post types
		$in_search_post_types	 = get_post_types( array( 'exclude_from_search' => false ) );
		// The post type you're removing, in this example 'kc-section'
		$post_type_to_remove	 = 'kc-section';
		// Make sure you got the proper results, and that your post type is in the results
		if ( is_array( $in_search_post_types ) && in_array( $post_type_to_remove, $in_search_post_types ) ) {
			// Remove the post type from the array
			unset( $in_search_post_types[ $post_type_to_remove ] );
			// set the query to the remaining searchable post types
			$query->set( 'post_type', $in_search_post_types );
		}
	}
}

/**
 * Extension update message
 */
add_action( 'admin_notices', 'seosight_update_checker_message' );

function seosight_update_checker_message() {

	if ( !function_exists( 'fw' ) ) {
		return;
	}

	$update_checker = fw()->extensions->get( 'update-checker' );
	if ( !$update_checker ) {
		return;
	}

	if ( !version_compare( $update_checker->manifest->get_version(), '2.0.0', '<' ) ) {
		return;
	}

	$class	 = 'notice notice-error';
	$message = __( sprintf( 'Please, delete and reinstall Unison Update checker to get automatic theme updates. <a href="%1$s" class="button button-primary" target="_blank">%2$s</a>', 'https://support.crumina.net/help-center/articles/252/theme-is-not-activated', esc_html__( 'View instruction', 'seosight' ) ), 'seosight' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
}

/**
 * Enable YouTube Video BG for our KingComposer Rows
 */
function seosight_include_youtube_api_js( $atts ) {
	if ( isset( $atts[ 'video_bg' ] ) && $atts[ 'video_bg' ] == 'yes' ) {
		wp_register_script( 'kc-youtube-iframe-api', 'https://www.youtube.com/iframe_api', null, '', true );
		wp_enqueue_script( 'kc-youtube-iframe-api' );
	}

	return $atts;
}

add_filter( 'shortcode_kc_row', 'seosight_include_youtube_api_js' );

/**
 * Add shortcode support for text widgets
 */
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Enqueue woocommerce scripts
 */
add_filter( 'woocommerce_is_checkout', 'seosight_woocommerce_is_checkout' );

function seosight_woocommerce_is_checkout( $checkout ) {
	global $post;

	if ( !isset( $post->post_content_filtered ) ) {
		return $checkout;
	}

	if ( has_shortcode( $post->post_content_filtered, 'woocommerce_checkout' ) ) {
		$checkout = true;
	}

	return $checkout;
}

add_action( 'fw_extensions_before_init', '_action_crum_disable_fw_blog' );

function _action_crum_disable_fw_blog() {
	if ( ( $e = get_option( 'fw_active_extensions' ) ) && isset( $e[ 'update-checker' ] ) ) {
		unset( $e[ 'update-checker' ] );
		update_option( 'fw_active_extensions', $e );
	}
}

add_action( 'admin_enqueue_scripts', '_action_crumina_yoast_kc_compitablity' );

function _action_crumina_yoast_kc_compitablity() {
	global $pagenow, $typenow;

	$post_ID = filter_input( INPUT_GET, 'post', FILTER_VALIDATE_INT );
	if ( !defined( 'WPSEO_VERSION' ) || !$post_ID ) {
		return;
	}

	if ( empty( $typenow ) ) {
		$post	 = get_post( $_GET[ 'post' ] );
		$typenow = $post->post_type;
	}
	if ( ( $pagenow == 'post.php' && $typenow == 'page' ) || ( $pagenow == 'post-new.php' && $typenow == 'page' ) ) {
		wp_enqueue_script( 'crum-yoast-seo', get_template_directory_uri() . '/js/king-yoast.js', array( 'jquery' ), '1', true );

		wp_localize_script( 'crum-yoast-seo', 'cruminaKingYoastConf', array(
			'ajaxUrl'	 => admin_url( 'admin-ajax.php' ),
			'action'	 => 'crumina_yoast_kc_get_content',
			'post_ID'	 => $post_ID
		) );
	}
}

add_action( "wp_ajax_crumina_yoast_kc_get_content", "_action_crumina_yoast_kc_get_content" );
add_action( "wp_ajax_nopriv_crumina_yoast_kc_get_content", "_action_crumina_yoast_kc_get_content" );

function _action_crumina_yoast_kc_get_content() {
	global $allowedposttags;
	$post_ID = filter_input( INPUT_POST, 'post_ID', FILTER_VALIDATE_INT );

	if ( $post_ID ) {
		$content = get_post_field( 'post_content', $post_ID );

		$builder_meta = get_post_meta( $post_ID, 'kc_data', true );

		if ( function_exists( 'kc_do_shortcode' ) && isset( $builder_meta[ 'mode' ] ) && $builder_meta[ 'mode' ] === 'kc' ) {
			$content = kc_do_shortcode( $content );

			$content = preg_replace( "/<style.+?<\/style>/", "", $content );
			$content = preg_replace( "/<script.+?<\/script>/", "", $content );
			$content = preg_replace( "/[\s\r\n]+/", " ", $content );

			echo strip_tags( $content, '<p><a><ul><li><ol><h1><h2><h3><h4><h5><h6><img><em><strong><blockquote><del><cite><i><strike><pre><code><acronym>' );
		}
	}

	die();
}

add_filter( 'fw_ext_ajax_portfolio_kc_shortcode', '_filter_seosight_ajax_portfolio_kc_shortcode', 99 );

function _filter_seosight_ajax_portfolio_kc_shortcode( $options ) {

	$options[ 'ajax-portfolio' ][ 'params' ][] = array(
		'label'	 => esc_html__( 'Show 2 portfolio items in first row', 'seosight' ),
		'name'	 => 'two_portfolio_items',
		'type'	 => 'toggle',
		'value'	 => 'yes',
	);

	return $options;
}

add_filter( 'fw_ext_ajax_portfolio_kc_shortcode_default', '_filter_seosight_ajax_portfolio_kc_shortcode_default', 99 );

function _filter_seosight_ajax_portfolio_kc_shortcode_default( $options ) {
	$options[ 'two_portfolio_items' ] = 'yes';
	return $options;
}
