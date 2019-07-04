<?php
/*----------------------------------
 * Single image shortcode
 *--------------------------------*/

$output     = $title_link  = $alt = $image = $target = $align = $overlay = $image_title = $image_source = $image_external_link = $image_size = $image_size_el = $caption = $on_click_action =
$custom_link = $class = $ieclass = $image_full = $html = $css = $caption_html = '';
$size_array = array('full', 'medium', 'large', 'thumbnail');
$image_wrap = 'yes';

extract( $atts );

$css_classes        = apply_filters( 'kc-el-class', $atts );
$default_src        = kc_asset_url('images/get_start.jpg');
$image_source       = $atts['image_source'];
$image_url          = '';
$image_id           = $atts['image'];
$image_size         = $atts['image_size'];
$on_click_action    = $atts['on_click_action'];
$data_lightbox      = '';

$element_attributes = array();
$image_attributes   = array();
$image_classes      = array();

$css_classes = array_merge( $css_classes, array(
	'crumina-module',
	'single-image'
));

if ( !empty( $class ) )
	$css_classes[] = $class;

if ( !empty( $css ) )
	$css_classes[] = $css;

if( !empty( $ieclass ) )
	$image_classes[] = $ieclass;

if( $image_source == 'external_link' ) {

	$image_full = $atts['image_external_link'];
	$image_url  = $image_full;
	$size       = $atts['image_size_el'];

	if( !empty( $image_url ) )
		$image_attributes[] = 'src="'.$image_url.'"';
	else
		$image_attributes[] = 'src="'.$default_src.'"';

	if( empty( $image_full ) )
		$image_full = $default_src;

	if ( preg_match( '/(\d+)x(\d+)/', $size, $matches ) ) {
		$width              = $matches[1];
		$height             = $matches[2];
		$image_attributes[] = 'width="'. $width .'"';
		$image_attributes[] = 'height="'. $height .'"';
	}
} else {

	if( $image_source == 'media_library' ) {
		$image_id = preg_replace( '/[^\d]/', '', $image_id );
	} else {
		$post_id = get_the_ID();

		if ( $post_id && has_post_thumbnail( $post_id ) ) {
			$image_id = get_post_thumbnail_id( $post_id );
		} else {
			$image_id = 0;
		}
	}

	$image_full_width = wp_get_attachment_image_src( $image_id, 'full' );
	$image_full       = $image_full_width[0];
	
	if( in_array( $image_size, $size_array ) ){
		$image_data       = wp_get_attachment_image_src( $image_id, $image_size );
		$image_url        = $image_data[0];
	}else{
		$image_url 	= kc_tools::createImageSize( $image_full, $image_size );
	}
	

	if( !empty( $image_url ) ) {
		$image_attributes[] = 'src="'.$image_url.'"';
	} else {
		$image_attributes[] = 'src="'.$default_src.'"';
		$image_classes[] = 'kc_image_empty';
	}
    $image_classes[] = $align;

	if( empty( $image_full ) )
		$image_full = $default_src;

}

if ( ! empty( $caption ) ) {
    $css_classes[] = 'wp-caption';
    $caption_html = '<figcaption class="wp-caption-text">' . esc_html( $caption ) . '</figcaption>';
}

$title_link = $alt;
if( $on_click_action == 'lightbox' )
{
	$data_lightbox = 'class="js-zoom-image"';
}
else if( $on_click_action == 'open_custom_link' )
{
    $image_classes[] = 'image-opacity';
    $custom_link	= ( '||' === $custom_link ) ? '' : $custom_link;
    $custom_link	= kc_parse_link($custom_link);
    
    if ( strlen( $custom_link['url'] ) > 0 ) {
        $image_full 	= $custom_link['url'];
        $title_link 	= $custom_link['title'];
        $target 	= strlen( $custom_link['target'] ) > 0 ? $custom_link['target'] : '_self';
    }
}

$css_class            = implode(' ', $css_classes);
$element_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$image_attributes[] = 'class="'.implode( ' ', $image_classes ).'"';
if( !empty( $alt ) ){
    $image_attributes[] = 'alt="'. trim(esc_attr($alt)) .'"';
} else {
    $image_attributes[] = 'alt="img"';
}

?>
<div <?php echo implode( ' ', $element_attributes ) ;?>>
    <?php if( !empty($on_click_action) ) { ?>
    <a <?php seosight_render($data_lightbox) ;?> href="<?php echo esc_attr( $image_full );?>" title="<?php echo strip_tags( $title_link ) ;?>" target="<?php echo esc_attr( $target );?>">
        <img <?php echo implode( ' ', $image_attributes ) ;?> alt="<?php echo esc_attr( $alt );?>" />
    </a>
    <?php } else { ?>
        <img <?php echo implode( ' ', $image_attributes ) ;?> />
    <?php } ?>
    <?php seosight_render( $caption_html ) ?>
</div>
