<?php
/*
  * FIle for include classes and functions for extending
  * Plugins functionality when tat plugins are installed
  */


/**
 * Activate theme Plugins.
 *
 * @internal
 */
function _action_seosight_register_required_plugins() {
    tgmpa( array(
	    array(
		    'name'         => esc_html__( 'Unyson', 'seosight' ),
		    'slug'         => 'unyson',
		    'source'       => 'http://up.crumina.net/plugins/unyson.zip', // The plugin source
		    'version'      => '2.12.7',
		    'is_automatic' => true,
		    'required'     => true,
	    ),
        array(
            'name'         => esc_attr__( 'King Composer', 'seosight' ),
            'slug'         => 'kingcomposer',
            'source'       => 'http://up.crumina.net/plugins/kingcomposer.zip', // The plugin source
            'version'      => '2.8.8.1',
            'required'     => true,
        ),
        array(
            'name'         => esc_attr__( 'Frontend Editor', 'seosight' ),
            'slug'         => 'kc_pro',
            'source'       => 'http://kingcomposer.com/downloads/kc_pro.zip', // The plugin source
            'required'     => false,
        ),

	    array(
		    'name'         => esc_attr__( 'Envato Market', 'seosight' ),
		    'slug'         => 'envato-market',
		    'source'       => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip', // The plugin source
		    'required'     => true,
	    ),
        array(
            'name'         => esc_attr__( 'Email Subscribers', 'seosight' ),
            'slug'         => 'email-subscribers',
            'required'     => false,
        ),
        array(
            'name' => esc_attr__( 'WooCommerce', 'seosight' ),
            'slug' => 'woocommerce',
            'required'     => false,
        ),
    ) );
}

add_action( 'tgmpa_register', '_action_seosight_register_required_plugins' );


if ( class_exists( 'WooCommerce' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/woocommerce.php' );
	load_template( $file_path );
}
if ( class_exists( 'KingComposer' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/kingcomposer.php' );
	load_template( $file_path );
}
if ( class_exists( 'WPCF7' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/contact-form-7.php' );
	load_template( $file_path );
}


//theme activate
load_template( get_template_directory().'/inc/includes/auto-setup/class-fw-auto-install.php', true );

