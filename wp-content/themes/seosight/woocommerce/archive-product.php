<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
$layout          = seosight_sidebar_conf();
$main_class      = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$container_width = 'container';
$padding_class   = 'medium-padding120';
if ( is_shop() ) {
	$shop_page_id = wc_get_page_id( 'shop' );
	$builder_meta = get_post_meta( $shop_page_id, 'kc_data', true );
	if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] && 'full' === $layout['position'] ) {
		$container_width = 'page-builder-wrap';
		$padding_class   = '';
	}
}
?>
    <div id="primary" class="<?php echo esc_attr( $container_width ) ?>">
        <div class="row <?php echo esc_attr( $padding_class ) ?>">
            <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                <main id="main" class="<?php echo esc_attr( $main_class ) ?>">
					<?php
					/**
					 * Hook: woocommerce_before_main_content.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 * @hooked WC_Structured_Data::generate_website_data() - 30
					 */
					do_action( 'woocommerce_before_main_content' );

					?>
                    <header class="woocommerce-products-header">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>

						<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
						?>
                    </header>

					<?php if ( have_posts() ) { ?>
                        <div class="woocommerce-grid-control">
							<?php
							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked wc_print_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>
                        </div>
						<?php
						woocommerce_product_loop_start();

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}

						woocommerce_product_loop_end();

						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					} ?>
            </div>
			<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
			?>
            </main><!-- #main -->

			<?php if ( 'full' !== $layout['position'] ) { ?>
                <div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php do_action( 'woocommerce_sidebar' ); ?>
                </div>
			<?php } ?>
        </div><!-- #row -->
    </div><!-- #primary -->

<?php get_footer( 'shop' );