<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<div class="contact-form">
	<form method="post" class="login shop-user-form-return" <?php seosight_render( $hidden ) ? 'style="display:none;"' : ''; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php seosight_render ( $message ? wpautop( wptexturize( $message ) ) : '' ); // @codingStandardsIgnoreLine ?>

		<div class="row">
			<div class="col-lg-5">
				<input class="email input-standard-grey" name="username" id="username" placeholder="<?php esc_html_e( 'Username or email', 'seosight' ); ?>" type="text"/>
			</div>

			<div class="col-lg-5">
				<input class="email input-standard-grey" name="password" id="password" placeholder="<?php esc_html_e( 'Password', 'seosight' ); ?>" type="password">
			</div>

			<div class="col-lg-2">
				<a class="helped" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'seosight' ); ?></a>
			</div>
		</div>
		<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

		<div class="row">
			<div class="col-lg-4">
				<div class="login-btn-wrap">
					<input type="submit" class="btn btn-medium btn--dark btn-hover-shadow" name="login" value="<?php esc_attr_e( 'Login', 'seosight' ); ?>"/>
					<div class="remember-wrap">
						<div class="checkbox">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever"/>
							<label for="rememberme"><?php esc_html_e( 'Remember me', 'seosight' ); ?></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<p class="form-row">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>"/>
		</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

	</form>
</div>