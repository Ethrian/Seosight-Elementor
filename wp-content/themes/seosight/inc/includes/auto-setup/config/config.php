<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
return array(
	/**
	 * Array for demos
	 */
	'demos'              => array(
		'seosight-main'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),
		),
	),
	'plugins'            => array(
		array(
			'name'         => esc_attr__( 'King Composer', 'seosight' ),
			'slug'         => 'kingcomposer',
		),
		array(
			'name'         => esc_attr__( 'Frontend Editor', 'seosight' ),
			'slug'         => 'kc_pro',
			'source'       => 'http://kingcomposer.com/downloads/kc_pro.zip', // The plugin source
		),
		array(
			'name'         => esc_attr__( 'Envato Market', 'seosight' ),
			'slug'         => 'envato-market',
			'source'       => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip', // The plugin source
		),
		array(
			'name'         => esc_attr__( 'Email Subscribers', 'seosight' ),
			'slug'         => 'email-subscribers',
		)
	),
	'theme_id'           => 'seosight',
	'child_theme_source' => 'http://up.crumina.net/demo-data/seosight/seosight-child.zip',
	'has_demo_content'   => true
);
