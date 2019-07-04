<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array  $args
 * @var string $title
 * @var string $menu
 * @var string $link
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

seosight_render( $before_widget );

if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
}
if ( ! is_user_logged_in() ) { ?>
	<form method="post" action="<?php echo wp_login_url(); ?>">
		<input class="email input-standard-grey" name="log" placeholder="<?php esc_html_e( 'Username or Email', 'seosight' ); ?>" type="text">
		<input class="password input-standard-grey" name="pwd" placeholder="<?php esc_html_e( 'Password', 'seosight' ); ?>" type="password">
		<div class="login-btn-wrap">
			<button class="btn btn-medium btn--dark btn-hover-shadow">
				<span class="text"><?php esc_html_e( 'Authorize', 'seosight' ); ?></span>
				<span class="semicircle"></span>
			</button>
			<div class="remember-wrap">
				<div class="checkbox">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever">
					<label for="rememberme"><?php esc_html_e( 'Remember Me', 'seosight' ); ?></label>
				</div>
			</div>
		</div>
		<div class="helped">
			<a href="<?php echo esc_url( wp_lostpassword_url( get_permalink() ) ); ?>"><?php esc_html_e( 'Lost your password?', 'seosight' ); ?></a>
			<?php if ( get_option( 'users_can_register' ) ) { ?>
                <a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e( 'Register now', 'seosight' ); ?></a>
			<?php } ?>
		</div>
		<input type="hidden" name="redirect_to" value="<?php echo esc_url( $link ); ?>">
	</form>
	<?php
} else {
	global $user_login;
	$current_user = wp_get_current_user(); ?>
	<div class="top-avatar">
		<?php if ( ( $current_user instanceof WP_User ) ) {
			echo get_avatar( $current_user->user_email, 90 );
		} ?>
	</div>

	<?php if ( ! empty( $menu ) ) { ?>
		<div class="w-custom-menu">
			<?php if ( ! empty( $menu ) ) {
				wp_nav_menu( array( 'menu' => $menu, 'container' => 'ul', 'menu_class' => 'list--traingle', 'fallback_cb' => '', 'walker' => new Seosight_Widget_Walker_Nav() ) );
			} ?>
		</div>
	<?php } ?>

	<div class="helped">
		<?php wp_loginout(); ?>
	</div>
<?php }

seosight_render( $after_widget );



