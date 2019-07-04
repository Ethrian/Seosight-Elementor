<?php

$output      = $title = $icon = $wrap_class = $link = $use_link = '';
$has_link    = false;
extract( $atts );

$css_class 		= apply_filters( 'kc-el-class', $atts );
$css_class[] = 'crumina-module';
$css_class[] 	= 'crum-icon-module';

if ( ! empty( $wrap_class ) ) {
	$css_class[] = $wrap_class;
}

if( empty( $icon ) )
	$icon = 'et-layers';

$class_icon = array( $icon );

if( $use_link == 'yes') {
	
	$link     = ( '||' === $link ) ? '' : $link;
	$link     = kc_parse_link( $link );
	$link_att = array();
	
	if ( strlen( $link['url'] ) > 0 ) {
		$has_link = true;
		$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
		
		$link_att[] = 'href="' . esc_attr( $link['url'] ) . '"';
		$link_att[] = 'target="' . esc_attr( $a_target ) . '"';
		$link_att[] = 'title="' . esc_attr( $link['title'] ) . '"';
	}
}
?>
<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
	<?php if( $has_link ) :?>
	<a <?php echo implode(' ', $link_att); ?>>
	<?php endif;?>
        <span class="icon"><i class="<?php echo esc_attr( implode( " ", $class_icon ) ) ?>"></i></span>
        <?php if ( ! empty( $title ) ) {
            echo '<span class="h4 module-title">' . esc_html( $title ) . '</span>';
        } ?>
	<?php if( $has_link ) :?>
	</a>
	<?php endif;?>
</div>
