<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var array  $args
 * @var string $title
 * @var string $widget_text
 * @var string $button_text
 * @var string $button_link
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );
seosight_render( $before_widget );
if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
}

$link = ! empty( $button_link ) ? $button_link : '#';
$text = ! empty( $button_text ) ? $button_text : esc_html__( 'Learn More', 'seosight' );
if ( ! empty( $description ) ) {
	echo '<div class="text-wrap">' . wpautop( do_shortcode( $widget_text ) ) . '</div>';
} ?>
	<a href="<?php echo esc_url( $link ); ?>" class="btn btn-small btn-border c-primary btn--primary">
		<span class="text"><?php echo esc_html( $text ); ?></span>
		<i class="seoicon-right-arrow"></i>
	</a>
<?php
seosight_render( $after_widget );