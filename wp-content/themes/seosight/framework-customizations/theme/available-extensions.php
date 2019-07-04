<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$extensions = array(
    'ajax-portfolio' => array(
        'name'         => esc_html__( 'Ajax portfolio', 'seosight' ),
        'description'  => esc_html__( 'Ajax portfolio.', 'seosight' ),
        'thumbnail'    => get_template_directory_uri() . '/images/ajax-portfolio-extension-thumb.png',
        'display'      => true,
        'standalone'   => false,
        'download'     => array(
            'source' => 'custom',
            'opts'   => array(
                'remote' => 'https://up.crumina.net/extensions/versions/',
            ),
        ),
        'requirements' => array(
            'extensions' => array(
                'portfolio' => array(),
            )
        ),
    ),
);
