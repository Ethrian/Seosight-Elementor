<?php

class Elementor_counter extends \Elementor\Widget_Base {


	public function get_name() {
		return 'counter';
	}


	public function get_title() {
		return esc_html__( 'Counter box', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-pie-chart';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}



	protected function _register_controls() {

		$this->start_controls_section(
			'Counter box',
			[
				'label'		=> esc_html__("Counter", 'seosight'),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'layout',
				[
					'label'		=> esc_html__('Select layout', 'seosight'),
					'description' => esc_html__( 'Select format of module', 'seosight' ),
					'type'		=> \Elementor\Controls_Manager::SELECT,
						'options'	=>
						[
							'default' => 'counter on',
							'modern'  => 'counter top'
						],
					'default'	=> 'modern'
				]
		);

		$this->add_control(
			'show_icon',
			[
				'label'       	=> esc_html__( 'Display Icon?', 'seosight' ),
				'description' 	=> esc_html__( 'Display icon in box counter?', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
                'default'       => 'yes'
			]
		);

		$this->add_control(
				'icon',
			[
				'label'         => esc_html__( 'Select Icon', 'seosight' ),
				'description'   => esc_html__( 'Choose an icon to display', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::ICONS,
				'condition'     => [
					'show_icon' => 'yes'
				],
                'default'       => [
					'value' => 'seosight-bar-stats',
					'library' => 'seosight',
                ]
			]
		);

		$this->add_control(
			'number',
			[
				'label'       	=> esc_html__( 'Targeted number', 'seosight' ),
				'description' 	=> esc_html__( 'The targeted number to count up to (From zero).', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
			    'default'       => 42
            ]
		);

		$this->add_control(
			'units',
			[
				'label'       	=> esc_html__( 'Units', 'seosight' ),
				'description' 	=> esc_html__( 'Type unit near counter numbers ( % , + , etc. )', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
                'default'       => '%'
			]
		);

		$this->add_control(
			'label',
			[
				'label'         => esc_html__( 'Label', 'seosight' ),
				'description'   => esc_html__( 'The text description of the counter.', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
                'default'       => 'Counter'
			]
		);

		$this->add_control(
			'show_line',
			[
				'label'         => esc_html__( 'Title underline', 'seosight' ),
				'description'   => esc_html__( 'Underline Title Text', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'css',
			[
				'label'         => esc_html__( 'Counter', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'		=> esc_html__('Text color', 'seosoght'),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'selectors'	=>
					[
						'{{WRAPPER}} .counter-title' => 'color: {{SCHEME}}'
					],
                'default'   => '#bfbfbf'
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Text typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .counter-title'
			]
		);

		$this->add_control(
			'number_color',
			[
				'label'		=> esc_html__('Counter color', 'seosoght'),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'selectors'	=>
					[
						'{{WRAPPER}} .counter-numbers' => 'color: {{SCHEME}}'
					],
				'default'   => '#707070'
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'number_typography',
				'label'     => esc_html__( 'Number typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .counter-numbers'
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'		=> esc_html__('Icon color', 'seosoght'),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'selectors'	=>
					[
						'{{WRAPPER}} .element-icon' => 'color: {{SCHEME}}'
					],
				'default'   => '#179b38'
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'icon border',
				'label'     => esc_html__( 'Icon border', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .element-icon i'
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'		=> esc_html__('Icon background', 'seosoght'),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'selectors'	=>
					[
						'{{WRAPPER}} .element-icon i' => 'color: {{SCHEME}}'
					]
			]
		);

		$this->add_control(
			'delimiter',
			[
				'label'		=> esc_html__('Delimiter color', 'seosoght'),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'selectors'	=>
					[
						'{{WRAPPER}} .counter-line *' => 'background-color: {{SCHEME}}'
					],
				'default'   => '#179b38'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$layout = $number = $units = $show_line =$show_icon = $wrap_class = '';
		$el_classess = array();
		$el_classess[] = 'crumina-module';
		$el_classess[] = 'crumina-counter-item';

		extract( $settings );

		$el_classess[] = 'counter-item-'.$layout;
		$el_classess[] = $wrap_class;


		$wrap_class = implode( " ", $el_classess );

		$label = ( ! empty( $label ) ) ? '<h5 class="counter-title">' . esc_html( $label ) . '</h5>' : '';
		$units = (!empty($units)) ? '<div class="units">'.esc_attr( $units ).'</div>' :  '';
		if( $show_icon == 'yes' ) {
			$icon = ! empty( $icon ) ? $icon : '';
		}
		?>
		<div class="<?php echo esc_attr( $wrap_class ) ?>">
            <div class="element-icon">
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>
			<div class="counter-numbers counter crumina-module">
				<span data-to="<?php echo esc_attr( $number ); ?>"><?php echo esc_html( $number ); ?></span><?php seosight_render( ' '. $units ) ; ?>
			</div>
			<?php seosight_render( $label ) ; ?>
			<?php if ( $show_line ) { ?>
				<div class="counter-line"><span class="first"></span><span class="second"></span></div>
			<?php } ?>
		</div>
		<?php
	}
}
