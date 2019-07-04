<?php
/**
 * accordion shortcode
 **/
/** @var array $atts */

$css = $title = $id = $open_all = '';
extract( $atts );

$output = '';

$parent_id = uniqid( 'accordion' );

$css_classes   = apply_filters( 'kc-el-class', $atts );
$css_classes[] = 'crumina-module crumina-accordion';

if ( isset( $class ) ) {
    array_push( $css_classes, $class );
}

$element_attributes = array( 'accordion-group' );

if ( $open_all == 'yes' ) {
    $element_attributes[] = 'panel-group';
}

$css_class = implode( ' ', $css_classes );

?>
<div class="<?php echo esc_attr( trim( $css_class ) ) ?>">
    <ul class="<?php echo implode( ' ', $element_attributes ); ?>" id="<?php echo esc_attr( $parent_id ) ?>">
        <?php $content = str_replace( '[crum_accordion_tab', '[crum_accordion_tab id="' . $parent_id . '"', $content ); ?>
        <?php echo do_shortcode( str_replace( 'crum_accordion#', 'crum_accordion', $content ) ); ?>
    </ul>
</div>
