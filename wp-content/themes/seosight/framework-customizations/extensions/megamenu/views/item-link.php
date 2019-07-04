<?php if (!defined('FW')) die('Forbidden');

/**
 * @var WP_Post $item
 * @var string $title
 * @var array $attributes
 * @var object $args
 * @var int $depth
 * @var string $item_arrow_icon
 */

if ( fw()->extensions->get( 'megamenu' )->show_icon() ) {
    $dirty = fw_ext_mega_menu_get_meta( $item->ID, "icon" );
    $parsed = (array) json_decode( urldecode( $dirty ) );
    
    if($dirty && !$parsed ){
        $parsed = array(
            'type' => 'icon-font',
            'icon-class' => $dirty
        );
    }
    
    $icon = array_merge( array(
        'type'          => '',
        'icon-class'    => '',
        'attachment-id' => '',
        'url'           => ''
    ), $parsed );

    if ( $icon[ 'type' ] === 'custom-upload' && !empty( $icon[ 'url' ] ) ) {
        $title = fw_html_tag( 'img', array(
            'class' => 'menu-item-icon menu-item-icon-img',
            'src'   => $icon[ 'url' ],
            'alt'   => 'Menu item img icon'
        ), false ) . $title;
    }

    if ( $icon[ 'type' ] === 'icon-font' && !empty( $icon[ 'icon-class' ] ) ) {
        $title = fw_html_tag( 'i', array( 'class' => 'menu-item-icon ' . $icon[ 'icon-class' ] ), true ) . $title;
    }
}

seosight_render($args->before);
/*If empty link in item - we will print title item instead link*/
if ( empty( $attributes['href'] ) || $attributes['href'] === 'http://' || $attributes['href'] === 'http://#' || $attributes['href'] === 'https://' || $attributes['href'] === 'https://#' ) {

	echo '<div class="megamenu-item-info">';
	if ($depth > 0 && true !== fw_ext_mega_menu_get_meta($item, 'title-off')) {
		echo fw_html_tag( 'div', array( 'class' => 'h5 megamenu-item-info-title' ), $title );
	}
	if ( ! empty( $item->description ) ) {
		echo fw_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ),  do_shortcode( $item->description ) );
	}
	echo '</div>';
} else {
	if ($depth !== 0){
		$title .= fw_html_tag( 'i', array( 'class' => $item_arrow_icon ), true );
	}
	if ($depth > 0 && false !== fw_ext_mega_menu_get_meta($item, 'title-off')) {
		echo fw_html_tag('a', $attributes, $args->link_before . $title . $args->link_after);
		if ( ! empty( $item->description ) ) {
			echo fw_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ), do_shortcode( $item->description ) );
		}
	} else {
		echo fw_html_tag('a', $attributes, $args->link_before . $title . $args->link_after);
	}
}
seosight_render($args->after);
