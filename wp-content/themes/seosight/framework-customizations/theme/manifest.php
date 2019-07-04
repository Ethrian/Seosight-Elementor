<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['id'] = 'seosight';

$manifest['supported_extensions'] = array(
	'slider'         => array(),
	'breadcrumbs'    => array(),
	'megamenu'       => array(),
	'portfolio'      => array(),
	'sidebars'       => array(),
	'backups'        => array(),
	'analytics'      => array(),
	'forms'          => array(),
);
$manifest['requirements']         = array(
	'wordpress'  => array(
		'min_version' => '4.6',
	),
	'extensions' => array(
		'megamenu'       => array(),
		'sidebars'       => array(),
		'builder'        => array(),
		'forms'          => array(),
	)
);
