<?php
/** @var array $atts */
$title = $subtitle = $class = $align = $type = $tag = $title_link = $post_title = $el_class = $link_title = $link_target = $title_delim = $inline_link = $link_html = '';

global $allowedposttags;

extract( $atts );

if ( empty( $type ) ) {
	$type = 'h1';
}

$wrap_class   = apply_filters( 'kc-el-class', $atts );
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-heading';

if ( 'yes' !== $inline_link ) {
	$wrap_class[] = $align;
}

$wrap_class[] = $class;

if ( 'yes' == $inline_link ) {
	$wrap_class[] = 'with-read-more';
	if ( ! empty( $title_link ) ) {
		$link_arr = explode( "|", $title_link );

		if ( ! empty( $link_arr[0] ) ) {
			$link_url = $link_arr[0];
		}

		$link_title = ! empty( $link_arr[1] ) ? $link_arr[1] : esc_html__( 'Read more', 'seosight' );

		$link_target = ! empty( $link_arr[2] ) ? $link_arr[2] : '_self';
	}
	if ( ! empty( $link_url ) ) {
		$link_html = '<a href="' . esc_url( $link_url ) . '" class="read-more" title="' . esc_attr( $link_title ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ) . '<i class="seoicon-right-arrow"></i></a>';
	}
}
if ( $post_title == 'yes' ) {
	$text_title = get_the_title();
	if ( ! empty( $text_title ) ) {
		$title = esc_attr( $text_title );
	}
}
$el_class .= ' heading-title';
?>

<header class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
    <div class="title-text-wrap"><<?php echo esc_attr( $type ) ?> class="<?php echo esc_attr( $el_class ); ?>">
		<?php echo esc_html( $title ); ?></<?php echo esc_attr( $type ) ?>>
	<?php seosight_render( $link_html ); ?>
    </div>
	<?php if ( 'yes' == $title_delim ) { ?>
        <div class="heading-decoration"><span class="first"></span><span class="second"></span></div>
	<?php }
	if ( ! empty( $subtitle ) ) { ?>
        <div class="h5 heading-text"><?php echo html_entity_decode( wp_kses( $subtitle, $allowedposttags ) ); ?></div>
	<?php } ?>
</header>