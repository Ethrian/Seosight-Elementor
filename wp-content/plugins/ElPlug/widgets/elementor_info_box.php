<?php

class Elementor_info_box extends \Elementor\Widget_Base {


	public function get_name() {
		return 'info-box';
	}


	public function get_title() {
		return esc_html__( 'Info box', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-code';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}
 
	protected function _register_controls() {

		$this->start_controls_section(
			'Info box',
			[
				'label'         => esc_html__( 'Info box', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( // TODO:  BELOW!
			'layout',
			[
				'label'         => esc_html__( 'Displays feature boxes style', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => 
                [
                    'standard-nofloat'      =>  'info-box-1.png',
                    'standard'              =>  'info-box-2.png',
                    'standard-centered'     =>  'info-box-3.png',
                    'standard-bg'           =>  'info-box-4.png',
                    'modern'                =>  'info-box-5.png',
                    'standard-centered-big' =>  'info-box-6.png',
                    'standard-hover'        =>  'info-box-7.png',
                ],
                'default'       => 'standard-nofloat'
			]
        );
        
        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'         => esc_html__( 'Description', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'media',
            [
                'label'         => esc_html__( 'Picture type', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       =>
                [
                    'icon'  => esc_html__( 'Icon', 'seosight' ),
					'image' => esc_html__( 'Image', 'seosight' )
                ],
                'default'       => 'icon'
            ]
        );

        $this->add_control(
            'image',
            [
                'label'         => esc_html__( 'Upload image', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                'condition'     => ['media' => 'image']
            ]

        );

        $this->add_control(
            'icon',
            [
                'label'         => esc_html__('Select icon', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::ICONS,
                'description'   => esc_html__( 'Select icon display in box', 'seosight' ),
                'default'       => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition'     => ['media' => 'icon']
            ]
        );
        
        $this->add_control(
            'link',
            [
                'label'         => esc_html__( 'Button URL', 'seosight'),
                'type'          => \Elementor\Controls_Manager::URL,
                'description'   => esc_html__('Add link to button', 'seosight' ),
                'default'       =>
                [
                    'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false,
                ]
            ]
        );

        $this->add_control(
            'link_title',
            [
                'label'         => esc_html__( 'Link title', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,

            ]
        );

        $this->add_control(
            'is_button',
            [
                'label'         => esc_html__( 'Show button?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'descripton'    => esc_html__( 'Display link as button', 'seosight' ),
                'label_on'		=> esc_html__( 'Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label'         => esc_html__( 'Color', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       =>
                [
                    'btn--dark'          => esc_html__( 'black', 'seosight' ),
                    'btn--white'         => esc_html__( 'white', 'seosight' ),
                    'btn--gray'          => esc_html__( 'gray', 'seosight' ),
                    'btn--blue'          => esc_html__( 'blue', 'seosight' ),
                    'btn--purple'        => esc_html__( 'purple', 'seosight' ),
                    'btn--orange'        => esc_html__( 'orange', 'seosight' ),
                    'btn--yellow'        => esc_html__( 'yellow', 'seosight' ),
                    'btn--green'         => esc_html__( 'green', 'seosight' ),
                    'btn--dark-gray'     => esc_html__( 'dark gray', 'seosight' ),
                    'btn--brown'         => esc_html__( 'brown', 'seosight' ),
                    'btn--rose'          => esc_html__( 'rose', 'seosight' ),
                    'btn--violet'        => esc_html__( 'violet', 'seosight' ),
                    'btn--olive'         => esc_html__( 'olive', 'seosight' ),
                    'btn--light-green'   => esc_html__( 'light green', 'seosight' ),
                    'btn--dark-blue'     => esc_html__( 'dark blue', 'seosight' ),
                ],
                'default'       => 'btn--gray',
				'condition'     => ['is_button' => 'yes']
            ]
        );

        $this->add_control(
            'btn_size', 
            [
                'label'         => esc_html__( 'Button size', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'description'   => esc_html__( 'Button size', 'seosight' ),
                'options'       => 
                [
                    'btn-small'         => esc_html__( 'small', 'seosight' ),
                    'btn-medium'        => esc_html__( 'medium', 'seosight' ),
                    'btn-large'         => esc_html__( 'large', 'seosight' ),
                ],
                'default'       => 'btn-medium',
				'condition'     => ['is_button' => 'yes']
            ]
        );

        $this->add_control(
            'outlined', 
            [
                'label'         => esc_html__( 'Outlined button', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Button with border and tranparent background', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',
				'condition'     => ['is_button' => 'yes']
            ]            
        );

		$this->end_controls_section();

		$this->start_controls_section(
		        'css',
			[
				'label'         => esc_html__( 'Info box', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

		$this->add_control(
		        'title-color',
                [
                    'label'     => esc_html__('Title color', 'seosight'),
                    'type'      => \Elementor\Controls_Manager::COLOR,
					'scheme' =>
						[
							'type' => \Elementor\Scheme_Color::get_type(),
							'value' => \Elementor\Scheme_Color::COLOR_1,
						],
					'default'   => '#b77031',

					'selectors' =>
						[
							'{{WRAPPER}} .info-box-title' => 'color: {{SCHEME}};'
						]
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

		//==========

		$this->add_control(
			'text-color',
			[
				'label'     => esc_html__('Text color', 'seosight'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
                'default'   => '#7a7a7a',

				'selectors' =>
					[
						'{{WRAPPER}} .info-box-text' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'text_typography',
				'label'     => esc_html__( 'Text typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .info-box-text',
			]
		);

		//=========

		$this->add_control(
			'icon-color',
			[
				'label'     => esc_html__( 'Icon color', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .info-box-image i' => 'color: {{SCHEME}};'
					],
                'condition'     => ['media' => 'icon']
			]
		);

		$this->add_control(
			'image-background',
			[
				'label'     => esc_html__( 'Image background', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .info-box-image' => 'background: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'img-border',
				'label'     => esc_html__( 'Image border', 'seosight' ),
				'selector'  => '{{WRAPPER}} .info-box-image',
			]
		);

		//======

		$this->add_control(
			'content-background',
			[
				'label'     => esc_html__( 'Info box background', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .info-box-content' => 'background: {{SCHEME}};'
					],
				'default'   => '#f9f9f9',
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'content-border',
				'label'     => esc_html__( 'Info box border', 'seosight' ),
				'selector'  => '{{WRAPPER}} .info-box-content',
			]
		);

		$this->end_controls_section();

	}


	protected function render() {

        $settings = $this->get_settings_for_display();

        global $alowedposttags;
        
        extract($settings);

        if ('image' == $media && $image) {
            $data_img .= '<img src ="'. $image['url'] .'" alt = "'. $title . '">';
        }

        if ($link['url']) {
            $href = 'href="'. $link['url'] . '"';
            $target = ($link['is_external']) ? 'target ="_blank"' : 'target = "_self"';
            $rel = ($link['nofollow']) ? 'rel ="nofollow"' : '';

            if($is_button =='yes'){
                $btn_class = 'btn btn-hover-shadow btn-reverse-bg-color-dark';

                if($outlined == 'yes') {
                    $btn_class .= ' btn-border';
                }
                $btn_class .= ' '. esc_attr($btn_size);
                $btn_class .= ' '. esc_attr($btn_color);

                $data_button = '<a '. esc_url($href) .' '. esc_attr($target) .' '. esc_attr($rel) . ' class ="' . esc_attr($btn_class) . '"><span class="text">'. esc_html($link_title) . '</span><span class="semicircle"></span></a>';
            } else {
                $data_button = '<a '. esc_url($href) .' '. esc_attr($target) .' '. esc_attr($rel) . '><span class="text">'. esc_html($link_title) . '</span></a>';
            }
        }

        ?>
        <div class="crumina-module crumina-info-box info-box--<?php echo $layout; ?>">
            <div class="info-box-image">
				<?php
				if ($media == 'icon') \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ]);
				else seosight_render($data_img);
				?>
            </div>
            <div class="info-box-content">
				<?php
				if ( ! empty( $title ) ) { ?>
                    <h5 class="info-box-title"><?php echo wp_kses( $title, $allowedposttags ) ?></h5>
				<?php } ?>
				<?php if ( ! empty( $desc ) ) { ?>
                    <div class="info-box-text"><?php echo wp_kses( $desc, $allowedposttags ); ?></div>
				<?php } ?>
				<?php seosight_render( $data_button ) ?>
            </div>
        </div>
        <?php
	}

}