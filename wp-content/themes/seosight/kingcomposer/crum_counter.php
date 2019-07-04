<?php

$layout = $units = $line_show =$icon_show = $wrap_class = '';
$el_classess = array();
$atts 			= kc_remove_empty_code( $atts );
$wrapper_class = apply_filters( 'kc-el-class', $atts );
$el_classess[] = 'crumina-module';
$el_classess[] = 'crumina-counter-item';

extract( $atts );

$el_classess[] = 'counter-item-'.$layout;
$el_classess[] = $wrap_class;

if ( ! empty( $wrapper_class ) ) {
	$el_classess = array_merge( $el_classess, $wrapper_class );
}
$wrap_class = implode( " ", $el_classess );

$label = ( ! empty( $label ) ) ? '<h5 class="counter-title">' . esc_html( $label ) . '</h5>' : '';
$units = (!empty($units)) ? '<div class="units">'.esc_attr( $units ).'</div>' :  '';
if( $icon_show == 'yes' ) {
	$icon = ! empty( $icon ) ? $icon : 'et-puzzle';
	$icon = ( !empty( $icon ) ) ? '<div class="element-icon"><i class="'. esc_html($icon).'"></i></div>' : '';
} else {
	$icon = '';
} ?>
<div class="<?php echo esc_attr( $wrap_class ) ?>">
    <?php seosight_render( $icon ) ; ?>
    <div class="counter-numbers counter">
        <span data-to="<?php echo esc_attr( $number ); ?>"><?php echo esc_html( $number ); ?></span><?php seosight_render( $units ) ; ?>
    </div>
    <?php seosight_render( $label ) ; ?>
    <?php if ( $line_show ) { ?>
        <div class="counter-line"><span class="first"></span><span class="second"></span></div>
    <?php } ?>
</div>