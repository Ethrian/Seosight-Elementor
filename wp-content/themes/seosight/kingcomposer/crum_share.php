<?php
/** @var array $atts */
$output = $class = $custom_class = '';
$icons = array();

extract( $atts );

$css_class   = apply_filters( 'kc-el-class', $atts );
$css_class[] = 'kc-multi-icons-wrapper';

if ( ! empty( $custom_class ) ) {
	$css_class[] = $custom_class;
}


?>
<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
	<?php
	foreach ( $icons as $item ):
		$icon_att = $link_att = array();
		$service = $item->service;
		$color = isset( $item->color ) ? $item->color : '';
		$bg_color = isset( $item->bg_color ) ? $item->bg_color : '';

		$link_att[] = 'data-url="' . esc_attr( get_the_permalink() ) . '"';
		$link_att[] = 'data-title="' . esc_attr( esc_attr( get_the_title() ) ) . '"';
		$link_att[] = 'class="sharer  ' . $service . '"';
		$link_att[] = 'data-sharer="' . ( $service === 'google-plus' ? 'googleplus' : $service ) . '"';

		if ( ! empty( $bg_color ) ) {
			$link_att[] = 'style="background-color:' . $bg_color . ';"';
		}

		if ( ! empty( $color ) ) {
			$icon_att[] = 'style="color:' . $color . ';"';
		}

		?>
		<button <?php echo implode( ' ', $link_att ); ?>>
			<i class="fa fa-<?php echo esc_attr( $service ); ?>" <?php echo implode( ' ', $icon_att ); ?> ></i>
		</button>

		<?php
	endforeach;
	?>
</div>
