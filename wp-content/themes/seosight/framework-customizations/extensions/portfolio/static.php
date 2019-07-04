<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext_instance = fw()->extensions->get( 'portfolio' );


wp_enqueue_script(
	'seosight-portfolio-likes',
	$ext_instance->locate_js_URI( 'likes' ),
	array( 'jquery' ),
	'1',
	true
);
wp_localize_script('seosight-portfolio-likes', 'fwAjaxUrl', admin_url( 'admin-ajax.php', 'relative' ));

wp_enqueue_script( 'seosight-share-buttons',
	get_template_directory_uri() . '/js/sharer.min.js',
	array(),
	'0.5',
	true
);