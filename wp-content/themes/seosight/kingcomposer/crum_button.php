<?php

$text_title    = $label = $link = $show_icon = $icon = $align = $icon_position = $ex_class = $wrap_class = $color = $size = $shadow = $outlined = $element_id = '';
$icon_position = 'right';
$wrapper_class = apply_filters( 'kc-el-class', $atts );
$button_attr   = array();

extract( $atts );

$link = ( '||' === $link ) ? '' : $link;
$link = kc_parse_link( $link );

if ( strlen( $link['url'] ) > 0 ) {
	$a_href   = $link['url'];
	$a_title  = $link['title'];
	$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}

if ( empty( $color ) ) {
	$color = 'primary';
}

$wrapper_class[] = 'crumina-module';
$wrapper_class[] = 'crum-button';
if ( ! isset( $a_href ) ) {
	$a_href = "#";
}

if ( ! empty( $wrap_class ) ) {
	$wrapper_class[] = $wrap_class;
}

if ( $align == 'none' ) {
	$wrapper_class[] = 'inline-block';
} else {
	$wrapper_class[] = $align;
}

$el_class   = array();
$el_class[] = 'btn';
$el_class[] = 'btn-' . $size; // Size class.
$el_class[] = 'btn--' . $color; // Color class.
$el_class[] = 'icon-' . $icon_position; // Icon align.
$el_class[] = 'yes' === $shadow ? 'btn-hover-shadow' : ''; // Shadow class

if ( 'yes' == $outlined ) {
	$el_class[] = 'btn-border';
}

if ( ! empty( $ex_class ) ) {
	$el_class[] = $ex_class;
}

if ( isset( $el_class ) ) {
	$button_attr[] = 'class="' . esc_attr( implode( ' ', $el_class ) ) . '"';
}

if ( isset( $a_href ) ) {
	$button_attr[] = 'href="' . esc_attr( $a_href ) . '"';
}

if ( isset( $a_target ) ) {
	$button_attr[] = 'target="' . esc_attr( $a_target ) . '"';
}

if ( isset( $a_title ) ) {
	$button_attr[] = 'title="' . esc_attr( $a_title ) . '"';
}

if (  ! empty( $onclick ) ) {
	$button_attr[] = 'onclick="' . $onclick . '"';
}
if ( ! empty( $element_id ) ) {
	$button_attr[] = 'id="' . esc_attr( $element_id ) . '"';
}
?>

<div class="<?php echo implode( " ", $wrapper_class ); ?>">
    <a <?php echo implode( ' ', $button_attr ); ?>>
		<?php
		if ( $show_icon == 'yes' ) {
			if ( $icon_position == 'left' ) {
				echo '<i class="' . esc_attr( $icon ) . '"></i><span class="text">' . html_entity_decode( wp_kses( $label, array( 'br' => array() ) ) ) . '</span>';
			} else {
				echo '<span class="text">' . html_entity_decode( wp_kses( $label, array( 'br' => array() ) ) ) . '</span><i class="' . esc_attr( $icon ) . '"></i>';
			}
		} else {
			if ( ! empty( $label ) ) {
				echo '<span class="text">' . html_entity_decode( wp_kses( $label, array( 'br' => array() ) ) ) . '</span>';
			}
		}
		?>
        <span class="semicircle"></span>
    </a>
</div>