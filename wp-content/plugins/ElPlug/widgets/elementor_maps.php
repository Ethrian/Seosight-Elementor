<?php

class Elementor_maps extends \Elementor\Widget_Base {


	public function get_name() {
		return 'maps';
	}


	public function get_title() {
		return esc_html__( 'Google maps', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-map';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'maps',
			[
				'label'         => esc_html__( 'Maps', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'google_js',
			[
				'label'         => esc_html__( 'Show JS Google map?', 'seosight' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
                'descrption'    => esc_html__( 'Extened options section for show javascript Google map', 'seosight' ),
			]
        );
        
        $this->add_control(
            'map_location',
            [
                'label'         => esc_html__('Map Embed code', 'seosight'),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'description'   => sprintf( wp_kses( __( 'Go to <a href="%s" target=_blank>Google Maps</a> and search your Location. Click on menu near search text => Share or embed map => Embed map. Next copy iframe to this field', 'seosight' ), ['a' => [ 'href' => array() ] ] ), 'https://www.google.com/maps/' ),
            ]
        );

		$this->add_control(
			'api_key',
			[
				'label'			=> esc_html__( 'API KEY for google maps service', 'seosight'),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'description' 	=> sprintf( wp_kses( __( 'Go to <a href="%s">Instruction to create API key</a>', 'seosight' ), array( 'a' => array( 'href' => array() ) ) ), 'https://developers.google.com/maps/documentation/javascript/get-api-key' )
			]
		);

		$this->add_control(
			'address',
			[
				'label'			=> esc_html__( 'Type address', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'map_zoom',
			[
				'label'			=> esc_html__( 'Map zoom', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SLIDER,
				'size_units'	=> ['em'],
				'range'			=>
				[
					'em'			=>
					[
							'min'		=> 1,
							'max'		=> 21,
							'step'		=> 1
					]
				],

			]
		);

		$this->add_control(
			'map_type',
			[
				'label'			=> esc_html__( 'Map type', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> 
				[
					'roadmap'		=> esc_html__( 'Roadmap', 'seosight' ),
					'terrain'		=> esc_html__( 'Terrain', 'seosight' ),
					'satellite'		=> esc_html__( 'Sattelite', 'seosight' ),
					'hubrid'		=> esc_html__( 'Hubrid', 'seosight' ),
				]
			]
		);

		$this->add_control(
			'disable_scrolling',
			[
				'label'			=> esc_html__( 'Disable zoom on scroll', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'description'	=> esc_html__( 'Prevent the map from zooming when scrolling until clicking on the map', 'seosight' ),
			]
		);

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();

	}

}
