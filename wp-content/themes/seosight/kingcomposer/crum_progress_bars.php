<?php

$output = $_class = $css = $wrap_class = $value_color_style = '';

extract( $atts );

$progress_bar_color_default = '#999999';

$element_attributes = array();

$el_class     = $wrap_class;
$wrap_class   = apply_filters( 'kc-el-class', $atts );
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'skills';
$wrap_class[] = 'js-run-skills-item';
$options      = $atts['options'];

?>
<div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">

    <div class="<?php echo esc_attr( $el_class ) ?>">
		<?php if ( isset( $options ) ) {
			foreach ( $options as $option ) {
				$prob_style = '';
				$value      = ! empty( $option->value ) ? $option->value : 50;
				$label      = ! empty( $option->label ) ? $option->label : 'Label default';

				$prob_color = ! empty( $option->prob_color ) ? $option->prob_color : '';

				if ( $prob_color != '' ) {
					$prob_style = 'background-color: ' . $prob_color . ';';
					$prob_style .= 'border-color: ' . $prob_color . ';';
				}

				$prob_style .= 'width: ' . $value . '%';

				$value_color_style = '';
				if ( ! empty( $option->value_color ) ) {
					$value_color_style = ' color: ' . esc_attr( $option->value_color ) . '"';
				}

				$prob_track_attributes = array();
				$prob_attributes       = array();

				//Progress bars attributes
				$prob_css_classes = array(
					'skills-item-meter-active',
					'bg-primary-color border-primary-color',
					'skills-animate',
				);

				$prob_css_class    = implode( ' ', $prob_css_classes );
				$prob_attributes[] = 'class="' . esc_attr( trim( $prob_css_class ) ) . '"';
				$prob_attributes[] = 'style="' . esc_attr( $prob_style ) . '"';
				?>
                <div class="skills-item">
                    <div class="skills-item-info">
                        <span class="skills-item-title"><?php echo esc_html( $label ); ?></span>
                        <span class="skills-item-count">
					<span class="count-animate" data-speed="1000" data-refresh-interval="50"
                          data-to="<?php echo esc_attr( $value ) ?>"
                          data-from="0"><?php echo esc_html( $value ) ?></span><span
                                    class="units" <?php seosight_render($value_color_style); ?>>%</span></span>
                    </div>
                    <div class="skills-item-meter">
                        <span <?php echo implode( ' ', $prob_attributes ) ?>></span>
                    </div>
                </div>
			<?php }
		} ?>
    </div>
</div>