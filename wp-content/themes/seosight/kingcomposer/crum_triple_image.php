<?php
global $allowedposttags;
$output = $wrap_class = $left_image = $image = $right_image = '';

extract( $atts );

$el_class   = apply_filters( 'kc-el-class', $atts );
$el_class[] = 'crumina-module';
$el_class[] = 'triple-images';


$el_class[] = $wrap_class;

?>

<div class="<?php echo esc_attr( implode( ' ', $el_class ) ) ?>">
    <div class="triple-images-thumb">
		<?php if ( ! empty( $image ) ) {
			echo wp_get_attachment_image( $image, array( '740', '580' ), '', array( "class" => "shadow-image" ) );
		} ?>
    </div>


	<?php if ( ! empty( $left_image ) ) {
		echo wp_get_attachment_image( $left_image, array( '670', '400' ), '', array( "class" => "first" ) );
	}
	if ( ! empty( $right_image ) ) {
		echo wp_get_attachment_image( $right_image, array( '670', '400' ), '', array( "class" => "last" ) );
	} ?>
</div>