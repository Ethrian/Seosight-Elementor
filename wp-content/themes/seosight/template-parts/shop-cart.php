<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
$currency = get_woocommerce_currency();
?>
<div class="cart-contents">
	<a class="js-cart-animate" href="<?php echo wc_get_page_permalink( 'cart' ); ?>"
	   title="<?php esc_html_e( 'View your shopping cart', 'seosight' ); ?>">
		<i class="seoicon-basket"></i>
		<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	</a>
	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
		<div class="cart-popup-wrap cart-with-product">
			<div class="popup-cart">
				<h4 class="title-cart"><?php esc_html_e( 'You added to cart:', 'seosight' ); ?></h4>
				<div class="cart-product">
					<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							?>
							<div class="cart-product__item">
								<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
								<div class="cart-product-content">
									<h4 class="cart-product-title"><a href="<?php echo get_permalink( $product_id ); ?>"><?php echo esc_html( $product_name ) ?></a></h4>
									<div class="price"><span class="count"><?php echo esc_html($cart_item['quantity']) ?></span> x <span
											class=""><?php echo esc_html($cart_item['quantity']) . get_woocommerce_currency_symbol( $currency ); ?></span></div>
								</div>
							</div>
							<?php
						}
					} ?>
				</div>
			</div>
			<div class="cart-total">
				<div class="cart-total-text">
					<h4 class="title"><?php esc_html_e( 'total:', 'seosight' ); ?></h4>
					<div class="total-price"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
				</div>
				<a class="btn btn-small btn--dark" href="<?php echo wc_get_page_permalink( 'cart' ); ?>">
					<span class="text">View Cart</span>
				</a>

				<a class="btn btn-small btn--primary" href="<?php echo wc_get_page_permalink( 'checkout' ); ?>">
					<span class="text">Checkout</span>
				</a>
			</div>
		</div>
	<?php else : ?>
		<div class="cart-popup-wrap">
			<div class="popup-cart">
				<h4 class="title-cart"><?php esc_html_e( 'No products in the cart!', 'seosight' ); ?></h4>
				<p class="subtitle"><?php esc_html_e( 'Please make your choice.', 'seosight' ); ?></p>
				<a class="btn btn-small btn--dark" href="<?php echo wc_get_page_permalink( 'shop' ); ?>">
					<span class="text"><?php esc_html_e( 'View all catalog', 'seosight' ); ?></span>
				</a>
			</div>
		</div>
	<?php endif; ?>
</div>



