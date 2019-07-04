<?php

if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/*
  Woocommerce additional hooks and actions and theme customizations.
 */

add_action( 'init', 'seosight_woocommerce_modifications' );

function seosight_woocommerce_modifications() {
	// Remove breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	//replace pagination
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	add_action( 'woocommerce_after_shop_loop', 'seosight_paging_nav', 10 );
	// Product title custom
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'seosight_woocommerce_template_loop_product_title', 10 );
	//Remove Rating from loop
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	//Remove Tabs (it's displayed before this action )
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	// change avatar image size on comments section
	remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
	add_action( 'woocommerce_review_before', 'seosight_review_display_gravatar', 10 );
	// add title on cart page with total cart items.
	add_action( 'woocommerce_before_cart', 'seosight_before_cart_title', 10 );
}

function seosight_review_display_gravatar( $comment ) {
	$avatar_img = get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '70' ), '' );
	echo str_replace( 'avatar ', 'comment-avatar', $avatar_img );
}

function seosight_before_cart_title() {
	echo '<h2 class="h1 cart-title">' . sprintf( esc_html__( 'In Your Shopping Cart:', 'seosight' ) . ' <span class="c-primary"> %d ' . esc_html__( 'items', 'seosight' ) . '</span>', WC()->cart->get_cart_contents_count() ) . '</h2>';
}

add_filter( 'woocommerce_show_page_title', 'seosight_remove_heder_title' );

function seosight_remove_heder_title() {
	return false;
}

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'seosight_shop_dequeue_styles' );

function seosight_shop_dequeue_styles( $enqueue_styles ) {
	//unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles[ 'woocommerce-layout' ] );  // Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

function seosight_woocommerce_template_loop_product_title() {
	global $product;
	echo '<div class="product-item-info">';
	seosight_render( wc_get_product_category_list( $product->get_id(), ', ', '<div class="product-category">', '</div>' ) );
	echo '<h4 class="h5 product-title"><a href="' . get_permalink() . '">' . esc_html( get_the_title() ) . '</a></h4>';
	echo '</div>';
}

/**
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
add_filter( 'woocommerce_output_related_products_args', 'seosite_related_products_args' );

function seosite_related_products_args( $args ) {
	$args[ 'posts_per_page' ]	 = 3; // 3 related products
	$args[ 'columns' ]			 = 3; // 3 related products in a row
	return $args;
}

/**
 * Define image sizes
 */
function seosight_woocommerce_image_dimensions() {
	global $pagenow;

	if ( !isset( $_GET[ 'activated' ] ) || $pagenow != 'themes.php' ) {
		return;
	}
	$catalog	 = array(
		'width'	 => '280', // px
		'height' => '280', // px
		'crop'	 => 1   // true
	);
	$single		 = array(
		'width'	 => '600', // px
		'height' => '600', // px
		'crop'	 => 0   // true
	);
	$thumbnail	 = array(
		'width'	 => '120', // px
		'height' => '120', // px
		'crop'	 => 1   // false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );   // Product category thumbs
	update_option( 'shop_single_image_size', $single );   // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail );  // Image gallery thumbs
	update_option( 'woocommerce_enable_lightbox', false );
}

add_action( 'after_switch_theme', 'seosight_woocommerce_image_dimensions', 1 );


/* Ajaxify cart */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	get_template_part( 'template-parts/shop', 'cart' );
	$fragments[ '.cart-contents' ] = ob_get_clean();
	return $fragments;
}

//Replace woocommerce button on order page
add_filter( 'woocommerce_order_button_html', 'seosight_order_button_html' );

function seosight_order_button_html() {
	return '<button class="btn btn-medium btn--light-green btn-hover-shadow" name="woocommerce_checkout_place_order" id="place_order">
								<span class="text">' . esc_attr__( 'Place order', 'seosight' ) . '</span>
								<span class="semicircle"></span>
							</button>';
}
