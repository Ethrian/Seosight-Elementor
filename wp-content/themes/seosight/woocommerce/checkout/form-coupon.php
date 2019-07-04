<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}
$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'seosight' ) . ' <a href="#" class="showcoupon"><span class="c-primary">' . esc_html__( 'Click here to enter your code', 'seosight' ) . '</span></a>' );
echo '<h4 class="item-title">' . $info_message . '</h4>';
?>
<div class="bg-border-color">

    <form class="checkout_coupon coupon" method="post" style="display:none">
        <input class="email input-standard-grey" value="" name="coupon_code" id="coupon_code"
               placeholder="<?php esc_attr_e( 'Coupon code', 'seosight' ); ?>" type="text">
        <input type="submit" class="btn btn-medium btn--breez btn-hover-shadow" name="apply_coupon"
               value="<?php esc_attr_e( 'Apply coupon', 'seosight' ); ?>"/>
    </form>

</div>