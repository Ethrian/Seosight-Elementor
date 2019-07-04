<?php if (!defined('FW')) die('Forbidden');

/**
 * Just for removing FW_Ext_Mega_Menu_Walker set in the previous
 * filter when the fallback menu is in action.
 * @param array $args
 * @return array
 * @internal
 */
function _filter_fw_ext_mega_menu_wp_page_menu_args($args) {
	if ($args['walker'] instanceof FW_Ext_Mega_Menu_Walker) {
		$args['walker'] = '';
	}

	return $args;
}
add_filter('wp_page_menu_args', '_filter_fw_ext_mega_menu_wp_page_menu_args');

/**
 * @param [WP_Post] $sorted_menu_items
 * @param $args
 * @return array
 * @internal
 */
function _filter_fw_ext_mega_menu_wp_nav_menu_objects($sorted_menu_items, $args) {
	// <li id="menu-item-1234" class="menu-item menu-item-type-post_type ... mega-menu">
	//     ....
	// </li>

	$mega_menu = array();
	foreach ($sorted_menu_items as $item) {
		if ($item->menu_item_parent == 0 && fw_ext_mega_menu_get_meta($item, 'enabled')) {
			$mega_menu[$item->ID] = true;
		}
	}

	foreach ($sorted_menu_items as $item) {
		if (isset($mega_menu[$item->ID])) {
			$item->classes[] = 'menu-item-has-mega-menu';
		}
		if (isset($mega_menu[$item->menu_item_parent])) {
			$item->classes[] = 'mega-menu-col';
		}
		if (fw_ext_mega_menu_get_meta($item, 'icon')) {
			$item->classes[] = 'menu-item-has-icon';
		}
	}

	return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects', '_filter_fw_ext_mega_menu_wp_nav_menu_objects', 10, 2);


/*Allow HTML in menu item description*/
remove_filter( 'nav_menu_description', 'strip_tags' );