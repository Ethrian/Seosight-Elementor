<?php
$desc = $custom_class = $style = '';

$wrap_class	= apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'first-letter--' .$style ;

if ( !empty( $custom_class ) )
	$wrap_class[] = $custom_class;

$check = trim(strip_tags($desc));

if( !empty( $check ) ){
	$ch = mb_substr($check, 0,1);
	$pos = strpos($desc, $ch);
	$str_re = '<span class="dropcaps-text">' . $ch .'</span>';
	$desc = substr_replace($desc, $str_re, $pos, $pos+1);
} else {
    $desc = esc_html__('Dropcap: Text not found', 'seosight');
}



?>
<div class="<?php echo esc_attr( implode( " ", $wrap_class) ); ?>">
	<?php echo do_shortcode($desc); ?>
</div>
