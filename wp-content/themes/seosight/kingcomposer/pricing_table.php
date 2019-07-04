<?php
/*
 * Pricing Table wrapper template
 */
$layout       = $columns = $wrap_class = '';
$column_class = array();
extract( $atts );

$wrap_class   = apply_filters( 'kc-el-class', $atts );
$wrap_class[] = 'pricing-tables-wrap';

preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );
$column_class[] = 'col-xs-12 no-padding';
if (3 == $columns || 6 == $columns){
    $column_class[] = 'col-sm-4';
    $column_class[] = 'col-md-4';
} else {
    $column_class[] = 'col-sm-6';
    $column_class[] = 'col-md-6';
}

$column_class[] = 'col-lg-' . intval( 12 / $columns );
$i = 1;
$all = 0;
if ( isset( $matches[0] )){
    $all = count($matches[0]);
}

?>
<div class="<?php echo implode( ' ', $wrap_class ) ?>">
    <?php if ( $all > 0 ) {
        foreach ( $matches[0] as $single_shortcode ) {
            echo '<div class="' . implode( ' ', $column_class ) . '">';
            echo do_shortcode( $single_shortcode );
	        if ( $i < $all ) {
                echo '<img src="'.get_template_directory_uri().'/img/pricing-dots.png" class="dots" alt="dots">';
            }
            echo '</div>';
            $i++;
        }
    } ?>
</div>