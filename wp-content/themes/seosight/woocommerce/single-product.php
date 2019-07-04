<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' );
$layout = seosight_sidebar_conf();
$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
?>
    <div id="primary" class="container">
        <div class="row medium-padding120">
            <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                <main id="main" class="<?php echo esc_attr( $main_class ) ?>" >

                    <?php
                    /**
                     * woocommerce_before_main_content hook.
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action( 'woocommerce_before_main_content' );
                    ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'single-product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                    <?php
                    /**
                     * woocommerce_after_main_content hook.
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action( 'woocommerce_after_main_content' );
                    ?>
                </main><!-- #main -->
            </div>
            <?php if ( 'full' !== $layout['position'] ) { ?>
                <div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
                    <?php do_action( 'woocommerce_sidebar' ); ?>
                </div>
            <?php } ?>
        </div><!-- #row -->
    </div><!-- #primary -->

<?php woocommerce_output_product_data_tabs(); ?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
    <div class="container">
        <div class="interested-products ">
            <?php
            /**
             * woocommerce_after_single_product_summary hook.
             *
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>
    </div>
<?php get_footer( 'shop' );
