<?php
$id      = get_the_ID();
$title   = get_the_title( $id );
$link    = get_permalink( $id );
$image   = get_the_post_thumbnail_url( $id, 'large' );
$caption = wp_trim_words( get_the_excerpt(), 20 );

?>
<div class="socials-panel">
	<div class="socials-panel-item facebook-bg-color sharer" data-sharer="facebook" data-url="<?php echo esc_attr( $link ) ?>">
		<span class="social__item">
			<i class="fa fa-facebook"></i>
			<?php esc_html_e( 'Facebook', 'seosight' ); ?>
		</span>
	</div>
	<div class="socials-panel-item twitter-bg-color sharer" data-sharer="twitter" data-title="<?php echo esc_attr( $title ) ?>" data-url="<?php echo esc_attr( $link ) ?>">
		<span class="social__item">
			<i class="fa fa-twitter"></i>
			<?php esc_html_e( 'Twitter', 'seosight' ); ?>
		</span>
	</div>
	<div class="socials-panel-item linkedin-bg-color sharer" data-sharer="vk" data-caption="<?php echo esc_attr( $caption ) ?>" data-title="<?php echo esc_attr( $title ) ?>">
		<span class="social__item">
			<i class="fa fa-vk"></i>
			<?php esc_html_e( 'Vkontakte', 'seosight' ); ?>
		</span>
	</div>
	<div class="socials-panel-item google-bg-color sharer" data-sharer="googleplus" data-url="<?php echo esc_attr( $link ) ?>">
		<span class="social__item">
			<i class="fa fa-google-plus"></i>
			<?php esc_html_e( 'Google+', 'seosight' ); ?>
		</span>
	</div>
	<div class="socials-panel-item pinterest-bg-color sharer" data-sharer="pinterest" data-image="<?php echo esc_attr( $image ) ?>" data-description="<?php echo esc_attr( $caption ) ?>"
	     data-url="<?php echo esc_attr( $link ) ?>">
		<span class="social__item">
			<i class="fa fa-pinterest-p"></i>
			<?php esc_html_e( 'Pinterest', 'seosight' ); ?>
		</span>
	</div>
</div>