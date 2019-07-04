<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var array  $args
 * @var string $title
 * @var string $background
 * @var string $icon
 * @var string $text
 * @var string $button_text
 * @var string $button_link
 * @var string $button_color
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );
seosight_render( $before_widget );

$style = ! empty( $background ) ? 'style="background: url(' . esc_url( $background ) . ')"' : ''; ?>

	<div class="w-banner-content" <?php seosight_render( $style ) ?> >
		<?php
		if ( ! empty( $icon ) ) {
			echo fw_html_tag( 'img', array( 'src' => $icon, 'class' => 'banner-image', 'alt' => '' ) );
		}
		if ( $title ) {
			echo( '<h4 class="w-banner-content-title">' . esc_html( $title ) . '</h4>' );
		}
		echo '<div class="w-banner-content-text">' . wpautop( $text ) . '</div>';
		if ( ! empty( $button_text ) && ! empty( $button_link ) ) { ?>
			<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-small btn--<?php echo esc_attr( $button_color ) ?> btn-hover-shadow">
				<span class="text"><?php echo esc_html( $button_text ); ?></span>
			</a>
		<?php } ?>
	</div>
<?php
seosight_render( $after_widget );


