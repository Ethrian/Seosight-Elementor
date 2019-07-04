<?php
$output             = $wrap_class = $percent = $icon_option = $icon = $startcolor = $endcolor = $title = $description = $link = $title_link = $target = '';
$element_attributes = array();

extract( $atts );

$classes = array( 'crumina-module', 'crumina-pie-chart-item' );
$css_classes  = apply_filters( 'kc-el-class', $atts );

$css_classes = array_merge($css_classes, $classes);

$shortcode_class = implode( ' ', $css_classes );

$percent = str_replace( '%', '', $percent );

$element_attributes[] = 'data-value="' . esc_attr( $percent / 100 ) . '"';
$element_attributes[] = 'data-startcolor="' . esc_attr( $startcolor ) . '"';
$element_attributes[] = 'data-endcolor="' . esc_attr( $endcolor ) . '"';

$custom_link = kc_parse_link( $link );
if ( strlen( $custom_link['url'] ) > 0 ) {
	$block_link = $custom_link['url'];
	$title_link = $custom_link['title'];
	$target     = strlen( $custom_link['target'] ) > 0 ? $custom_link['target'] : '_self';
}
?>
<div class="<?php echo esc_attr( $shortcode_class ); ?>">
    <div class="pie-chart js-run-pie-chart" <?php echo implode( ' ', $element_attributes ); ?> >
		<?php if ( $icon_option == 'yes' ) { ?>
			<div class="icon"><i class="<?php seosight_render($icon); ?> pie_chart_icon"></i></div>
		<?php } else { ?>
			<div class="content"><?php echo esc_html( $percent ) ?><span>%</span></div>
		<?php } ?>
	</div>
	<div class="pie-chart-content">
		<?php if ( ! empty ( $title ) ) {
			echo '<h4 class="pie-chart-content-title">' . esc_html( $title ) . '</h4>';
		}
		if ( ! empty ( $description ) ) {
			echo '<div class="pie-chart-content-text">' . wpautop( $description ) . '</div>';
		}
		if ( ! empty ( $block_link ) ) {
			echo '<a href="' . esc_attr( $block_link ) . '" class="more" target="' . esc_attr( $target ) . '" title="' . strip_tags( $title_link ) . '">' . esc_html( $title_link ) . '<i class="seoicon-right-arrow"></i></a>';
		}
		?>
	</div>
</div>
