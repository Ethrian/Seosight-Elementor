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

		 

		$this->end_controls_section();
	}
}