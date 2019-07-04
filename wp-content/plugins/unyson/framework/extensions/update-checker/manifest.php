<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$manifest = array();

$manifest[ 'name' ]         = __( 'Update checker', 'fw' );
$manifest[ 'description' ]  = __( 'Update checker.', 'fw' );
$manifest[ 'version' ]      = '3.0';
$manifest[ 'display' ]      = true;
$manifest[ 'standalone' ]   = true;
$manifest[ 'thumbnail' ]    = plugins_url( 'unyson/framework/extensions/update-checker/static/img/thumbnail.png' );
$manifest[ 'remote' ]       = 'https://up.crumina.net/extensions/versions/';
$manifest[ 'purchase_key' ] = 'crumina-update-checker-extension';
