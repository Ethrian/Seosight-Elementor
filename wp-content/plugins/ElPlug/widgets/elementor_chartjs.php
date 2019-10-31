<?php

class Elementor_chartjs extends \Elementor\Widget_Base {


	public function get_name() {
		return 'chartjs';
	}


	public function get_title() {
		return esc_html__( 'JS chart', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-pie-chart';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {
	
		$this->start_controls_section(
			'chartJS',
			[
				'label'		=> esc_html__("JS chart", 'seosight'),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		
		$this->add_control(
			'chart_type', 
			[
				'label'		=> esc_html__("Choose chart style", "seosight"),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'options'	=>
					[
						'doughnut'  => 'doughnut chart',
						'pie'       => 'pie chart',
						'polarArea' => 'polar area chart ',
						'line'      => 'line chart',
						'bar'       => 'bar chart'
					],
				'default'	=> 'pie'
			]
		);

		$this->add_control(
			'hide_labels',
			[
				'label'			=> esc_html__('Hide labels?', 'seosight'),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'description'	=> esc_html__('Hide chart legend labels'),
				'return_value'	=> true
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label',
			[
				'label'			=> esc_html__('Label', 'seosight'),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__('Enter text used as title of the bar', 'seosight')
			]
		);

		$repeater->add_control(
			'value',
			[
				'label'			=> esc_html__('Value', 'seosight'),
				'type'			=> \Elementor\Controls_Manager::SLIDER,
				'description'	=> esc_html__('Enter targeted value', 'seosight'),
				'size_units'    => ['%'],
				'range'         =>
					[
						'%'        =>
							[
								'min'       => 0,
								'max'       => 100,
								'step'      => 1
							]
					],
				'default'       =>
					[
						'unit'      => '%',
						'size'      => 40
					]
			]
		);

		$repeater->add_control(
		    "color_picker",
                [
                    'label'     => esc_html__('Color', 'seosight'),
                    'type'      => \Elementor\Controls_Manager::COLOR,
					'scheme' =>
						[
							'type' => \Elementor\Scheme_Color::get_type(),
							'value' => \Elementor\Scheme_Color::COLOR_1,
						],
                ]
        );

		$this->add_control(
			'options',
			[
				'label'			=> esc_html__('Repeater list', 'seosight'),
				'type'			=> \Elementor\Controls_Manager::REPEATER,
				'fields'		=> $repeater->get_controls()
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Title typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .info-box-title',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$_id = '';
		$js_data = '';
		$chart_type = '';
		$_class = '';
		$css = '';
		$wrap_class = '';
		$value_color_style ='';
		$hide_labels = '';
		$el_classes = 'crumina-module chart-js chart-js-run';

		wp_enqueue_script( 'chart-js' );

		$settings = $this->get_settings_for_display();

		extract($settings);

		$random_id = 'js_chart_module_' . $_id;

		fw_print($settings);

		if ( function_exists( 'fw_get_db_customizer_option' ) ) {
			$progress_bar_color_default = fw_get_db_customizer_option( 'primary_color', '#4cc2c0' );
		}

		if ( ! isset( $progress_bar_color_default ) || empty( $progress_bar_color_default ) ) {
			$progress_bar_color_default = '#4cc2c0';
		}

		$js_data_number = $js_data_label = $js_data_color = array();
		$options = $settings['options'];
		$element_attributes[] = 'id="wrap_' . esc_attr( $random_id ) . '"';
		$element_attributes[] = 'data-id="' . esc_attr( $random_id ) . '"';
		$element_attributes[] = 'data-type="'.esc_attr($chart_type).'"';
		$element_attributes[] = 'class="' . esc_attr( $el_classes ) . '"'; ?>

		<div <?php echo implode( ' ', $element_attributes ) ?>>
			<canvas id="<?php echo esc_attr( $random_id ) ?>" width="1000" height="1000"></canvas>
			<?php if ( isset( $options ) ) { ?>
				<div class="points">
					<?php foreach ( $options as $option ) {
						$prob_style = '';
						$value      = ! empty( $option->value ) ? $option->value : 50;
						$label      = ! empty( $option->label ) ? $option->label : 'Label default';
						$prob_color = ! empty( $option->prob_color ) ? $option->prob_color : '';

						$js_data_number[] = esc_attr( intval( $value ) );
						$js_data_label[]  = '"' . esc_attr( $label ) . '"';
						$js_data_color[]  = '"' . esc_attr( $prob_color ) . '"';

						if ( 'yes' !== $hide_labels){
							if ( $prob_color != '' ) {
								$prob_style .= 'background-color: ' . $prob_color . ';';
							}
							$prob_track_attributes = array();
							$prob_attributes       = array();

							//Progress bars attributes
							$prob_css_classes = array(
								'point-sircle',
								'bg-primary-color',
							);

							$prob_css_class    = implode( ' ', $prob_css_classes );
							$prob_attributes[] = 'class="' . esc_attr( trim( $prob_css_class ) ) . '"';
							$prob_attributes[] = 'style="' . esc_attr( $prob_style ) . '"';
							?>
							<div class="points-item">
								<div class="points-item-count">
									<span <?php echo implode( ' ', $prob_attributes ); ?>></span><?php echo esc_html( $value ) ?>
									<span class="c-gray"> - <?php echo esc_html( $label ); ?></span>
								</div>
							</div>
						<?php }
					} ?>
				</div>
				<div class='chart-data' data-borderColor='<?php echo esc_attr($progress_bar_color_default) ?>' data-labels='[<?php echo implode( ',', $js_data_label ) ?>]'
			 		data-numbers='[<?php echo implode( ',', $js_data_number)  ?>]'
			 		data-colors='[<?php echo implode( ',', $js_data_color)  ?>]'></div>
			<?php } ?>
		</div>
		<?php
	}

	protected function  _content_template() {
		?>

        <#
        var data = settings;

        var output = '';
        var atts = ( data.atts !== undefined ) ? data.atts : {},
        chart_type = '',
        _id = '',
        hide_labels = '';
        var options = [],
        js_data_number = [],
        js_data_label = [],
        js_data_color = [];

        var element_attributes = [];
        var wrapper_class = 'crumina-module chart-js';

        if (atts['chart_type'] !== '')
        chart_type = atts['chart_type']

        if (atts['_id'] !== '')
        random_id = 'js_chart_module_' + atts['_id']

        if (atts['hide_labels'] !== '')
        hide_labels = atts['hide_labels']

        try{
        var options = JSON.parse( atts['options'] );
        } catch(ex){
        var options = atts['options'];
        }
        #>

        <div class="{{wrapper_class}}" data-id="{{random_id}}" data-type="{{chart_type}}">
            <canvas id="{{random_id}}" width="1000" height="1000"></canvas>
            <div class="points">
                <# if( options !== null ){
                for( var n in options ){
                var value = ( options[n]['value'] !== undefined && options[n]['value'] !== '' ) ? options[n]['value'] : 50,
                label = ( options[n]['label'] !== undefined && options[n]['label'] !== '' ) ? options[n]['label'] : 'Label default',
                prob_color = ( options[n]['prob_color'] !== undefined && options[n]['prob_color'] !== '' ) ? options[n]['prob_color'] : '',
                prob_style = '',
                value_color_style = '';

                if( prob_color != '') {
                prob_style += 'background-color: '+prob_color+';';
                }

                js_data_number.push( '"' + value + '"' );
                js_data_label.push( '"' + label + '"' );
                js_data_color.push( '"' + prob_color + '"' );

                prob_attributes = [];

                //Progress bars track attributes
                prob_css_classes = ['point-sircle','bg-primary-color'];

                var prob_css_class = prob_css_classes.join(' ');
                prob_attributes.push( 'class="'+prob_css_class+'"' );
                prob_attributes.push( 'style="'+prob_style+'"' );

                if( hide_labels != 'yes' ){
                #>
                <div class="points-item">
                    <div class="points-item-count">
                        <span {{{prob_attributes.join(' ')}}} ></span>{{value}}
                        <span class="c-gray"> - {{label}}</span>
                    </div>
                </div>
                <# } } }#>
            </div>
            <div class="chart-data" data-labels='[{{js_data_label.join(',')}}]'
            data-numbers='[{{js_data_number.join(',')}}]'
            data-colors='[{{js_data_color.join(',')}}]'></div>
        </div>
        <# callback = function( wrp, $){
        var el_id = wrp.data('id');
        var dataholder = wrp.find('.chart-data');
        var ctx = document.getElementById(el_id);
        var myChart = new Chart(ctx, {
        type: wrp.data('type'),
        data: {
        labels: dataholder.data('labels'),
        datasets: [{ data: dataholder.data('numbers'), backgroundColor: dataholder.data('colors') }]
        },
        options: { legend: {display: false } },
        animation: { animateScale: false }
        });
        } #>

        <?php
	}
}