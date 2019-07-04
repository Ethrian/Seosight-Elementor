<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array  $args
 * @var string $title
 * @var array  $socials
 */

wp_enqueue_script(
	'js-cookie',
	get_template_directory_uri() . '/inc/widgets/follow-us/static/js/js.cookie.js',
	array( 'jquery' ),
	'2.1.3',
	true
);

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

seosight_render( $before_widget );

if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
}
if ( ! empty( $socials ) ) {
	$social_networks = seosight_user_social_networks();
	?>
	<div class="w-follow-wrap"  itemscope itemtype="http://schema.org/Organization">
		<?php foreach ( $socials as $network => $data ) { ?>
			<div class="w-follow-item <?php echo esc_attr( $data['network'] ) ?>-bg-color w-follow-social__item" data-network="follow-<?php echo esc_attr( $data['network'] ) ?>">
					<span class="social-icon">
						<i class="<?php echo esc_attr( $social_networks[ $data['network'] ]['icon'] ) ?>"></i>
					</span>
					<span class="w-follow-title"><?php echo esc_attr( $social_networks[ $data['network'] ]['label'] ) ?>
						<span class="w-follow-add"><i class="seoicon-cross plus"></i><i class="seoicon-check check"></i></span>
					</span>
				<a href="<?php echo esc_url( $data['link'] ); ?>" class="full-block" rel="nofollow" itemprop="sameAs"></a>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php ob_start(); ?>
		jQuery(document).ready(function () {
			var $socials = jQuery('.w-follow-social__item');
			$socials.each(function () {
				var $this = jQuery(this);
				if ('true' == Cookies.get($this.data('network'))) {
					$this.find('.w-follow-add').addClass('active');
				}
			});
			$socials.on('click', function () {
				jQuery(this).find('.w-follow-add').addClass('active');
				Cookies.set(jQuery(this).data('network'), true);
			});
		});
<?php $js_content = ob_get_clean();
echo fw_html_tag( 'script', array( 'type' => 'text/javascript' ), $js_content );
seosight_render( $after_widget );
