<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var $number
 * @var $username
 * @var $columns
 * @var $media_array
 * @var $target
 * @var $space
 */


$wrap_class = ( ! empty( $space ) ) ? 'w-instagramm-padding' : '';
$container_id = uniqid( 'flickr' );
?>

<div class="w-instagramm">
	<div id="<?php echo esc_attr( $container_id ); ?>" class="gallery w-instagramm__wrap w-instagramm--<?php echo esc_attr( $columns ); ?>-col <?php echo esc_attr( $wrap_class ); ?>"></div>
</div>
<?php ob_start(); ?>
	jQuery(document).ready(function() {
		jQuery('#<?php echo esc_attr( $container_id );?>').jflickrfeed({
			limit: <?php echo esc_attr( $number ); ?>,
			qstrings: {
				id: '<?php echo esc_attr( $username ); ?>'
			},
			itemTemplate: '<div class="w-instagramm__a">'+
			'<a class="overlay-thumbnail"  target="<?php echo esc_attr( $target );?>" rel="prettyPhoto[flikr_gal]" href="{{image_b}}" title="{{title}}">' +
			'<img src="{{image_q}}" alt="{{title}}" />' +
			'<img src="{{image_q}}" alt="{{title}}" />' +
			'</a></div>'
		});
	});
<?php $js_content = ob_get_clean();
echo fw_html_tag( 'script', array( 'type' => 'text/javascript' ), $js_content );
