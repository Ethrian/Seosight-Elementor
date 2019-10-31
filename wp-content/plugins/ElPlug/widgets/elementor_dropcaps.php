<?php

class Elementor_dropcaps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Dropcaps';
	}

	public function get_title() {
		return __( 'dropcaps', 'seosight' );
	}

	public function get_icon() {
		return 'fa fa-adn';
	}

	public function get_categories() {
		return [ 'theme-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'Dropcaps',
			[
				'label'         => __( 'Dropcaps', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'dropcaps_desc',
			[
                'label'         => esc_html__( 'Text Paragraph', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'rows'          => 7,
                'placeholder'   => esc_html__( 'Bla-bla-bla...', 'seosight' ),
                'default'       => 'S'
			]
        );
        
        $this->add_control(
            'dropcaps_style',
            [
                'label'         => esc_html__( 'Base dropcap style', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => 
                [
                    'squared'       => esc_html__( 'Square', 'seosight' ),
                    'dark-round'    => esc_html__( 'Rounded', 'seosight' ),
                    'primary'       => esc_html__( 'Simple', 'seosight' ),
                ],
                'default'       => 'dark-round',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'css',
			[
				'label'         => esc_html__( 'Dropcaps', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

		$this->add_control(
		        'color',
                [
                    'label' => esc_html__('Character color', 'seosight'),
                    'type'  => \Elementor\Controls_Manager::COLOR,
                    'scheme' =>
                        [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                    'selectors' =>
                        [
							'{{WRAPPER}} .dropcaps-text' => 'color: {{SCHEME}};'
                        ],
                    'default'   => '#5b5b5b'
                ]
        );

		$this->add_control(
		        'background-color',
                [
                    'label' => esc_html__('Background color', 'seosight'),
                    'type'  => \Elementor\Controls_Manager::COLOR,
					'scheme' =>
						[
							'type' => \Elementor\Scheme_Color::get_type(),
							'value' => \Elementor\Scheme_Color::COLOR_1,
						],
					'selectors' =>
						[
							'{{WRAPPER}} .dropcaps-text' => 'background-color: {{SCHEME}};'
						],
                    'default'   => '#96bc00'
                ]
        );

		$this->add_group_control(
			'typography',
			[
				'name'      => 'content_typography',
				'label'     => esc_html__( 'Character typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .dropcaps-text',
			]
		);

		$this->add_group_control(
			'border',
			[
				'label'     => esc_html__( 'Character border', 'seosight' ),
				'selector'  => '{{WRAPPER}} .dropcaps-text',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        // $desc = $settings['dropcaps_desc'];
        // $style = $settings['dropcaps_style'];

        extract( $settings );
        
        $wrap_class[] = 'first-letter--' .$dropcaps_style ;
        
        $check = trim(strip_tags($dropcaps_desc));
        
        if( !empty( $check ) ){
            $ch = mb_substr($check, 0,1);
//            $pos = strpos($dropcaps_desc, $ch);
            $str_re = '<span class="dropcaps-text">' . $ch .'</span>';
            $dropcaps_desc = substr_replace($dropcaps_desc, $str_re, 0, 1);
        } else {
            $dropcaps_desc = esc_html__('Dropcap: Text not found', 'seosight');
        }
        
        ?>
        <div class="<?php echo esc_attr( implode( " ", $wrap_class) ); ?>">
            <?php echo do_shortcode($dropcaps_desc); ?>
        </div>
        <?php
	}   

}
