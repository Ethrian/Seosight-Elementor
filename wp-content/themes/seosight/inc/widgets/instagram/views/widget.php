<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var $size
 * @var $columns
 * @var $media_array
 * @var $target
 * @var $space
 * @var $button
 */


$wrap_class = ( ! empty( $space ) ) ? 'w-instagramm-padding' : '';

if ( is_wp_error( $media_array ) ) {
	echo wp_kses_post( $media_array->get_error_message() );
} else {
	if ( $images_only = apply_filters( 'seosight_images_only', false ) ) {
		$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
	}
	$user = $media_array[0]['user']['full_name'];
	$link = $media_array[0]['user']['username'];
	
	?>
	<div class="w-instagramm__wrap instagram-size-<?php echo esc_attr( $size ) ?>' w-instagramm--<?php echo esc_attr( $columns ); ?>-col <?php echo esc_attr( $wrap_class ); ?>">
		<?php
		foreach ( $media_array as $item ) {
			echo '<div class="w-instagramm__a">
			<a class="overlay-thumbnail" href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $target ) . '">
			<img src="' . esc_url( $item[ $size ] ) . '"  alt="' . esc_attr( $item['description'] ) . '" title="' . esc_attr( $item['description'] ) . '" />
			</a></div>';
		}
		?>
	</div>
	<?php
}
