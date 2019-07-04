<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$tabs  = apply_filters( 'woocommerce_product_tabs', array() );
$first = true;
if ( ! empty( $tabs ) ) : ?>
	<div class="product-description">
		<div class="container">
			<ul class="product-description-control" role="tablist">
				<?php foreach ( $tabs as $key => $tab ) :
					$active_class = ( $first === true ) ? 'active' : ''; ?>
					<li class="<?php echo esc_attr( $key . ' ' . $active_class ) ?>" role="presentation">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" data-toggle="tab" class="control-item">
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
						</a>
					</li>
					<?php $first = false; ?>
				<?php endforeach; ?>
			</ul>
			<?php $first = true; ?>
			<div class="tab-content">
				<?php foreach ( $tabs as $key => $tab ) :
					$active_class = ( $first === true ) ? 'active' : ''; ?>
					<div role="tabpanel" class="tab-pane fade in <?php echo esc_attr( $active_class ) ?>" id="tab-<?php echo esc_attr( $key ); ?>">
						<div class="row">
							<div class="col-lg-12">
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
								<?php $first = false; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>