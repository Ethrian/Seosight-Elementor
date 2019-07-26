<?php

class Elementor_pricing_table extends \Elementor\Widget_Base {


	public function get_name() {
		return 'pricing_table';
	}

	public function get_title() {
		return esc_html__( 'Pricing table', 'seosight' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'theme-elements' ];
	}

	protected function _register_controls() {
 
		$this->start_controls_section(
			'Pricing_box',
			[
				'label'         => esc_html__( 'Content', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'         => esc_html__( 'Select layout', 'seosight' ),
				'type'          => \Elementor\Controls_Manager::SELECT,
				'description'   => esc_html__( 'Select format of module', 'seosight' ),
                'options'       => 
                [
                    'clasic'        => $image_path . 'pricing-1.png',
                    'head'          => $image_path . 'pricing-2.png',
                    'colored'       => $image_path . 'pricing-3.png'
                ],
                'default'       => 'classic'
			]
		);

        $this->add_control(
            'show_icon',
            [
                'label'         => esc_html__( 'Show icon in header', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => 
                [
                    'no'        => esc_html__( 'No icon', 'seosight' ),
                    'image'     => esc_html__( 'Image', 'seosight' ),
                    'icon'      => esc_html__( 'Icon', 'seosight' )
                ],
                'default'       => 'no'
            ]
        );

        $this->add_control(
            'image_header',
            [
                'label'         => esc_html__( 'Image', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
			'icon_header',
			[
				'label'			=> esc_html__( 'Select icon', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::ICON,
				'dscription'	=> esc_html__( 'Choose icon to display', 'seosight' )
			]
		);
		
		$this->add_control(
			'title',
			[
				'label'			=> esc_html__( 'Label', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'desc',
			[
				'label'			=> esc_html__( 'Atributes', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXTAREA,
				'description'	=> wp_kses( __( 'Insert tag &lt;strong&gt; when you want highlight text.<br> Example: &lt;strong&gt;<strong>24/7</strong>&lt;/strong&gt; Support', 'seosight' ), array(
					'br',
					'strong'
				)),
			]
		);

		$this->add_control(
			'price',
			[
				'label'			=> esc_html__( 'Price', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'currency',
			[
				'label'			=> esc_html__( 'Currency', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'show_on_top',
			[
				'label'			=> esc_html__( 'Price format', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'descripton'	=> wp_kses( __( 'Price format default <strong>$99</strong>.<br> When turn on price format <strong>99$</strong>', 'seosight' ), array(
					'br',
					'strong'
				) ),
			]
		);

		$this->add_control(
			'duration',
			[
				'label'			=> esc_html__( 'Per', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'value'			=> '/month'
			]
		);

		$this->add_control(
			'show_button',
			[
				'label'			=> esc_html__( 'Display button', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'			=> esc_html__( 'Button text', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'value'			=> 'Purchase'
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'			=> esc_html__( 'Link', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::URL,
				'placeholder'	=> esc_html__( 'https://your-link.com', 'seosight' )
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label'			=> esc_html__( 'Background color', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'default'		=> '#d9e2e2'
			]
		);

		$this->add_control(
			'highlight',
			[
				'label'			=> esc_html__( 'Always zoomed', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'hover_zoom',
			[
				'label'			=> esc_html__( 'Zoom on hover', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		extract($settings);

		$layout = 'classic';

		
		
	}

}