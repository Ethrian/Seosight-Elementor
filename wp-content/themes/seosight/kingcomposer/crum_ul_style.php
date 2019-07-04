<?php
$desc = $custom_class = $list_icon = $icon = '';

$wrap_class	= apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'list';

if ( 'seoicon-check' == $list_icon || 'seoicon-right-arrow' == $list_icon ) {
    $wrap_class[] = 'list--secondary';
    $icon = $list_icon;
} else {
    $wrap_class[] = 'list--primary';
}

if ( !empty( $custom_class ) )
    $wrap_class[] = $custom_class;
?>

<div class="<?php echo esc_attr( implode( " ", $wrap_class) ); ?>" data-icon="<?php echo esc_attr( $icon ) ?>">
    <?php echo do_shortcode($desc); ?>
</div>
